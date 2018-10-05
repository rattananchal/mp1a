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
        $make = 'Audi';
        $model = 'A4';
        $cars = AutomobileFactory::create($make, $model);
        // print_r($cars);
        $rec1 [] = $cars;
        print_r ($rec1);
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



class Automobile
{
    private $vehicleMake;
    private $vehicleModel;

    public function __construct($make, $model)
    {
        $this->vehicleMake = $make;
        $this->vehicleModel = $model;
    }

    public function getMakeAndModel()
    {
        return $this->vehicleMake . ' ' . $this->vehicleModel;
    }
}

class AutomobileFactory
{
    public static function create($make, $model)
    {
        return new Automobile($make, $model);
    }
}