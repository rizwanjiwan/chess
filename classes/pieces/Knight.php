<?php


class Knight extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        $absX=abs($xStart-$xEnd);
        $absY=abs($yStart-$yEnd);
        if(($absX===2)&&($absY===1)) {
            return true;
        }
        else if(($absX===1)&&($absY===2)) {
            return true;
        }
        return false;
    }

    public function getType(): string{
        return "Knight";
    }

    public function getTypeSymbol(): string{
        if($this->player->getType()===Player::PLAYER1)
            return "♘";
        return "♞";
    }
}