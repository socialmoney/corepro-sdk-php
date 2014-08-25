<?php

//see: http://docs.corepro.io/api/externalAccountDocument/
class ExternalAccountDocument {
	public $customerId;
	public $externalAccountId;
	public $documentType;
	public $reasonType;
	public $documentName;
	public $documentContent;

	public function Upload($externalAccountDocument){
		$requestor = new Requestor();
		$model = $requestor->Upload("/externalAccountDocument/upload",$externalAccountDocument, "Envelope", false);
		return $model;
	}
}