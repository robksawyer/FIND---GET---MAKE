<?php	 
/*** 
 * Helper to minify local assets.  See minify at http://code.google.com/p/minify/ 
 * @author Steve DeWald - sdewald@gmail.com - maggwire.com 
 */ 
Class MinifyHelper extends AppHelper { 
	 /** 
	  * Output js stylesheets 
	  */ 
	 public function js($scripts) { 
		  $links = array(); 
		  $urls = array(); 
		  foreach ($scripts as $script) { 
				$matches = array(); 
				if (preg_match('/src="\/js\/(.*?)\.js"/', $script, $matches)) { 
					 $links[] = $script; 
					 $urls[] = $matches[1]; 
				} 
		  } 
			
		  if (!empty($links)) { 
				if (Configure::read('MinifyAssets')) { 
					 $path = $this->_path($urls, 'js'); 
					 return '<script type="text/javascript" src="'.$path.'"></script>'; 
				} else { 
					 return implode($links, "\n"); 
				} 
		  } else { 
				return ''; 
		  } 
	 } 

	 /** 
	  * Output css stylesheets 
	  */ 
	 public function css($scripts) { 
		  $sheets = array(); 
		  $urls = array(); 
		  foreach ($scripts as $script) { 
				$matches = array(); 
				if (preg_match('/href="\/css\/(.*?)\.css"/', $script, $matches)) { 
					 $sheets[] = $script; 
					 $urls[] = $matches[1]; 
				} 
		  } 
			
		  if (!empty($sheets)) { 
				if (Configure::read('MinifyAssets')) { 
					 $path = $this->_path($urls, 'css'); 
					 return '<link rel="stylesheet" type="text/css" href="'.$path.'" />'; 
				} else { 
					 return implode($sheets, "\n"); 
				} 
		  } else { 
				return ''; 
		  } 
	 } 
	  
	 /** 
	  * Output other scripts for layout 
	  */ 
	 public function external($scripts) { 
		  $externals = array(); 
		  foreach ($scripts as $script) { 
				$matches = array(); 
				if (!preg_match('/href="\/css\/(.*?)\.css"/', $script, $matches) && 
					 !preg_match('/src="\/js\/(.*?)\.js"/', $script, $matches)) { 
					 $externals[] = $script; 
				} 
		  } 
			
		  if (!empty($externals)) { 
				return implode($externals, "\n"); 
		  } else { 
				return ''; 
		  } 
	 } 
	  
	 /** 
	  * Gets the minified path for a group of assets 
	  * 
	  * @param array $assets Array of asset paths 
	  * @param string $ext File extension for the assets (i.e. 'js' or 'css') 
	  */ 
	 /*private function _path($assets, $ext) { 
		  $path = $this->webroot . "min/b=$ext&amp;f="; 
		  foreach ($assets as $asset) { 
				$path .= ($asset . ".$ext,"); 
		  } 
		  return substr($path, 0, count($path)-2); 
	 }*/
	
	public function _path($assets, $ext){
		$path = $this->webroot . "min/f=";
		$url = '';
		foreach($assets as $asset) {
			 if (strpos($asset, '/') !== false) {
				  $url = ("{$asset}.{$ext}");
			 } else {
				  $url = $ext . '/' . ("{$asset}.{$ext}");
			 }
			 $path .= ("{$url},");
		}
		return substr($path, 0, -1) . '&amp;' . Configure::read('App.version');
	}
} 
?>