<?php
/**
 * Cached Access Control List
 *
 * This component implements caching for ACL.
 *
 * PHP version 5
 *
 * Copyright (c) 2011, George C. <slygoncito@gmail.com>
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      George C. <slygoncito@gmail.com>
 * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link        http://github.com/slygoncito/cakephp_cached_acl/
 */

/**
 * Model behaviors base class
 */
App::import('Model', 'ModelBehavior', false);

/**
 * Cached Access Control List class
 *
 * This component implements caching for ACL.
 */
class DbCachedAclComponent extends DbAcl
{
    /**
     * Holds the ACL index
     *
     * @var array
     * @access private
     */
    private $index = array('Aro' => array(), 'Aco' => array());

    /**
     * Holds the name of the cache configuration
     *
     * @var string
     * @access private
     */
    private $cache = 'default';

    /**
     * Indicates whenever the index needs to be rebuilt
     *
     * @staticvar boolean
     * @access public
     */
    public static $changed = false;

    /**
     * Initialize callback
     *
     * @param object &$component Instance of AclComponent
     *
     * @access public
     */
    public function initialize(&$component)
    {
        if (($cache = Configure::read('Acl.cache')) !== null)
        {
            if (in_array($cache, Cache::configured()))
            {
                $this->cache = $cache;
            }
        }

        if (empty($this->Aro->getDataSource('default')->connection))
        {
            return;
        }

        if (($this->index = Cache::read(__CLASS__, $this->cache)) === false)
        {
            $this->index = array
                (
                'Aro' => $this->build('Aro'),
                'Aco' => $this->build('Aco')
            );

            if (!empty($this->index['Aro']) && !empty($this->index['Aco']))
            {
                Cache::write(__CLASS__, $this->index, $this->cache);
            }
        }

        $this->Aro->Behaviors->attach('CachedAcl');
        $this->Aco->Behaviors->attach('CachedAcl');
        $this->Aro->Permission->Behaviors->attach('CachedAcl');

        parent::initialize($component);
    }

    /**
     * Destructor
     *
     * @access public
     */
    public function __destruct()
    {
        if (self::$changed)
        {
            Cache::delete(__CLASS__, $this->cache);
        }
    }

