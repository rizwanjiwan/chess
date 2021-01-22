<?php

class Board
{

    private array $board;

    public function __construct(){
        //init our board. 1st dimension array goes across the x axis and 2nd dimension goes up the y axis.
        // 0,0 is right where you think it is if you were doing cartesian coordinates in grade 10
        $player1=new Player(Player::PLAYER1);
        $player2=new Player(Player::PLAYER2);
        $id=0;
        $this->board=array();
        //column 1:
        $this->board[0]=array(
            new Square(Square::BLACK,new Rook($id++,$player1,1,1)),
            new Square(Square::WHITE,new Pawn($id++,$player1,1,2)),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK,new Pawn($id++,$player2,1,7)),
            new Square(Square::WHITE,new Rook($id++,$player2,1,8)),
        );
        //column 2:
        $this->board[1]=array(
            new Square(Square::WHITE,new Knight($id++,$player1,2,1)),
            new Square(Square::BLACK,new Pawn($id++,$player1,2,2)),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE,new Pawn($id++,$player2,2,7)),
            new Square(Square::BLACK,new Knight($id++,$player2,2,8)),
        );
        //column 3:
        $this->board[2]=array(
            new Square(Square::BLACK,new Bishop($id++,$player1,3,1)),
            new Square(Square::WHITE,new Pawn($id++,$player1,3,2)),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK,new Pawn($id++,$player2,3,7)),
            new Square(Square::WHITE,new Bishop($id++,$player2,3,8)),
        );
        //column 4:
        $this->board[3]=array(
            new Square(Square::WHITE,new King($id++,$player1,4,1)),
            new Square(Square::BLACK,new Pawn($id++,$player1,4,2)),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE,new Pawn($id++,$player2,4,7)),
            new Square(Square::BLACK,new King($id++,$player2,4,8)),
        );
        //column 5:
        $this->board[4]=array(
            new Square(Square::BLACK,new Queen($id++,$player1,5,1)),
            new Square(Square::WHITE,new Pawn($id++,$player1,5,2)),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK,new Pawn($id++,$player2,5,7)),
            new Square(Square::WHITE,new Queen($id++,$player2,5,8)),
        );
        //column 6:
        $this->board[5]=array(
            new Square(Square::WHITE,new Bishop($id++,$player1,6,1)),
            new Square(Square::BLACK,new Pawn($id++,$player1,6,2)),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE,new Pawn($id++,$player2,6,7)),
            new Square(Square::BLACK,new Bishop($id++,$player2,6,8)),
        );
        //column 7:
        $this->board[6]=array(
            new Square(Square::BLACK,new Knight($id++,$player1,7,1)),
            new Square(Square::WHITE,new Pawn($id++,$player1,7,2)),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK,new Pawn($id++,$player2,7,7)),
            new Square(Square::WHITE,new Knight($id++,$player2,7,8)),
        );
        //column 8:
        $this->board[7]=array(
            new Square(Square::WHITE,new Rook($id++,$player1,8,1)),
            new Square(Square::BLACK,new Pawn($id++,$player1,8,2)),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE),
            new Square(Square::BLACK),
            new Square(Square::WHITE,new Pawn($id++,$player2,8,7)),
            new Square(Square::BLACK,new Rook($id++,$player2,8,8)),
        );
    }

    /**
     * Move a piece
     * @param int $startX the start x coord
     * @param int $startY the start y coord
     * @param int $endX the start x coord
     * @param int $endY the end y coord
     * @param bool $force true to force a move regardless of the piece's mobility.
     * @return string move details that are
     * @throws MoveException if the move is invalid.
     */
    public function move(int $startX, int $startY, int $endX, int $endY, bool $force):string
    {
        //adjust everything to start from zero because humans count from one but computers count from 0.🤷🏾‍
        $startXAdj=$startX-1;
        $startYAdj=$startY-1;
        $endXAdj=$endX-1;
        $endYAdj=$endY-1;
        //on the board?
        if(!$this->isOnBoard($startXAdj)||!$this->isOnBoard($startYAdj)||!$this->isOnBoard($endXAdj)||!$this->isOnBoard($endYAdj)){
            throw new MoveException('Move is off the board');
        }
        //get the squares
        $sourceSquare=$this->getSquare($startXAdj,$startYAdj);
        $targetSquare=$this->getSquare($endXAdj,$endYAdj);
        if($sourceSquare->isEmpty()){   //can't move nothing
            throw new MoveException('There is no piece at ('.$startX.', '.$startY.')');
        }
        //move!
        $sourceSquare->movePiece($startXAdj,$startYAdj,$endXAdj,$endYAdj,$force);
        $this->setSquare($startXAdj,$startYAdj,new Square($sourceSquare->getColour()));//space is vacant now
        $this->setSquare($endXAdj,$endYAdj,new Square($targetSquare->getColour(),$sourceSquare->getPiece()));
        //done, generate our move info:
        $piece=$sourceSquare->getPiece();
        $player=$piece->getPlayer();
        return "Moved ".$player->getType().' '.$piece->getType().' from ('.$startX.', '.$startY.') to ('.$endX.', '.$endY.')';
    }

    /**
     * @return string the board which you generally should just echo out
     */
    public function __toString():string{
        $boardString="   1  2  3  4  5  6  7  8\n";     //numbers across the top
        for($i=7;$i>=0;$i--){   //loop through 2nd level array second since that will go down
            $boardString.=($i+1)." ";   //numbers across the left side
            for($j=0;$j<8;$j++){    //then loop across the 1st level array since that will go across
                $square=$this->board[$j][$i];
                /**@var $square Square*/
                $boardString.=$square;//print the square
            }
            $boardString.=' '.($i+1);   //numbers across the right side
            if($i===4){
                $boardString.='  y';
            }
            $boardString.="\n";
        }
        $boardString.="   1  2  3  4  5  6  7  8\n";    //numbers across the bottom
        $boardString.="            x            \n";

        return $boardString;
    }

    /**
     * Check if a given position is on the board
     * @param int $num the position
     * @return bool true if on board
     */
    private function isOnBoard(int $num):bool{
        return $num>=0&&$num<8;
    }

    /**
     * Get a square from a given coordinate
     * @param int $x
     * @param int $y
     * @return Square
     */
    private function getSquare(int $x,int $y):Square{
        return $this->board[$x][$y];
    }

    /**
     * Put a square in a given coord
     * @param int $x
     * @param int $y
     * @param Square $square
     */
    private function setSquare(int $x,int $y,Square $square){
        $column=$this->board[$x];
        $column[$y]=$square;
        $this->board[$x]=$column;
    }
}