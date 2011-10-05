<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 **/

return array(
	'dependencies_js' => array(
		'//theme/default/js/jquery-1.6.2.min.js',
		'//theme/default/js/jquery-ui-1.8.16.custom.min.js',
		'//theme/default/js/chosen/chosen.jquery.min.js', //Chosen Select Boxes (http://harvesthq.github.com/chosen/) 
		'//theme/default/js/history.js',
		'//theme/default/js/history.html4.js', 
		'//theme/default/js/history.adapter.jquery.js',
		'//theme/default/js/init-history.js',
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
		'//theme/default/js/fgm_api.js', 
		'//theme/default/js/utils.js'
	),
	'forum_js' => array(
		'/forum/js/script.js' //Cupcake forum
	),
	'footer_js' => array(
		'//theme/default/js/footer.js'
	)
	
    // 'js' => array('//js/file1.js', '//js/file2.js'),
    // 'css' => array('//css/file1.css', '//css/file2.css'),
	
    // custom source example
    /*'js2' => array(
        dirname(__FILE__) . '/../min_unit_tests/_test_files/js/before.js',
        // do NOT process this file
        new Minify_Source(array(
            'filepath' => dirname(__FILE__) . '/../min_unit_tests/_test_files/js/before.js',
            'minifier' => create_function('$a', 'return $a;')
        ))
    ),//*/

    /*'js3' => array(
        dirname(__FILE__) . '/../min_unit_tests/_test_files/js/before.js',
        // do NOT process this file
        new Minify_Source(array(
            'filepath' => dirname(__FILE__) . '/../min_unit_tests/_test_files/js/before.js',
            'minifier' => array('Minify_Packer', 'minify')
        ))
    ),//*/
);