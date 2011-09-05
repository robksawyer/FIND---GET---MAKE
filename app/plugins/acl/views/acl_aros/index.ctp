<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */
?>
<?php foreach ($aros as $r) { ?>
<option value="<?php print $r['AclAro']['id'] ?>"><?php print $r['AclAro']['alias'] ?></option>
<?php } ?>
