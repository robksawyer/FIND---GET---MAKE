<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */
?>
<div class="acl_menu">
<?php echo $this->Html->image('/acl/img/tango/32x32/places/folder.png', array('align' => 'absmiddle')) ?><?php echo $this->Html->link('Acl Menu', array('plugin' => 'acl', 'prefix' => 'admin', 'controller' => 'acl', 'action' => 'index')) ?>

<?php echo $this->Html->image('/acl/img/tango/32x32/apps/system-users.png', array('align' => 'absmiddle')) ?><?php echo $this->Html->link('Manage Aros', array('plugin' => 'acl', 'prefix' => 'admin', 'controller' => 'acl', 'action' => 'aros')) ?>

<?php echo $this->Html->image('/acl/img/tango/32x32/apps/preferences-system-windows.png', array('align' => 'absmiddle')) ?><?php echo $this->Html->link('Manage Acos', array('plugin' => 'acl', 'prefix' => 'admin', 'controller' => 'acl', 'action' => 'acos')) ?>

<?php echo $this->Html->image('/acl/img/tango/32x32/emblems/emblem-readonly.png', array('align' => 'absmiddle')) ?><?php echo $this->Html->link('Manage Permissions', array('plugin' => 'acl', 'prefix' => 'admin', 'controller' => 'acl', 'action' => 'permissions')) ?>
</div>
