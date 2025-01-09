<?php 
class BankAccount 
{
    private $balance;
    private $naam;

    public function __construct($naam,$balance)
    { 
        $this->balance=$balance;
        $this->naam=$naam;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }

   
    public function getNaam(){
        return $this->naam;
    }
    
    
    

    
}



?>
