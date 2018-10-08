
<?php


main::start("example.csv");

class main{

    static public function start($fileRec){



        $records = csv::getRecords($fileRec);

        $tables = html::genTable($records);

        system::printPage($tables);

    }
}

class html
{

    public static function genTable($records){

        $table = '<table class="table table-striped" border="1">';

        $table .= row::tableRow($records);
        $table .= '</table>';
        return $table;
    }

}



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
            $line=fgetcsv($file);

            if($count==0) {

                $fieldNames = $line;
                $records[] = recordFactory::create($fieldNames, $fieldNames);
            }
            else {
                $records[] = recordFactory::create($fieldNames, $line);
            }
            $count++;
        }

        fclose($file);

        return $records;

    }
}

class record{

    public function __construct(Array $fieldNames = null , $values = null){

        $arrayComb = array_combine($fieldNames, $values);

        foreach ($arrayComb as $property => $value) {
            $this->createProp($property, $value);
        }
    }
    public function ReturnArray(){

        $array= (array) $this;

        return $array;
    }

    public function createProp($name = 'First', $value = 'Anchal'){
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

