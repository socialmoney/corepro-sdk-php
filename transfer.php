<?php

//see: 
class Transfer{
	public $customerId;
	public $fromId;
	public $toId;
	public $tag;
	public $amount;
	public $transactionId;

	public function Create($transfer){
		$requestor = new Requestor();
		$model = $requestor->Post("/transfer/create",$transfer, "Transfer");
		return $model;	
	} 

	public function Void($transfer){
		$requestor = new Requestor();
		$model = $requestor->Post("/transfer/void",$transfer, "Transfer");
		return $model;	
	} 
	
}

?>