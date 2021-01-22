<?php


class Player
{
    CONST PLAYER1='P1';
    CONST PLAYER2='P2';

    private string $type;
    public function __construct($type){
        $this->type=$type;
    }

    public function getType():string{
        return $this->type;
    }

}