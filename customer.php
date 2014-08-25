<?php

//see: http://docs.corepro.io/api/customer
 final class Customer {
	public $accounts;
	public $addresses;
	public $createdDate;
	public $culture;
	public $customerId;
	public $driversLicenseState;
	public $emailAddress;
	public $externalAccounts;
	public $firstName;
	public $gender;
	public $isActive;
	public $isDocumentsAccepted;
	public $isLocked;
	public $isOptedInToBankCommunication;
	public $isSubjectToBackupWithholding;
	public $lastName;
	public $lockedReason;
	public $middleName;
	public $passportCountry;
	public $phones;
	public $status;
	public $tag;
	public $taxId;
	public $requestId;

	public function Create($customer){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/create/",$customer, "Customer");
		return $model;	
	}

	public function Deactivate($customer){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/deactivate/",$customer, "Customer");
		return $model;	
	} 

	public function Get($customerId){
		$requestor = new Requestor();
		$model = $requestor->Get("/customer/get/".$customerId, "Customer");
		return $model;
	}

	public function GetByTag($tag){
		$requestor = new Requestor();
		$model = $requestor->Get("/customer/getByTag/".$tag, "Customer");
		return $model;
	}

	public function Initiate($customer){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/initiate/",$customer, "Customer");
		return $model;	
	}

	public function ListAll($pageNumber=0, $pageSize=200){
		$requestor = new Requestor();
		$model = $requestor->Get("/customer/list/?pageNumber=".$pageNumber."&pageSize=".$pageSize, "Customer");
		return $model;
	}

	public function Search($searchParameters, $pageNumber, $pageSize){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/search/?pageNumber=".$pageNumber."&pageSize=".$pageSize, $searchParameters, "Customer");
		return $model;
	} 

	public function Update($customer){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/update/",$customer, "Customer");
		return $model;	
	}

	public function Verify($customer){
		$requestor = new Requestor();
		$model = $requestor->Post("/customer/verify/",$customer, "Customer");
		return $model;	
	}

}
?>