<?php
//ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
//ini_set('max_execution_time', '0'); // for infinite time of execution 

class MersenneNumberFinder
{
    public $rangeOfNumbers;
    public const VALIDATOR_CHECKPOINTS = 2;

    public function __construct(array $rangeOfNumbers)
    {
        if(!empty($this->rangeNumbersValidate())){
            $this->displayErrors();
            die;
        }
        
        $this->startNumber = (int) $rangeOfNumbers["start"];
        $this->stopNumber = (int) $rangeOfNumbers["stop"];
    }

    private function rangeNumbersValidate(): array
    {
        $checkPoints = 0;
        $errorsHandler = [];

        if($this->startNumber >= 2){
            $checkPoints + 1;
        } else {
            $errorsHandler[] = 'The starting number cannot be smaller than 2';
        }

        if($this->stopNumber > $this->startNumber){
            $checkPoints + 1;
        } else {
            $errorsHandler[] = 'The ending number cannot be less than or equal to the starting number';
        }

        return $checkPoints === self::VALIDATOR_CHECKPOINTS
            ? []
            : $errorsHandler;
    }

    private function displayErrors(): void
    {
        foreach ($this->rangeNumbersValidate() as $key => $value) {
            echo $value . '<br>';
        }
    }

    public function listOfMersenneNumber()
    {
        $primeNumber = array_fill($this->startNumber, ($this->stopNumber - $this->startNumber) + 1, true);

        $this->sieveOfEratosthenes($primeNumber);

        $start = 2;
        $num = (1 << $start) - 1;
        while ($num <= $this->stopNumber)
        {
            if ($primeNumber[$num])
            {
                printf("%d\n",$num);
            }
            $start += 1;
            $num = (1 << $start) - 1;
        }
    }

    private function sieveOfEratosthenes(&$primeNumber): void
    {
        $prime[0] = false;
        $prime[1] = false;
        
        for ($i = 2; $i * $i <= $this->stopNumber; ++$i)
        {
            if ($prime[$i])
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

