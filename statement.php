<?php

//see: http://docs.corepro.io/api/Statement/
class Statement {
	public $customerId;
	public $statementId;
	public $month;
	public $type;
	public $year;
	
	public function Get($customerId, $statementId){
		$requestor = new Requestor();
		$model = $requestor->Get("/statement/get/".$customerId."/".$statementId, "Statement");
		return $model;
	}

	public function ListAll($customerId){
		$requestor = new Requestor();
		$model = $requestor->Get("/statement/list/".$customerId, "Statement");
		return $model;
	}

	public function Search($customerId,$type,$year,$month){
		$requestor = new Requestor();
		$model = $requestor->Get("/statement/search/".$customerId."/".$type."/".$year."/".$month, "Statement");
		return $model;
	}

	public function Download($customerId, $statementId){
		$requestor = new Requestor();
		$model = $requestor->GetDownload("/statement/download/".$customerId."/".$statementId);
		return $model;
	}
}