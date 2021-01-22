<?php
require_once('classes/Board.php');
require_once("classes/pieces/ChessPiece.php");
require_once("classes/MoveException.php");
require_once("classes/Square.php");
require_once("classes/ColourConsole.php");
require_once("classes/pieces/AbstractChessPiece.php");
require_once("classes/pieces/Bishop.php");
require_once("classes/pieces/King.php");
require_once("classes/pieces/Knight.php");
require_once("classes/pieces/Pawn.php");
require_once("classes/pieces/Player.php");
require_once("classes/pieces/Queen.php");
require_once("classes/pieces/Rook.php");

$cheaterTaunts=array(
    'Woah! Go easy on that vodka there buddy.',
    'You\'re nothing without your Librium.',
    'You\'re too pretty to take seriously.'
);

echo "Welcome to chess!!!\n";
echo "Hit ctrl-c to exit. Don't forget The Queen's Gambit.\n";
$board=new Board();
while(true){
    echo $board;
    echo "Move (format 'start x, start y, end x, end y'): ";
    $line = strtolower(trim(fgets(STDIN)));
    $force=false;
    if($line==='the queen\'s gambit'){  //cheater using a cheat code, taunt them a bit and move on
        $force=true;
        echo $cheaterTaunts[array_rand($cheaterTaunts)]."\n Move (format 'start x, start y, end x, end y'): ";
        $line = strtolower(trim(fgets(STDIN)));
    }
    $componentsOfMove=explode(',',$line);
    try{
        if(count($componentsOfMove)!==4){
            throw new Exception("Unexpected number of commas.") ;
        }
        echo $board->move(
            parseInt($componentsOfMove[0]),
            parseInt($componentsOfMove[1]),
            parseInt($componentsOfMove[2]),
            parseInt($componentsOfMove[3]),
            $force)."\n";
    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage()."\n";
    }
    sleep(1);//delay the next render 1 second so the user notices what we said
}

/**
 * @param $stringNumber
 * @return int
 * @throws Exception on a string that can't be converted to an integer
 */
function parseInt($stringNumber): int
{
    $stringNumber=trim($stringNumber);
    if(is_numeric($stringNumber)){
        return intval($stringNumber);
    }
    throw new Exception('Invalid coordinate: '.$stringNumber);
}
