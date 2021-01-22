<?php


interface ChessPiece
{

    /**
     * @return int The numeric (unique) id for this piece
     */
    public function getId():int;

    public function getPlayer():Player;
    /**
     * @return string get the type of piece this is
     */
    public function getType():string;

    /**
     * @return string The single character symbol representing the type of piece
     */
    public function getTypeSymbol():string;

    /**
     * @return int the current x position of this piece
     */
    public function x():int;

    /**
     * @return int the current y position of this piece
     */
    public function y():int;

    /**
     * Move this piece can move from start to end position
     * @param int $xStart the x coord to move from
     * @param int $yStart the y coord to move from
     * @param int $xEnd the x coord to move to
     * @param int $yEnd the y coord to move to
     * @param bool $force true to move regardless of pieces mobility
     * @return void
     * @throws MoveException if the move isn't possible by this piece
     */
    public function move(int $xStart,int $yStart,int $xEnd,int $yEnd,bool $force=false);
}