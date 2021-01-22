<?php


class Bishop extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        $absX=abs($xStart-$xEnd);
        $absY=abs($yStart-$yEnd);
        return ($absX===$absY)&&($absX+$absY!==0);
    }

    public function getType(): string{
        return "Bishop";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♗";
        return "♝";
    }
}