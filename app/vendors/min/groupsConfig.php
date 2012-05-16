<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

return array(
    // 'js' => array('//js/file1.js', '//js/file2.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
	'jquery_js' => array(
			'//theme/default/js/jquery-1.6.2.min.js',
			'//theme/default/js/jquery-ui-1.8.16.custom.min.js'
		),
	'dependencies_js' => array(
		'//theme/default/js/sizzle.js',
		'//theme/default/js/jstorage.min.js',
		'//theme/default/js/json2.js',
		'//theme/default/js/jquery.json-2.3.min.js',
		'//theme/default/js/chosen/chosen.jquery.min.js', //Chosen Select Boxes (http://harvesthq.github.com/chosen/) 
		'//theme/default/js/jquery.popupwindow.js',
		'//theme/default/js/jquery.form.js',
		'//theme/default/js/jquery.autocomplete.min.js',
		'//theme/default/js/jquery.jeditable.mini.js',
		'//theme/default/js/jquery.mousewheel.min.js',
		'//theme/default/js/jquery.simpletip-1.3.1.min.js',
		'//theme/default/js/jquery.masonry.min.js',
		'//theme/default/js/jquery.infieldlabel.min.js',
		'//theme/default/js/modal/jquery.simplemodal.1.4.1.min.js', //Include jQuery modal window APIs
		'//theme/default/js/modal/basic.js'
	),
	'base_js' => array(
		'//theme/default/js/utils.js',
		'//theme/default/js/fgm_api.js'
	),
	'forum_js' => array(
		'/forum/js/script.js' //Cupcake forum
	),
	'footer_js' => array(
		'//theme/default/js/footer.js'
	)
);