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
    public static function start ()
    {
        echo "test";
        $filerecev = "example.csv";

        $records = csv :: getRecords ($filerecev);
        //$rec = recordFactory::create();

        $table = html :: genTable ($records);


        //print_r($records);
        //print_r($rec);

    }
}

class csv
{
    public static function getRecords($filename)
    {
        $file = fopen($filename, "r");
        $fieldOne = array() ;
        $count = 0;
        while (! feof ($file))
        {
            $curLine = fgetcsv($file);

            if ($count == 0)
                $fieldOne = $curLine;
            else
                $lines[] = recordFactory::create($fieldOne, $curLine);

            $count++;
        }
        fclose ($file);
        return($lines);
    }
}

class html
{
    public static function genTable ( $records )
    {
        $count = 0;

        foreach ($records as $rec)
        {
            if ($count ==0)
            {
                $ar = $rec->retArray();
                $field = array_keys($ar);
                $fvalue = array_values($ar);
                print_r($field);
                print_r($fvalue);
            }
            else
            {
                $ar = $rec->retArray();
                $fvalue = array_values($ar);
                print_r($fvalue);
            }
           $count ++;
            /* $key = array_keys($ar);
            print_r($key); */
        }
    }
}


class record {
    public function __construct(Array $fieldNames = null, $rec = null)
    {   /*print_r($fieldNames);
        print_r($values);
        */
        $arrayCom = array_combine($fieldNames, $rec);

        foreach ($arrayCom as $property => $value)
        {
            $this -> createProp($property, $value);
        }
        /*print_r($arrayCom);
        $this -> createProp();
        print_r($this); */

    }

    public function retArray ()
    {
        $array = (array) $this ;
        return $array ;
    }

    public function createProp ($name ='First', $value = 'Keith')
    {
        $this -> {$name} = $value ;
    }
}

class recordFactory
{
       public static function create (Array $fieldNames = null, Array $values = null)
    {
        $record = new record($fieldNames, $values);
        //print_r($fieldNames);
        //print_r($record);
        return $record;
    }

}
