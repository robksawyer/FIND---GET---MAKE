<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */
?>
<?php echo $this->element('acl_scripts') ?>
<?php echo $this->element('acl_menu') ?>
<div>
  <?php print $this->Html->image('/acl/img/tango/32x32/apps/system-users.png', array('align' => 'absmiddle')) ?>
  <b>Manage Aros</b>
  <span id="indicator" style="display:none;"><?php print $this->Html->image('/acl/img/indicator.gif') ?> Loading.</span>
</div>
<table>
  <tr>
    <td>
      <select id="aro_editor_parentId" class="acl_select" size="10">
		<option>Empty</option>
      </select>
      <input id="aro_editor_edit" type="button" value="Edit">
    </td>
    <td>
      <table>
        <tr>
          <td>Alias</td>
          <td><input id="aro_editor_alias" type="text"></td>
        </tr>
        <tr>
          <td>Model</td>
          <td><input id="aro_editor_model" type="text"></td>
        </tr>
        <tr>
          <td>Key</td>
          <td><input id="aro_editor_foreignKey" type="text"></td>
        </tr>
      </table>
      <input id="aro_editor_id" type="hidden">
      <input id="aro_editor_originalParentId" type="hidden">
      <input id="aro_editor_create" type="button" value="Create">
      <input id="aro_editor_cancel" type="button" value="Cancel" style="display:none">
      <input id="aro_editor_update" type="button" value="Update" style="display:none">
      <input id="aro_editor_delete" type="button" value="Delete" style="display:none">
    </td>
  </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	acl_aro_setup();
});
</script>
