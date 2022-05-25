<?php

class MersenneNumberIdentifier
{
    public int $checkedNumber;

    public function isMersenneNumber(int $checkedNumber): bool
    {
        return $this->numberChecker($checkedNumber);
    }

    private function numberChecker(int $checkedNumber): bool
    {
        $n1 = $checkedNumber + 1;
        $p = 0;
        $ans = 0;

        for ($i=0;; $i++) { 
            $p = (int) pow(2, $i);

            if($p > $n1) break;
            elseif ($p == $n1) $ans = 1;
        }

        return $ans > 0
            ? true
            : false;
    }

}
$number = 127;

$identifier = new MersenneNumberIdentifier();
$identifier->isMersenneNumber($number);
