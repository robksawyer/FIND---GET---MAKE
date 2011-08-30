<div id="aros_link" class="acl_links">
<?php
$selected = isset($selected) ? $selected : $this->params['action'];

$links = array();
$links[] = $this->Html->link(__d('acl', 'Build missing AROs', true), '/admin/acl/aros/check', array('class' => ($selected == 'admin_check' )? 'selected' : null));
$links[] = $this->Html->link(__d('acl', 'Users roles', true), '/admin/acl/aros/users', array('class' => ($selected == 'admin_users' )? 'selected' : null));

if(Configure :: read('acl.gui.roles_permissions.ajax') === true)
{
    $links[] = $this->Html->link(__d('acl', 'Roles permissions', true), '/admin/acl/aros/ajax_role_permissions', array('class' => ($selected == 'admin_role_permissions' || $selected == 'admin_ajax_role_permissions' )? 'selected' : null));

	if($selected == 'admin_ajax_role_permissions' || $selected == 'admin_ajax_role_permissions_plugins' || $selected == 'admin_ajax_role_permissions_actions'){
		$links[] = $this->Html->link(__d('acl', 'Roles permissions: App Actions', true), '/admin/acl/aros/ajax_role_permissions_actions', array('class' => ($selected == 'admin_role_permissions_actions' || $selected == 'admin_ajax_role_permissions_actions' )? 'selected' : null));
		$links[] = $this->Html->link(__d('acl', 'Roles permissions: App Plugin Actions', true), '/admin/acl/aros/ajax_role_permissions_plugins', array('class' => ($selected == 'admin_role_permissions_plugins' || $selected == 'admin_ajax_role_permissions_plugins' )? 'selected' : null));
	}
}
else
{
    $links[] = $this->Html->link(__d('acl', 'Roles permissions', true), '/admin/acl/aros/role_permissions', array('class' => ($selected == 'admin_role_permissions' || $selected == 'admin_ajax_role_permissions' )? 'selected' : null));
}
$links[] = $this->Html->link(__d('acl', 'Users permissions', true), '/admin/acl/aros/user_permissions', array('class' => ($selected == 'admin_user_permissions' )? 'selected' : null));

echo $this->Html->nestedList($links, array('class' => 'acl_links'));
?>
</div>