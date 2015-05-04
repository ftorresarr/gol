# PHP Conway's Game of Life
PHP5.4+

Little class to compute n generations of a given world

It accepts an array of any size with 1 (alive) or 0 (dead)

Example
```php
<?php
$blinker = [[0,0,0,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,0,0,0]];
$gol = new GoL($blinker);
$blinker1 = $gol->iterate();
```

It is possible to iterate for n generations as well

```php
<?php
$blinker = [[0,0,0,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,0,0,0]];
$gol = new GoL($blinker);
$blinker10 = $gol->iterate(10);
```

iterate() takes an int for the number of generations, defaults to 1

It´s possible to change the world without reinstantiating
```php
<?php
$blinker = [[0,0,0,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,1,0,0],
            [0,0,0,0,0]];
$gol = new GoL($blinker);
$blinker10 = $gol->iterate(10);
$stillLife = [[0,0,0,0,0],
              [0,1,1,0,0],
              [0,1,1,0,0],
              [0,0,0,0,0],
              [0,0,0,0,0]]
$stillLife5 = $gol->setGenData($stillLife)->iterate(5);
```

The "example/" folder contains (you guessed it) an example of its usage. It's a little js/html/css frontend that makes a request to golex.php which simply recieves the data, instantiates and returns. It has a "PRINT ARRAY" button that can be used to generate valid data for the class (PHP5.4+)  

Please execute the unit tests by running the following command on the project's main folder

```
phpunit tests/GoLTest.php
```

The class comments will be changed to english eventually.
