<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2: */

echo $html->css('/acl/css/acl', null, array('inline' => false));
echo $html->script(array('/acl/js/acl'), array('inline' => false));
echo $javascript->codeBlock('acl_base_url = \'' . $html->url('/acl',true) . '\';',array('inline' => false));
