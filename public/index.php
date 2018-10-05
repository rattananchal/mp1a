<?php
/**
 * Created by PhpStorm.
 * User: anchal
 * Date: 10/4/18
 * Time: 2:37 PM
 */
 main :: start();
class main
{
    public static function start()
    {
        $records = csv :: getRecords();
        $table = html :: generateTable($records);
        system :: printTable($table);
    }
}
class csv {
    public static function getRecords()
    {
        $rec1 = ' testing the function run';
        return $rec1;
    }
}

class html {
    public static function generateTable($record)
    {
        $table = $record;
        return $table;
    }
}
class system {
    public static function printTable ($table)
    {
        echo $table;
    }
}