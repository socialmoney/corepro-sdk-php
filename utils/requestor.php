<?php

final class Requestor{

	//http://stackoverflow.com/a/3243949
	function objectToObject($instance, $className) {
	    return unserialize(sprintf(
	        'O:%d:"%s"%s',
	        strlen($className),
	        $className,
	        strstr(strstr(serialize($instance), '"'), ':')
	    ));
	}
 
	function Get($relativeUrl, $className){
		global $GlobalConfig;

		$curl = curl_init($GlobalConfig->CoreProUrl.$relativeUrl);
 
		$request_headers = array();
		$request_headers[] = "User-Agent: ". $GlobalConfig->UserAgent;
		$request_headers[] = "Accept: "."application/json; charset=utf-8";
		$request_headers[] = "Content-Type: "."application/json; charset=utf-8";

		curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($curl, CURLOPT_USERPWD, $GlobalConfig->CoreProApiKey.":".$GlobalConfig->CoreProApiSecret); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $GlobalConfig->VerifySSLHost);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $GlobalConfig->VerifySSLPeer);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$curl_response = curl_exec($curl);
		curl_close($curl);
        
		$instance = json_decode($curl_response);
		$payload= $this->objectToObject($instance, "Envelope");
		if ($payload->status == "200" || $payload->status == "201"){
	
			if (is_array($payload->data)){
				$array = array();
				foreach($payload->data as $key=> $value){
					$mesh = $this->objectToObject($value, $className);
					if (!empty($mesh)){
						$mesh->requestId=$payload->requestId;
						array_push($array, $mesh);
					}
				}
				return $array;
			}

			$obj= $this->objectToObject($payload->data, $className);
			$obj->requestId = $payload->requestId;
			return $obj;

		}else{
			throw new ApiException($payload->errors);
		}
	}


	function GetDownload($relativeUrl){
		global $GlobalConfig;

		$curl = curl_init($GlobalConfig->CoreProUrl.$relativeUrl);
 
		$request_headers = array();
		$request_headers[] = "User-Agent: ". $GlobalConfig->UserAgent;
		$request_headers[] = "Accept: "."application/json; charset=utf-8";
		$request_headers[] = "Content-Type: "."application/json; charset=utf-8";

		curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($curl, CURLOPT_USERPWD, $GlobalConfig->CoreProApiKey.":".$GlobalConfig->CoreProApiSecret); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $GlobalConfig->VerifySSLHost);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $GlobalConfig->VerifySSLPeer);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$curl_response = curl_exec($curl);
		
		//see if we can decode to instance...
	 	$instance = json_decode($curl_response);
		$payload= $this->objectToObject($instance, "Envelope");

		if ($payload->errors){
			throw new ApiException($payload->errors);	
		}

		return $curl_response;

	}

	function Post($relativeUrl, $data, $className){

		$jsonData = json_encode($data);

		global $GlobalConfig;

		$curl = curl_init($GlobalConfig->CoreProUrl.$relativeUrl);
 
		$request_headers = array();
		$request_headers[] = "User-Agent: ". $GlobalConfig->UserAgent;
		$request_headers[] = "Accept: "."application/json; charset=utf-8";
		$request_headers[] = "Content-Type: "."application/json; charset=utf-8";

		curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($curl, CURLOPT_USERPWD, $GlobalConfig->CoreProApiKey.":".$GlobalConfig->CoreProApiSecret); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $GlobalConfig->VerifySSLHost);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $GlobalConfig->VerifySSLPeer);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData );

		$curl_response = curl_exec($curl);
		curl_close($curl);
        
		$instance = json_decode($curl_response);
		$payload= $this->objectToObject($instance, "Envelope");
		if ($payload->status == "200" || $payload->status == "201"){
	
			if (is_array($payload->data)){
				$array = array();
				foreach($payload->data as $key=> $value){
					$mesh = $this->objectToObject($value, $className);
					if (!empty($mesh)){
						$mesh->requestId=$payload->requestId;
						array_push($array, $mesh);
					}
				}
				return $array;
			}

			$obj= $this->objectToObject($payload->data, $className);
			$obj->requestId = $payload->requestId;
			return $obj;

		}else{
			throw new ApiException($payload->errors);
		}
	}

	function Upload($relativeUrl, $data, $className, $returnInstance=false){

		$jsonData = json_encode($data);

		global $GlobalConfig;

		$curl = curl_init($GlobalConfig->CoreProUrl.$relativeUrl);
 
		$request_headers = array();
		$request_headers[] = "User-Agent: ". $GlobalConfig->UserAgent;
		$request_headers[] = "Accept: "."application/json; charset=utf-8";
		$request_headers[] = "Content-Type: "."application/json; charset=utf-8";

		curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($curl, CURLOPT_USERPWD, $GlobalConfig->CoreProApiKey.":".$GlobalConfig->CoreProApiSecret); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $GlobalConfig->VerifySSLHost);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $GlobalConfig->VerifySSLPeer);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData );

		$curl_response = curl_exec($curl);
		curl_close($curl);

		$instance = json_decode($curl_response);
		$payload= $this->objectToObject($instance, "Envelope");
         	 
		if ($payload->status == "200" || $payload->status == "201"){

			if ($returnInstance==false){
				return true;
			}			

			$instance = json_decode($curl_response);
			$payload= $this->objectToObject($instance, "Envelope");

			if (is_array($payload->data)){
				$array = array();
				foreach($payload->data as $key=> $value){
					$mesh = $this->objectToObject($value, $className);
					if (!empty($mesh)){
						$mesh->requestId=$payload->requestId;
						array_push($array, $mesh);
					}
				}
				return $array;
			}

			$obj= $this->objectToObject($payload->data, $className);
			$obj->requestId = $payload->requestId;
			return $obj;

		}else{
			$instance = json_decode($curl_response);
			$payload= $this->objectToObject($instance, "Envelope");
			throw new ApiException($payload->errors);
		}
	}

}

?>