<?php 

include 'BankAccount.php';

class SavingAccount extends BankAccount
{
    private $interestRate;

    public function setInterestRate($interestRate) {
        $this->interestRate = $interestRate;
    }
    
    public function addInterest() {
        // Calculate interest
        $interest = $this->interestRate * $this->getBalance();
        // Deposit interest to the balance
        $this->deposit($interest);
    }
      
    
}