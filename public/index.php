<?php
/**
 * Created by PhpStorm.
 * User: anchal
 * Date: 10/4/18
 * Time: 2:37 PM
 */


<?php


main::start("example.csv");

class main{

    static public function start($filename){



        $records = csv::getRecords($filename);

        $tables = html::generateTable($records);

        system::printPage($tables);

    }
}

class html
{

    public static function generateTable($records){

        $table = '<table-stripped border="1">';

        $table .= row::tableRow($records);
        $table .= '</table>';
        return $table;
    }

}




/* $count = 0;

 foreach ($records as $record){

     if ($count == 0) {

         $array = $record->returnArray();

         $fields = array_keys($array);
         $values = array_values($array);
         print_r($fields);
         print_r($values);
     } else {

         $array = $record->returnArray();
         $values = array_values($array);

         print_r($values);
     }
     $count++;

 }*/


class row{
    public  static function tableRow($records)
    {
        $i=0;
        $flag = true;
        $table = "";
        foreach ($records as $key => $value) {
            $table .= "<tr class= \"<?=($i++%2==1) ? 'odd'  : ''; ?>\">";
            foreach ($value as $key2 => $value2) {
                if($flag){
                    $table .= "<th>".htmlspecialchars($value2)."</th>";

                }else{
                    $table .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
            }
            $flag = false;
            $table .= "</tr>";
        }

        return $table;

    }
}

class tableFactory{

    public static function build(Array $row = null, Array $values  = null)
    {

        $table =new table($row , $values);

        return $table;

    }

}


class csv{

    public static function getRecords($filename){

        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;

        while(! feof($file))
        {
            $record=fgetcsv($file);

            if($count==0) {

                $fieldNames = $record;
                $records[] = recordFactory::create($fieldNames, $fieldNames);
            }
            else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }

        fclose($file);

        return $records;

    }
}

class record{

    public function __construct(Array $fieldNames = null , $values = null){

        $record = array_combine($fieldNames, $values);

        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }
    }
    public function ReturnArray(){

        $array= (array) $this;

        return $array;
    }

    public function createProperty($name = 'First', $value = 'Pritam'){
        $this->{$name} = $value;
    }

}
class recordFactory{

    public static function create(Array $fieldnames = null, Array $values  = null)
    {

        $record=new record($fieldnames , $values);

        return $record;

    }

}
class system{

    public static function printPage($page){

        echo $page;
    }

}




































}