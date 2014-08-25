<?php

//see: http://docs.corepro.io/api/Program/
class Program {
	public $allowedAccountType;
	public $decimalCount;
	public $filledDate;
	public $isInteresteEnabled;
	public $isInternalToInternalTransferEnabled;
	public $isRecurringContributionEnabled;
	public $name;
	public $perProgramDailyDepositLimit;
	public $perProgramDailyWithdrawLimit;
	public $perTransactionDepositLimit;
	public $perTransactionWithdrawLimit;
	public $perUserDailyDepositLimit;
	public $perUserDailyWithdrawLimit;
	public $perUserMonthlyDepositLimit;
	public $perUserMonthlyWithdrawLimit;
	public $regDFeeAmount;
	public $regDMonthlyTransactionWithdrawCountMax;
	public $timeZone;
	public $verificationType;
	public $website;

	public function Get(){
		$requestor = new Requestor();
		$model = $requestor->Get("/program/get", "Program");
		return $model;
	}
}

?>