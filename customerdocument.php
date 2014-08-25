<?php

//see: http://docs.corepro.io/api/customerDocument/
class CustomerDocument {
	public $customerId;
	public $documentType;
	public $reasonType;
	public $documentName;
	public $documentContent;

	public function Upload($customerDocument){
		$requestor = new Requestor();
		$model = $requestor->Upload("/customerDocument/upload",$customerDocument, "Envelope", false);
		return $model;
	}
}