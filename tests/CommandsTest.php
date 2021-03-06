<?php

namespace tests;

use Drips\CLI\Command;
use Drips\CLI\ICommand;
use PHPUnit_Framework_TestCase;

abstract class TestCommand implements ICommand
{
    public static function command1($param = "")
    {
        echo "TestCommand: $param";
    }

    public static function help()
    {
        echo "TestCommand: HELP";
    }
}


class CommandsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider argsProvider
     */
    public function testCommands($args, $result)
    {
        Command::register("test", TestCommand::class);
        $this->assertEquals(Command::execute($args), $result);
    }

    public function testWithoutInterface()
    {
        Command::register("test", CommandsTest::class);
        $this->assertFalse(Command::execute(array()));
    }

    public function testHelp()
    {
        Command::register("test1", TestCommand::class);
        Command::register("test2", TestCommand::class);
        Command::register("test3", TestCommand::class);
        Command::help();
    }

    public function testUnregister()
    {
        Command::register("command", TestCommand::class);
        Command::unregister("command");
    }

    public static function argsProvider()
    {
        return array(
            array(["your_file", "test", "help"], true),
            array(["your_file", "test"], false),
            array(["your_file", "doesNotExist", "help"], false),
            array(["my_file", "test", "command1"], true),
            array(["my_file", "test", "no_command"], false),
            array(["my_file", "test", "command1", "that_is_a_parameter"], true)
        );
    }
}
