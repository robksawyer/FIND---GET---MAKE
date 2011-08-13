<?php

/**
 * cURL component.
 * 
 * 
 * Example usage:
 * 
 * $this->Curl->server = "www.google.com/search";
 * $this->Curl->params = array(
 * 		'q' => 'search term'
 * );
 * $this->xmlResponse = false;
 * $this->returnHeader = false;
 * 
 * $this->Curl->buildRequestString(); // can be used for debug - automatically called with Execute
 * debug($this->Curl->requestString);
 * 
 * $response = $this->Curl->execute();
 * debug($response);
 * 
 */

/**
 * Test for cURL compatibility.
 */
if(!function_exists('curl_init'))
{
	die('cURL not installed.');
}


class CurlComponent extends Object 
{
	var $components = array('Xmlsimple');
	
	var $test = false;
	var $testResponse = 'TEST MODE DEFAULT RESPONSE';
	
	var $xmlResponse = false;
	
	var $server = null;
	var $params = null;
	var $response = null;
	var $requestString = null;
	
	var $returnHeader = true;
	var $returnTransfer = true;
	
	var $success = false;
	
	var $returnedData = null;
	
	var $error = null;
	
	function execute()
	{
		if($this->test)
		{
			$this->success = true;
			$this->returnedData = $this->testResponse;
			break;
		}
		else 
		{
			
			if(!$this->server)
			{
				$this->error = 'No server set.';
				break;
			}
			else 
			{
				$this->buildRequestString();
				
				$session = curl_init($this->requestString);
				curl_setopt($session, CURLOPT_HEADER, $this->returnHeader);
				curl_setopt($session, CURLOPT_RETURNTRANSFER, $this->returnTransfer);
				$response = curl_exec($session);				
				
				// check for error
				if(curl_errno($session))
				{
					$this->error = curl_error($session);
					break;
				}
				else 
				{
					curl_close($session);	
					if($this->xmlResponse)
					{
						$status_code = array();
						preg_match('/\d\d\d/', $response, $status_code);
						// Get the XML from the response, bypassing the header
						if (!($xml = strstr($response, '<?xml'))) {
						   $xml = null;
						}
						
						$parsed_xml = $this->Xmlsimple->parse($xml);
						
						$this->success = true;
						$this->returnedData = $parsed_xml;
						
					}
					else
					{
						$this->success = true;
						$this->returnedData = $response;
					}
				}
				
			}
		}
	}
	
	function buildRequestString()
	{
		/**
		 * Return an error if server not set.
		 */
		if(!$this->server)
		{
			$this->error = 'Server not set.';
			return false;
		}
		
		$request = $this->server;
		
		if(!empty($this->params))
		{
			$request.= '?';
			
			// Build request string out of params.
			foreach($this->params as $var => $val)
			{
				$request .= $var.'='.urlencode($val).'&';
			}
			// remove trailing '&'
			$request = substr($request,0,-1);
		}
		
		$this->requestString = $request;
		return array('success'=>1);
		
	}
	
	function setParams($params=null)
	{
		if(is_array($params))
		{
			$this->params = $params;
		}
	}
	
	function addParams($params=null)
	{
		if(is_array($this->params))
		{
			$this->params = array_merge($this->params,$params);
		}
		else 
		{
			$this->params = $params;
		}
	}	
}

?>