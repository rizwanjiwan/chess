<?php


class Queen extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        $absX=abs($xStart-$xEnd);
        $absY=abs($yStart-$yEnd);
        //move like a rook
        if(($absX===0)&&($absY>0)){
            return true;
        }
        else if(($absY===0)&&($absX>0)){
            return true;
        }
        //move like a bishop
        return ($absX===$absY)&&($absX+$absY!==0);
    }

    public function getType(): string{
        return "Queen";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♕";
        return "♛";
    }
}