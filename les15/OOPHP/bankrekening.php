<?php 

require 'SavingAccount.php';

$account = new SavingAccount("piet",100,0.05);

$account->addInterest();
echo $account->getBalance();
?>