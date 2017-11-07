<?php
/**
 * Created by PhpStorm.
 * User: ryann_000
 * Date: 18/08/2017
 * Time: 05:03 PM
 */

//error_reporting(0);

require_once("class_NoughtsCrosses.php");
require_once("DB.php");

$class = new NoughtsCrosses;

if ($argv[1] == 'results') {
    echo $class->get_aggregate_results();
}
else if ($argv[1] == 'calculate') {
$class->calculate_winners(STDIN);
echo $class->get_results();
}
else
{



    echo "USAGE: noughtscrosses.php [ACTION]
    Actions:
        results - Output all-time results from all games ever.
        calculate - Calculate results from round of games provided
        via STDIN.
";
}




class NoughtsCrosses {


    public $rowsFromFile = array();
    public $splitcolumns = array();
    public $games = array();

    public function __construct(){

        $input = <<<EOT
XOX
XXO
OOX


XOX
XXO
OOO
EOT;

        preg_match_all("/.../", $input, $array);
        $this->rowsFromFile = $array;
        $this->createDatabaseConnection();
        $this->splitGames($this->rowsFromFile);


    }

    public function splitGames($rowList){

        $id = 0;
        foreach($rowList[0] as $element => $value)
        {
            if ($element % 3 == 2)
            {
                $element = $element - 2;
                $id++;
                echo "This is game $id \n";
                $tempString = "";
                for ($x = 0; $x <= 2; $x++)
                {

                    echo $rowList[0][$element] . "\n";
                    $this->games[$id -1 ][] = $rowList[0][$element];
                    $tempString.= $rowList[0][$element];
                    $element = $element + 1;
                }

            }

        }
        print_r($rowList);
        print_r($this->games);
        print_r($this->splitColumns);
    }

    public function splitColumns($gameID)
    {
        return preg_split('//', $this->games[0][$gameID], -1, PREG_SPLIT_NO_EMPTY);
    }

    public function createDatabaseConnection(){
        $db = DB::getInstance();
        $db->query("CREATE TABLE newtable (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        gamecode VARCHAR(10) NOT NULL)");
    }

    public function get_aggregate_results(){

    }

    public function calculate_winners(){

    }

    public function get_results(){

    }



}
