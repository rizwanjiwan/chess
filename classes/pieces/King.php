<?php


class King extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        $xAbs=abs($xStart-$xEnd);
        $yAbs=abs($yStart-$yEnd);
        if(($xAbs===1)&&($yAbs<=1)) {
            return true;
        }
        else if(($yAbs===1)&&($xAbs<=1)) {
            return true;
        }
        return false;//invalid move
    }

    public function getType(): string{
        return "King";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♔";
        return "♚";
    }
}