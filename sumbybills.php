<?php
//php sumbybills.php *enter your sum here*

function billNumber(int $amount)
{
    $denominations = array (500, 200, 100, 50, 20, 10, 5, 2, 1);
    foreach ($denominations as $denomination) 
    {
        if ($amount >= $denomination) 
        {
            $numOfBills = (int)($amount / $denomination);
            if ($numOfBills > 0) 
            {
                $amount %= $denomination;
                echo "$denomination: $numOfBills\n";
            }
        }
    }
}

$amount = (int)$argv[1];
if ($amount >= 1 && $amount <= 100000) 
{
    billNumber($amount);
} 
else 
{
    echo "Please enter amount from 1 to 100000";
}
