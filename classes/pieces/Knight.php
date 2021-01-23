<?php


class Knight extends AbstractChessPiece
{

    protected function isValidMove(int $xStart, int $yStart, int $xEnd, int $yEnd): bool{
        //todo
        return true;
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