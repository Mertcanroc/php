<?php
include 'BankAccount.php';
class SavingAccount extends BankAccount
{
   private $interestRate;
   public function __construct($naam,$balance, $interestRate)
   {
       parent::__construct($naam,$balance);
       $this->interestRate = $interestRate;
   }
   public function setInterestRate($interestRate)
   {
       $this->interestRate = $interestRate;
   }
   public function addInterest()
   {
       // calculate interest
       $interest = $this->interestRate * $this->getBalance();
       // deposit interest to the balance
       $this->deposit($interest);
   }
}


?>