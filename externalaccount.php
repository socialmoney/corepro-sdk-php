<?php

//see: http://docs.corepro.io/api/externalAccount/
 final class ExternalAccount {
	public $externalAccountId;
	public $customerId;
	public $tag;
	public $name;
	public $routingNumber;
	public $accountNumber;
	public $type;
	public $nickName;
	public $status;
	public $statusDate;
	public $nocCode;
	public $isActive;
	public $isLocked;
	public $lockedDate;
	public $lockedReason;
	public $requestId;

	public function Create($externalAccount){
		$requestor = new Requestor();
		$model = $requestor->Post("/externalAccount/create/",$externalAccount, "ExternalAccount");
		return $model;	
	}

	public function Deactivate($externalAccount){
		$requestor = new Requestor();
		$model = $requestor->Post("/externalAccount/deactivate/",$externalAccount, "ExternalAccount");
		return $model;	
	} 

	public function Get($externalAccountId){
		$requestor = new Requestor();
		$model = $requestor->Get("/externalAccount/get/".$externalAccountId, "ExternalAccount");
		return $model;
	}

	public function GetByTag($customerId, $tag){
		$requestor = new Requestor();
		$model = $requestor->Get("/customer/getByTag/".$customerId."/".$tag, "ExternalAccount");
		return $model;
	}

	public function Initiate($externalAccount){
		$requestor = new Requestor();
		$model = $requestor->Post("/externalAccount/initiate/",$externalAccount, "ExternalAccount");
		return $model;	
	}

	public function ListAll($customerId, $pageNumber=0, $pageSize=200){
		$requestor = new Requestor();
		$model = $requestor->Get("/externalAccount/list/".$customerId."?pageNumber=".$pageNumber."&pageSize=".$pageSize, "ExternalAccount");
		return $model;
	}

	public function Update($externalAccount){
		$requestor = new Requestor();
		$model = $requestor->Post("/externalAccount/update/",$externalAccount, "ExternalAccount");
		return $model;	
	}

	public function Verify($externalAccountTrialDeposits){
		$requestor = new Requestor();
		$model = $requestor->Post("/externalAccount/verify/",$externalAccountTrialDeposits, "ExternalAccount");
		return $model;	
	}
}
?>