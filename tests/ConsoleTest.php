<?php

namespace tests;

use Drips\CLI\Console;
use PHPUnit_Framework_TestCase;

class ConsoleTest extends PHPUnit_Framework_TestCase
{
    public function testConsoleOutput()
    {
        $str = "Hello World";
        ob_start();
        Console::write($str);
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($str, $content);
    }

    public function testConsoleNlOutput()
    {
        $str = "Hello World";
        ob_start();
        Console::writeln($str);
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($str.PHP_EOL, $content);
    }

    public function testBgColor()
    {
        Console::setBgColor("red");
        Console::writeln("Rot");
        Console::reset();
    }

    public function testSuccessOutput()
    {
        Console::success("Success");
    }

    public function testErrorOutput()
    {
        Console::error("Error");
    }
}
