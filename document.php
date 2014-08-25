<?php

//see: http://docs.corepro.io/api/document/
class Document {
	public $bankid;
	public $culture;
	public $customerId;
	public $documentId;
	public $documentType;
	public $downloadUrl;
	public $effectiveDate;
	public $expireDate;
	public $html;
	public $title;

	public function ListAll($culture){
		$requestor = new Requestor();
		$model = $requestor->Get("/document/list/".$culture, "Document");
		return $model;
	}

	public function Download($culture, $documentId){
		$requestor = new Requestor();
		$model = $requestor->GetDownload("/document/get/".$culture."/".$documentId);
		return $model;
	}
}