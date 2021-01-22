<?php


class Rook extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        $xAbs=abs($xStart-$xEnd);
        $yAbs=abs($yStart-$yEnd);
        if(($xAbs===0)&&($yAbs>0)) {
            return true;
        }
        else if(($yAbs===0)&&($xAbs>0)) {
            return true;
        }
        return false;//invalid
    }

    public function getType(): string{
        return "Rook";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♖";
        return "♜";
    }
}