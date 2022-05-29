<?php
/*
 * Created by Waldemar Graban 2022
 */

//ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
//ini_set('max_execution_time', '0'); // for infinite time of execution 

class MersenneNumberFinder
{
    public $rangeOfNumbers;
    protected const VALIDATOR_CHECKPOINTS = 2;
    protected const MIN_STARTING_NUMBER = 2;

    public function __construct(array $rangeOfNumbers)
    {
        if($this->isRangeNumbersValidate($rangeOfNumbers)){
            $this->displayErrors($rangeOfNumbers);
            $this->stopScript();
        }
        
        $this->startNumber = (int) $rangeOfNumbers["start"];
        $this->stopNumber = (int) $rangeOfNumbers["stop"];
    }

    private function rangeNumbersValidate(array $rangeOfNumbers): array
    {
        $checkPoints = 0;
        $errorsHandler = [];

        if((int) $rangeOfNumbers["start"] >= self::MIN_STARTING_NUMBER){
            $checkPoints + 1;
        } else {
            $errorsHandler[] = 'The starting number cannot be smaller than ' . self::MIN_STARTING_NUMBER;
        }

        if((int) $rangeOfNumbers["stop"] > (int) $rangeOfNumbers["start"]){
            $checkPoints + 1;
        } else {
            $errorsHandler[] = 'The ending number cannot be less than or equal to the starting number';
        }

        return $checkPoints === self::VALIDATOR_CHECKPOINTS
            ? []
            : $errorsHandler;
    }

    private function displayErrors(array $rangeOfNumbers): void
    {
        foreach ($this->rangeNumbersValidate($rangeOfNumbers) as $key => $value) {
            echo $value . '<br>';
        }
    }

    private function stopScript(): void
    {
        exit(); 
    }
	
    private function isRangeNumbersValidate($rangeOfNumbers): bool
    {
        return !empty($this->rangeNumbersValidate($rangeOfNumbers));
    }

    public function listOfMersenneNumber(): void
    {
        $primeNumber = array_fill($this->startNumber, ($this->stopNumber - $this->startNumber) + 1, true);

        $this->sieveOfEratosthenes($primeNumber);
		
        $start = 2;
        $num = (1 << $start) - 1;
        while ($num <= $this->stopNumber)
        {
            if (isset($primeNumber[$num]))
            {
                printf("%d\n",$num);
            }
            $start += 1;
            $num = (1 << $start) - 1;
        }
    }

    private function sieveOfEratosthenes(array &$primeNumber): void
    {
        $prime[0] = false;
        $prime[1] = false;
        
        for ($i = 2; $i * $i <= $this->stopNumber; ++$i)
        {
            if (isset($prime[$i]))
            {
                for ($j = $i * $i; $j <= $this->stopNumber; $j += $i)
                {
                    $prime[$j] = false;
                }
            }
        }
    }
}

$start = 2;
$stop = 9999;

$rangeOfNumbers = [
    'start' => $start,
    'stop' => $stop
];

$finder = new MersenneNumberFinder($rangeOfNumbers);
$finder->listOfMersenneNumber();
