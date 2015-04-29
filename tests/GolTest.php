<?php
require_once 'gol.php';
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
class GoLTest extends PHPUnit_Framework_TestCase
{
    // ...

    public function testStillLife()
    {
        $stillLife= [[0,0,0,0,0],
          	     [0,1,1,0,0],
         	     [0,1,1,0,0],
          	     [0,0,0,0,0],
          	     [0,0,0,0,0]];
        $a = new GoL($stillLife);

        // Act
        $b = $a->iterate(10);

        // Assert
        $this->assertEquals($stillLife, $b);
    }

    public function testBlinker()
    {
	$ticker1 = [[0,0,0,0,0],
            	    [0,0,1,0,0],
            	    [0,0,1,0,0],
            	    [0,0,1,0,0],
            	    [0,0,0,0,0]];

	$ticker2 = [[0,0,0,0,0],
		    [0,0,0,0,0],
		    [0,1,1,1,0],
		    [0,0,0,0,0],
		    [0,0,0,0,0]];
	$a = new GoL($ticker1);

        $b = $a->iterate();

        $this->assertEquals($ticker2, $b);
    }

    public function testGlider()
    {
	$glider1 = [[0,0,0,0,0,0,0],
        	    [0,0,1,0,0,0,0],
	            [1,0,1,0,0,0,0],
	            [0,1,1,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0]];

	$glider2 = [[0,0,0,0,0,0,0],
	            [0,1,0,0,0,0,0],
	            [0,0,1,1,0,0,0],
	            [0,1,1,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0]];

	$glider3 = [[0,0,0,0,0,0,0],
	            [0,0,1,0,0,0,0],
	            [0,0,0,1,0,0,0],
	            [0,1,1,1,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0]];

	$glider4 = [[0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,1,0,1,0,0,0],
	            [0,0,1,1,0,0,0],
	            [0,0,1,0,0,0,0],
	            [0,0,0,0,0,0,0],
	            [0,0,0,0,0,0,0]];
    

	$glider = new GoL($glider1);

	$gliderRes = $glider->iterate();

	$this->assertEquals($gliderRes, $glider2);

        $gliderRes = $glider->iterate();

        $this->assertEquals($gliderRes, $glider3);

        $gliderRes = $glider->iterate();

        $this->assertEquals($gliderRes, $glider4);

        $glider = new GoL($glider1);

        $gliderRes = $glider->iterate(3);

        $this->assertEquals($gliderRes, $glider4);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testWrongInput(){
	$a = new GoL('holaaaaa');
    }

    public function testAliveNotOne(){
        $ticker1 = [[0,0,0,0,0],
                    [0,0,20,0,0],
                    [0,0,30,0,0],
                    [0,0,-1,0,0],
                    [0,0,0,0,0]];

        $ticker2 = [[0,0,0,0,0],
                    [0,0,0,0,0],
                    [0,1,1,1,0],
                    [0,0,0,0,0],
                    [0,0,0,0,0]];

        $a = new GoL($ticker1);

        $b = $a->iterate();

        $this->assertEquals($ticker2, $b);
    }
}

