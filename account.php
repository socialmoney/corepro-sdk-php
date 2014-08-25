<?php

//see: http://docs.corepro.io/api/account/
 final class Account {
	public $accountId;
	public $customerId;
	public $tag;
	public $name;
	public $accountNumber; 
	public $accountNumberMasked;
	public $routingNumber;
	public $status;
	public $type;
	public $createdDate;
	public $closedDate;
	public $accountBalance;
	public $availableBalance;
	public $isPrimary;
	public $isCloseable;
	public $recurringContriubtionType;
	public $recurringContributionAmount;
	public $recurringContributionFromExternalAccountId;
	public $recurringContributionStartDate;
	public $recurringContributionEndDate;
	public $recurringContributionNextDate;
	public $targetAmount;
	public $targetdate;
	public $category;
	public $subCategory;
	public $miscellaneous;
	public $requestId;

	public function Create($account){
		$requestor = new Requestor();
		$model = $requestor->Post("/account/create/",$account, "Account");
		return $model;	
	}

	public function Close($account){
		$requestor = new Requestor();
		$model = $requestor->Post("/account/close/",$account, "Account");
		return $model;	
	} 

	public function Get($accountId){
		$requestor = new Requestor();
		$model = $requestor->Get("/account/get/".$accountId, "Account");
		return $model;
	}

	public function GetByTag($customerId, $tag){
		$requestor = new Requestor();
		$model = $requestor->Get("/customer/getByTag/".$customerId."/".$tag, "Account");
		return $model;
	}

	public function ListAll($customerId, $pageNumber=0, $pageSize=200){
		$requestor = new Requestor();
		$model = $requestor->Get("/account/list/".$customerId."?pageNumber=".$pageNumber."&pageSize=".$pageSize, "Account");
		return $model;
	}

	public function Update($account){
		$requestor = new Requestor();
		$model = $requestor->Post("/account/update/",$account, "Account");
		return $model;	
	}
}
?>