<?php

$input = <<<EOT
OOO
XOX
XOX


XOO
XXO
XXO


XOX
OXO
XOX


XOX
XOO
OXX
EOT;

// set separator to platform dependent line break
$separator = PHP_EOL;

// create an array mask so that we can check each position easily
$masks = array();
for ($i = 0; $i < 3; $i++) {
    array_push($masks, array(array($i, 0), array($i, 1), array($i, 2)));
    array_push($masks, array(array(0, $i), array(1, $i), array(2, $i)));
}
array_push($masks, array(array(0, 0), array(1, 1), array(2, 2)));
array_push($masks, array(array(0, 2), array(1, 1), array(2, 0)));


class NoughtsCrossesState {

    // initialize state
    private $state;
    public $gamesPlayed = 0;
    public $X_wins = 0;
    public $O_wins = 0;
    public $draws = 0;




    // call the parseGame function with state string parameter, our game input
    function __construct($stateStr)
    {
        $this->state = NoughtsCrossesState::parseGame($stateStr);
    }

    // parse our string into an array
    private static function parseGame($stateStr) {
        return array(
            array($stateStr[0], $stateStr[1], $stateStr[2]),
            array($stateStr[3], $stateStr[4], $stateStr[5]),
            array($stateStr[6], $stateStr[7], $stateStr[8]),
        );
    }

    // compare our array to our mask grid
    public function getWinner() {
        global $masks;

        for ($i = 0, $len = count($masks); $i < $len; $i++) {
            $cell0 = $masks[$i][0];
            $cell1 = $masks[$i][1];
            $cell2 = $masks[$i][2];

            $value0 = $this->state[$cell0[0]][$cell0[1]];
            $value1 = $this->state[$cell1[0]][$cell1[1]];
            $value2 = $this->state[$cell2[0]][$cell2[1]];

            // if first value equals 1st and 2nd, we have 3 in a row
            if ($value0 == $value1 && $value0 == $value2) {
                // return our winner X or O

                return $value0;

            }
            else if ($value0 != $value1 && $value1 == $value2) {

                return "DRAW";
            }



        }
        return null;
    }

    public function addWinner($winner)
    {

        switch ($winner) {
            case "O":
                // Add to O array
               $this->O_wins++;
            break;
            case "X":
                // Add to X array
                $this->X_wins++;
                break;
            case "DRAW";
                // Add to DRAW array
                $this->draws++;
                break;
            default:
                echo "No Outcome";
        }
        $this->gamesPlayed++;


    }



    // returns formatted string when class is called with $stateStr
    public function __toString()
    {
        $str = '';
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $str .= $this->state[$i][$j];
            }
            $str .= PHP_EOL;
        }
        return $str;

    }


}

// gets input and separator, split our string by the new line separators
// create new game object, pass our split string into it
//
function main() {

    global $input, $separator;
    $stateStr = strtok($input, $separator);


    while ($stateStr !== false) {
        $stateStr .= strtok($separator);
        $stateStr .= strtok($separator);
        $game = new NoughtsCrossesState($stateStr);
        print('Game:'.PHP_EOL);
        print($game);
        print('Winner: '.$game->getWinner().PHP_EOL);
        $game->addWinner($game->getWinner());
        $stateStr = strtok($separator);


    }

    var_dump($game->gamesPlayed);

}


main();