    /**
     * Checks if the given $aro has access to action $action in $aco
     *
     * @see DbAcl::check()
     *
     * @param mixed $aro The requesting object identifier
     * @param mixed $aco The controlled object identifier
     * @param string $action Action
     *
     * @access public
     * @return boolean
     */
    public function check($aro, $aco, $action = "*")
    {
        if (empty($aro) || empty($aco))
        {
            return false;
        }

        $aroPath = $this->getAroPath($aro);
        $acoPermissions = $this->getAcoPermissions($aco);
        $permKeys = $this->_getAcoKeys($this->Aro->Permission->schema());

        if (empty($aroPath) || empty($acoPermissions))
        {
            trigger_error(__("DbCachedAcl::check() - Failed ARO/ACO node lookup in permissions check.  Node references:\nAro: ", true) . print_r($aro, true) . "\nAco: " . print_r($aco, true), E_USER_WARNING);
            return false;
        }

        if ($action != '*' && !in_array('_' . $action, $permKeys))
        {
            trigger_error(sprintf(__("ACO permissions key %s does not exist in DbAcl::check()", true), $action), E_USER_NOTICE);
            return false;
        }

        $inherited = array();
        foreach ($aroPath as $rid)
        {
            foreach ($acoPermissions as $k => $v)
            {
                if (!empty($v[$rid]))
                {
                    if ($action == '*')
                    {
                        foreach ($permKeys as $key)
                        {
                            if ($v[$rid][$key] == -1)
                            {
                                return false;
                            }
                            elseif ($v[$rid][$key] == 1)
                            {
                                $inherited[$key] = 1;
                            }
                        }

                        if (count($inherited) === count($permKeys))
                        {
                            return true;
                        }
                    }
                    else
                    {
                        switch ($v[$rid]['_' . $action])
                        {
                            case -1:
                                return false;

                            case 0:
                                continue;

                            case 1:
                                return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Builds the ARO/ACO index
     *
     * @param string $type The type of index
     *
     * @access private
     * @return array
     */
    private function build($type)
    {
        $tree = array('index' => array(), 'model' => array(), 'alias' => array(), 'path' => array());
        $type = Inflector::camelize(strtolower($type));
        $rows = null;
        $options = array();
        $args = func_get_args();

        static $index = null;

        if (func_num_args() == 1)
        {
            switch ($type)
            {
                case 'Aro':
                    $rows = $this->Aro->find('threaded', array('recursive' => -1, 'fields' => array('Aro.id', 'Aro.parent_id', 'Aro.model', 'Aro.foreign_key', 'Aro.alias')));
                    break;

                case 'Aco':
                    $rows = $this->Aco->find('threaded');
                    break;
            }
            $index = -1;
        }
        else
        {
            $rows = $args[1];
            $options = $args[2];
        }

        if (empty($rows))
        {
            return array();
        }

        foreach ($rows as $row)
        {
            $index++;
            $settings = $options;

            $row[$type]['parents'] = (!empty($settings['parents']) ? $settings['parents'] : array());
            unset($row[$type]['lft'], $row[$type]['rght']);

            if ($type == 'Aco')
            {
                $row['Aco']['Permission'] = array();

                if (!empty($row['Aro']))
                {
                    foreach ($row['Aro'] as $aro)
                    {
                        unset($aro['Permission']['id'], $aro['Permission']['aco_id'], $aro['Permission']['aro_id']);
                        $row['Aco']['Permission'][$aro['id']] = $aro['Permission'];
                    }
                }
            }
            $tree['index'][] = $row[$type];

            if (!empty($row[$type]['model']) && !empty($row[$type]['foreign_key']))
            {
                $tree['model'][$row[$type]['model'] . '.' . $row[$type]['foreign_key']] = $index;
            }

            if (!empty($row[$type]['alias']))
            {
                $tree['alias'][$row[$type]['alias']] = $index;

                $settings['path'] = (!empty($settings['path']) ? $settings['path'] . '/' : '') . $row[$type]['alias'];
                $tree['path'][$settings['path']] = $index;
            }

            if (!empty($row['children']))
            {
                $settings['parents'][] = $index;
                $childrens = $this->build($type, $row['children'], $settings);

                if (!empty($childrens))
                {
                    foreach ($childrens as $k => $v)
                    {
                        $tree[$k] = array_merge($tree[$k], $v);
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * Retrieves the index of an ARO/ACO node
     *
     * @param string $type The type of index
     * @param mixed $ref The ARO/ACO identifier
     *
     * @access private
     * @return boolean|integer False if node not found, index otherwise
     */
    private function getNodeIndex($type, $ref)
    {
        $index = -1;
        $type = Inflector::camelize(strtolower($type));

        if (is_array($ref) && isset($ref['model'], $ref['foreign_key']))
        {
            $ref = implode('.', $ref);
        }
        elseif (is_array($ref) && !isset($ref['model'], $ref['foreign_key']))
        {
            $name = key($ref);
            $model = ClassRegistry::init(array('class' => $name, 'alias' => $name));

            if (empty($model))
            {
                trigger_error(sprintf(__("Model class '%s' not found in %s::%s() when trying to bind %s object", true), $name, __CLASS__, __FUNCTION__, $type), E_USER_WARNING);
                return false;
            }

            if (!method_exists($model, 'bindNode'))
            {
                $ref = sprintf('%s.%d', $name, $ref[$name][$model->primaryKey]);
            }
            else
            {
                $tmpRef = $model->bindNode($ref);

                if (is_array($tmpRef) && isset($tmpRef['model'], $tmpRef['foreign_key']))
                {
                    $ref = implode('.', $tmpRef);
                }
                elseif (is_array($tmpRef) && !isset($tmpRef['model'], $tmpRef['foreign_key']))
                {
                    $ref = sprintf('%s.%s', key($tmpRef), array_shift(current($tmpRef)));
                }
                elseif (is_string($tmpRef))
                {
                    $ref = $tmpRef;
                }
                else
                {
                    return false;
                }
            }
        }
        elseif (is_object($ref) && is_a($ref, 'Model'))
        {
            $ref = sprintf('%s.%d', $ref->alias, $ref->id);
        }

        $search = array('model', 'alias', 'path');
        foreach ($search as $k)
        {
            if (isset($this->index[$type][$k][$ref]))
            {
                $index = $this->index[$type][$k][$ref];
                break;
            }
        }
        return ($index >= 0 ? $index : false);
    }

    /**
     * Retrieves the path of an ARO node
     *
     * @param mixed $ref The ARO identifier
     *
     * @access private
     * @return array
     */
    private function getAroPath($ref)
    {
        if (($index = $this->getNodeIndex('Aro', $ref)) === false)
        {
            return array();
        }

        if (empty($this->index['Aro']['index'][$index]['parents']))
        {
            return array($this->index['Aro']['index'][$index]['id']);
        }

        $ids = array();
        foreach ($this->index['Aro']['index'][$index]['parents'] as $id)
        {
            $ids[] = $this->index['Aro']['index'][$id]['id'];
        }
        return array_reverse(array_merge($ids, array($this->index['Aro']['index'][$index]['id'])));
    }

    /**
     * Retrieves all permissions associated with the path of an ACO node
     *
     * @param mixed $ref The ACO identifier
     *
     * @access private
     * @return array
     */
    private function getAcoPermissions($ref)
    {
        if (($index = $this->getNodeIndex('Aco', $ref)) === false)
        {
            return array();
        }

        if (empty($this->index['Aco']['index'][$index]['parents']))
        {
            return array($this->index['Aco']['index'][$index]['id'] => $this->index['Aco']['index'][$index]['Permission']);
        }

        $perms = array();
        foreach ($this->index['Aco']['index'][$index]['parents'] as $id)
        {
            $perms[$this->index['Aco']['index'][$id]['id']] = $this->index['Aco']['index'][$id]['Permission'];
        }
        $perms[$this->index['Aco']['index'][$index]['id']] = $this->index['Aco']['index'][$index]['Permission'];

        return array_reverse($perms, true);
    }
}

/**
 * Cached Access Control List behavior class
 */
class CachedAclBehavior extends ModelBehavior
{
    /**
     * After save callback
     *
     * @param object &$model Instance of the model
     * @param boolean $created True if this save created a new record
     *
     * @access public
     */
    public function afterSave(&$model, $created)
    {
        DbCachedAclComponent::$changed = true;
    }

    /**
     * After delete callback
     *
     * @param object &$model Instance of the model
     *
     * @access public
     */
    public function afterDelete(&$model)
    {
        DbCachedAclComponent::$changed = true;
    }
}