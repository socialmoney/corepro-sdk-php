<?php

include("config.php");
include("models/envelope.php");
include("models/error.php");
include("models/apiexception.php");
include("models/address.php");
include("models/phone.php");
include("models/limit.php");
include("models/externalaccounttrialdeposits.php");
include("utils/requestor.php");
include("account.php");
include("customer.php");
include("customerbeneficiary.php");
include("externalaccount.php");
include("document.php");
include("customerdocument.php");
include("externalaccountdocument.php");
include("program.php");
include("transaction.php");
include("transfer.php");
include("statement.php");

//test specific items
	$ticks = microtime(true);
	$TESTNAME='phpSDK'.$ticks;
	$lastExternalAccountId=0;
	$customerId=2653; 
try{
	echo("\nCoreProAPI::CUSTOMER");
	echo("\r\n");
	$customer = new Customer();
	$customer = $customer->Get($customerId);

	$customer->emailAddress=$TESTNAME;
	$customer->Update($customer);

	$c= new Customer();
	$c->lastName="McTester2014-08-19 09:47:42 -0500";
	$results = $customer->Search($c, $pageSize=0, $pageNumber=100);

	foreach($results as $key => $value){
		print_r($value);
	}
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}

try{

	echo("\nCoreProAPI::ACCOUNT");
	echo("\r\n");

	$a = new Account();
	$accounts = $a->listAll($customerId);
	foreach($accounts as $key => $value){
		print_r($value);
	}
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}

try{

	echo("\nCoreProAPI::CUSTOMERBENEFICIARY");
	echo("\r\n");

	$cb = new CustomerBeneficiary();
	$cb->CustomerId=$customerId;
	$cb->firstName = "PHP".$ticks;
	$cb->lastName = "PHP".$ticks;
	$cb->taxId = "012341234";
	$cb->birthDate = "1975-07-14T00:00:00.000+00:00";
	$cb->Create($cb);

	$beneList = $cb->listAll($customerId);
	foreach($beneList as $key=>$value){
		print_r($value);
	}	
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}

try{
	echo("\nCoreProAPI::EXTERNALACCOUNT");
	echo("\r\n");
	$ea = new ExternalAccount();
	$externalAccountsList = $ea->ListAll($customerId);


	foreach($externalAccountsList  as $key=>$value){
		$lastExternalAccountId = $value->externalAccountId;
	}
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::DOCUMENT");
	echo("\r\n");
	$d = new Document();	
	$documentList = $d->ListAll("en-US");
	foreach($documentList as $key=>$value){
		print_r($value);
		//$raw = $d->Download("en-US", $value->documentId);
		//var_dump($raw);
	}
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::CUSTOMERDOCUMENT");
	echo("\r\n");
	$cdox = new CustomerDocument();
	$cdox->customerId = $customerId;
	$cdox->documentName=$TESTNAME.".jpg";
	$cdox->documentType = "BankStatement";
	$cdox->reasonType="Unspecified";
	$cdox->documentContent = "dGVzdA==";
	$cdox->upload($cdox);
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::EXTERNALACCOUNTDOCUMENT");
	echo("\r\n");
	$eadox = new ExternalAccountDocument();
	$eadox->customerId = $customerId;
	$eadox->externalAccountId = $lastExternalAccountId;
	$eadox->documentName=$TESTNAME.".jpg";
	$eadox->documentType = "BankStatement";
	$eadox->reasonType="Unspecified";
	$eadox->documentContent = "dGVzdA==";
	$eadox->upload($eadox);
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::PROGRAM");
	echo("\r\n");
	$program = new Program();
	$program = $program->Get();
	var_dump($program);
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}

try{
	echo("\nCoreProAPI::TRANSACTION");
	echo("\r\n");
	$transactions = new Transaction();
	$transactions= $transactions->ListAll($customerId, $lastExternalAccountId, "2014-03-01","2024-03-01");
var_dump($transactions);
	foreach($transactions as $key=>$value){
print_r($value);
	}

}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::TRANSFER");
	echo("\r\n");
	$xfer = new Transfer();
	$xfer->CustomerId= $customerId;
	$xfer->Amount = 1.00;
	$xfer->Tag = $TESTNAME;
	$xfer->ToId = $lastExternalAccountId;
	$xfer->FromId = $lastExternalAccountId;
	$xfer=$xfer->Create($xfer);
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}


try{
	echo("\nCoreProAPI::STATEMENTS");
	echo("\r\n");
	$statements = new Statement();
	$statements = $statements->ListAll($customerId);
	var_dump($statements);
	foreach($statements as $key=>$value){
		print_r($value);
	}
}catch(ApiException $e){
	echo 'Caught Exception: '.$e->GetAllErrorInfo();
	echo("\r\n");
}

 

?>
