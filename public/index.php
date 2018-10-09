
<?php


main::start("example.csv");

class main{

    static public function start($fileRec){



        $records = csv::getRecords($fileRec);

        $tables = html::genTable($records);

        $structure = html::htmlStruct($tables);

        generate::printPage($structure);

    }
}

class html
{

    public static function genTable($records){

        $tab = '<table class="table table-striped" border="1">';

        $tab .= row::createTabRow($records);
        $tab .= '</table>';
        return $tab;
    }
    public static function htmlStruct ($table)
    {   //$table =  self::genTable();
        $htmlSt = ' <!DOCTYPE html>
                <html>
                <head>
                <title>CSV File Reader</title>
               <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
              
                </head>
                <body>'.$table.'</body>
                </html> ';

        return $htmlSt;

    }

}



class row{
    public  static function createTabRow($records)
    {
        $a =0;
        $tableVal = "";
        $flags = true;
        foreach ($records as $key => $value) {
            $tableVal .= "<tr class= \"<?=($a++%2==1) ? 'odd'  : ''; ?>\">";
            foreach ($value as $key2 => $value2) {
                if($flags){
                    $tableVal .= "<th>".htmlspecialchars($value2)."</th>";

                }else{
                    $tableVal .= '<td>' . htmlspecialchars($value2) . '</td>';
                }
            }
            $flags = false;
            $tableVal .= "</tr>";
        }

        return $tableVal;

    }
}

class tableFactory{

    public static function build(Array $row = null, Array $values  = null)
    {

        $table =new table($row , $values);

        return $table;

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

class generate{

    public static function printPage($page){

        echo $page;
    }

}

