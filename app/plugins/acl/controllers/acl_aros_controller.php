<?php

/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

class AclArosController extends AclAppController {
	public $name = 'AclAros';
	
	function load($id) {
		$this->layout = '';
		$n = $this->AclAro->find(
			'first',
			array(
				'conditions' => array(
					'AclAro.id' => $id
				),
				'contain' => false
			)
		);
		$data = array(
			'id' => $n['AclAro']['id'],
			'alias' => $n['AclAro']['alias'],
			'model' => $n['AclAro']['model'],
			'key' => $n['AclAro']['foreign_key'],
			'parent_id' => $n['AclAro']['parent_id']
		);
		Configure::write('debug', 0);
		App::import('Vendor', 'Acl.json');
		$json = new Services_JSON();
		$json = $json->encode($data);
		$this->set('json', $json);
	}

	function delete($id) {
		if (!$this->AclAro->delete($id)) {
			$this->failure();
		}
		exit;
	}

	function children($id = 0) {
		Configure::write('debug', 0);
		$this->layout = '';

		$node = $this->AclAro->find(
			'first',
			array(
				'conditions' => array(
					'AclAro.id' => $id
				),
				'contain' => false
			)
		);

		$children = $this->AclAro->children($id, true, null, null, null, 1, 0);

		$sorted = array();
		foreach ($children as $c) {
			$c['AclAro']['children'] = ($c['AclAro']['rght'] - $c['AclAro']['lft'] - 1) / 2;
			if (empty($c['AclAro']['alias'])) {
				$c['AclAro']['alias'] = $c['AclAro']['model'] . ' - ' . $c['AclAro']['foreign_key'];
			}
			$sorted[$c['AclAro']['alias']] = $c;
		}
		ksort($sorted);

		$this->set('node', $node);
		$this->set('children', $sorted);
	}

	function add() {
		if (isset($this->data['AclAro']['parent_id']) &&  !$this->data['AclAro']['parent_id']) {
			$this->data['AclAro']['parent_id'] = null;
		}
		if (!$this->AclAro->save($this->data)) {
			$this->failure();
		}
		exit;
	}

	function update() {
		if (isset($this->data['AclAro']['parent_id']) &&  !$this->data['AclAro']['parent_id']) {
			$this->data['AclAro']['parent_id'] = null;
		}
		if (!$this->AclAro->save($this->data)) {
			$this->failure();
		}
		exit;
	}

	function test() {
		$array['AclAro'] = array(
			'parent_id' => '',
			'alias' => 'test'
		);
		$this->AclAro->save($array);
		exit;
	}

}

?>
