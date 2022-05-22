# Range Mersenne Number Finder
This program displays the Mersenne numbers that fall within a given range of numbers


To run the script locally in the linux system, just run it on any port:

    php -S localhost:8001
then enter the indicated local address in the web browser.


In order to set the number range of interest to us, complete the variables `$start` and `$stop` in the `MersenneNumberFinder` class

```
$start =  2;
$stop =  9999;

$rangeOfNumbers = [
	'start'  => $start,
	'stop'  => $stop
];
```
The mersenne numbers found in the specified range then appear on the screen.

Example:
`3 7 15 31 63 127 255 511 1023 2047 4095 8191`

In case you want to search among a large range of numbers, it is worth uncommenting this line of code:
```
//ini_set('max_execution_time', '0');
```

This removes the default php script execution time limit (30 seconds).
