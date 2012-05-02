<?php

App::import('Helper', array('Html', 'Form', 'Js'));

/**
 * TwitteKit @Anywhere Helper
 *
 * Copyright 2010, ELASTIC Consultants Inc. http://elasticconsultants.com/
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @version    1.0
 * @author     nojimage <nojima at elasticconsultants.com>
 * @copyright  2010 ELASTIC Consultants Inc.
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link       http://elasticconsultants.com
 * @package    twitter_kit
 * @subpackage twitter_kit.views.helpers
 * @since      File available since Release 1.0
 * @modifiedby nojimage <nojima at elasticconsultants.com>
 *
 * @see http://dev.twitter.com/anywhere/begin
 */
class AnywhereHelper extends AppHelper {

    public $helpers = array('Html', 'Form', 'Js');
    static $anywhereUri = 'http://platform.twitter.com/anywhere.js';
    /**
     *
     * @var HtmlHelper
     */
    public $Html;
    /**
     *
     * @var FormHelper
     */
    public $Form;
    /**
     *
     * @var JsHelper
     */
    public $Js;

    /**
     * load Anywhere script
     *
     * @param array $options
     * @return string
     */
    public function loadScript($options = array()) {

        $dataSource = $apiKey = $apiVersion = null;

        $defaults = array(
            'dataSource' => 'twitter',
            'apiKey' => null,
            'apiVersion' => 1,
            'inline' => false,
        );
        $options = am($defaults, $options);
        extract($options, EXTR_OVERWRITE);
        unset($options['dataSource']);
        unset($options['apiKey']);
        unset($options['apiVersion']);

        if (empty($apiKey)) {
            /* @var $ds TwitterSource */
            $ds = ConnectionManager::getDataSource($dataSource);
            if (!empty($ds->config['api_key'])) {
                $apiKey = $ds->config['api_key'];
            }
        }

        $params = array('id' => $apiKey, 'v' => $apiVersion);
        return $this->Html->script(self::$anywhereUri . Router::queryString($params, array(), true), $options);
    }

    /**
     * Create Login Button
     *
     * @param $elementId
     * @param $options
     * @deprecated
     * TODO: not testing
     */
    public function connectButton($elementId = 'login', $options = array()) {

        $defaults = array('size' => 'large', 'createElement' => true, 'authComplete' => 'location.reload();', 'signOut' => '', 'callbackUrl' => null);

        extract(am($defaults, $options));

        $out = '';

        // -- create element
        if ($createElement) {
            $out = $this->Html->tag('span', '', array('id' => $elementId));
        }

        // -- modifiy callback functions
        $authComplete = trim($authComplete);
        if (!preg_match('/^function/', $authComplete)) {
            $authComplete = "function (user) { {$authComplete} }";
        }

        $signOut = trim($signOut);
        if (!preg_match('/^function/', $signOut)) {
            $signOut = "function () { {$signOut} }";
        }

        // -- modify callback Url
        if (!empty($callbackUrl)) {
            $callbackUrl = "twttr.anywhere.config({ callbackURL: '{$this->url($callbackUrl, true)}' });";
        }

        /// -- logout
        if (empty($logout)) {
            $logout = '<button type="button">Logout</button>';
        }

        $out .= $this->Html->scriptBlock("
    twttr.anywhere(function (T) {

        {$callbackUrl}

        if (T.isConnected()) {
            $('#{$elementId}').html('{$logout}');
            $('#{$elementId}').children().click(function(){ twttr.anywhere.signOut(); location.reload(); return false; });
        } else {
            T('#{$elementId}').connectButton({
                size: '{$size}',
                authComplete: {$authComplete},
                signOut: {$signOut}
            });
        }
    });
        ");

        return $out;
    }

    /**
     * create follow me button
     *
     * @param string $screen_name
     * @param string $elementId
     */
    function followMe($screen_name, $elementId = 'followMe') {

        $out = $this->Html->tag('span', '', array('id' => $elementId));

        $out .= $this->Html->scriptBlock("
        twttr.anywhere(function (T) {
            T('#{$elementId}').followButton('{$screen_name}');
        });");

        return $out;
    }

    /**
     * create Hovercards
     *
     * @param string $element
     * @param array  $options
     */
    function hovercards($element = '.content', $options = array()) {

        if (!empty($options['username'])) {
            $username = $options['username'];
            unset($options['username']);
        }

        $opt = '';
        if (!empty($options)) {
            $opt = json_encode($options);
        }

        if (!empty($username)) {
            if (empty($options)) {
                $opt = "{ username: {$username} }";
            } else {
                $opt = preg_replace('/^{/', "{ username: {$username},", $opt);
            }
        }

        $this->Js->buffer("
        twttr.anywhere(function (T) {
            T('{$element}').hovercards({$opt});
        });");
    }

}