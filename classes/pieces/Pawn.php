<?php


class Pawn extends AbstractChessPiece
{

    private int $upDirection=1;//either 1 or -1 depending on which side of the board we start

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        if($this->isFirstMove){//log the positive direction for us to know which way is "up" for us
            if($yStart>4){
                $this->upDirection=-1;//we're starting on the top half of the board, we're moving down
            }
        }
        $distance=$yEnd-$yStart;

        //moving straight?
        if($xStart===$xEnd){
            if($distance===$this->upDirection){//moving a single space, all good
                return true;
            }
            else if(($this->isFirstMove)&&($this->upDirection*2===$distance)){//moving 2 spaces on our first move, all good
                return true;
            }
        }//end $x check
        else if(abs($xStart-$xEnd)===1){//must be trying to move diagonally todo:build check for there being a piece there
            if($distance===$this->upDirection){//moving a single space, all good
                return true;
            }
        }
        return false;//oh oh, bad move!
    }

    public function getType(): string{
        return "Pawn";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♙";
        return "♟";
    }
}