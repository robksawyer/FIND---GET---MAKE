<?php
	/*$config['Facebook']['appId'] = '242077092502389'; //--> from facebook app page
	$config['Facebook']['appKey'] = '9747b40bc8bf0d6fd5ce3c7f71848136'; //--> from your facebook app page
	$config['Facebook']['appSecret'] = '8506f9938b8c7657a41b7fdaf8e99362'; //--> from your facebook app page
	$config['Facebook']['appUri'] = 'localhost/app'; //--> your app folder (eg localhost/cake)
	$config['Facebook']['canvasPage'] = '/'; //--> your canvas page (from facebook. remember the trailing '/')
	$config['Facebook']['locale'] = 'en_US'; //--> your canvas page (from facebook. remember the trailing '/')*/


//find-get-make.local
$config = array(
	'Facebook' => array(
		'appId'  => '242077092502389', //Dev version
		'apiKey' => '9747b40bc8bf0d6fd5ce3c7f71848136',
		'secret' => '8506f9938b8c7657a41b7fdaf8e99362', //Dev version
//		'appUri' => 'localhost/app',
//		'canvasPage' => '/',
		'locale' => 'en_US',
		'cookie' => true,
		'xfbml' => true,
		'oauth' => true
	)
);

//*.find-get-make.com
/*$config = array(
	'Facebook' => array(
		'appId'  => '244224708951284',
		'apiKey' => '9747b40bc8bf0d6fd5ce3c7f71848136',
		'secret' => 'fcf31bb815c9a6ee21101ff2e2dadfb1',
		'locale' => 'en_US',
		'cookie' => true,
		'xfbml' => true,
		'oauth' => true
	)
);*/
?>