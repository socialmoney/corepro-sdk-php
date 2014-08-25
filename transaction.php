<?php

//see: http://docs.corepro.io/api/transaction
 final class Transaction {
 	public $transactionCount;
	public $transactionId;
	public $customerId;
	public $type;
	public $typeCode;
	public $tag;
	public $friendlyDescription;
	public $nachaDescription;
	public $status;
	public $createdDate;
	public $amount;
	public $settledDate;
	public $availableDate;
	public $voidedDate;
	public $returnCode;	 

	public function ListAll($customerId, $accountId, $beginDate, $endDate, $pageNumber=0, $pageSize=200){
		$requestor = new Requestor();
		$model = $requestor->Get("/transaction/list/".$customerId."/".$accountId."/".$beginDate."/".$endDate."?pageNumber=".$pageNumber."&pageSize=".$pageSize, "Transaction");
		return $model;
	}
	 
}
?>