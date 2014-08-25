<?php

//see: http://docs.corepro.io/api/customerbeneficiary
 final class CustomerBeneficiary {
 	public $customerBeneficiaryId;
	public $customerId;
	public $lastName;
	public $firstName;
	public $middleName;
	public $taxId;
	public $taxIdMasked;
	public $birthDate;
	public $isActive;

	public function Create($customerBeneficiary){
		$requestor = new Requestor();
		$model = $requestor->Post("/customerBeneficiary/create",$customerBeneficiary, "CustomerBeneficiary");
		return $model;	
	}

	public function Deactivate($customerBeneficiary){
		$requestor = new Requestor();
		$model = $requestor->Post("/customerBeneficiary/deactivate/",$customerBeneficiary, "CustomerBeneficiary");
		return $model;	
	} 

	public function Get($customerId, $customerBeneficiary){
		$requestor = new Requestor();
		$model = $requestor->Get("/customerBeneficiary/get/".$customerId."/".$customerBeneficiary, "CustomerBeneficiary");
		return $model;
	}

	public function ListAll($customerId, $pageNumber=0, $pageSize=200){
		$requestor = new Requestor();
		$model = $requestor->Get("/customerBeneficiary/list/".$customerId."?pageNumber=".$pageNumber."&pageSize=".$pageSize, "CustomerBeneficiary");
		return $model;
	}

	public function Update($customerBeneficiary){
		$requestor = new Requestor();
		$model = $requestor->Post("/customerBeneficiary/update/",$customerBeneficiary, "CustomerBeneficiary");
		return $model;	
	} 
}
?>