<?php


abstract class AbstractChessPiece implements ChessPiece
{

    protected int $currentXPosition;
    protected int $currentYPosition;
    protected int $id;
    protected Player $player;
    protected bool $isFirstMove=true;

    public function __construct(int $id,
                                Player $player,
                                int $startPositionX,
                                int $startPositionY){
        $this->currentXPosition=$startPositionX;
        $this->currentYPosition=$startPositionY;
        $this->id=$id;
        $this->player=$player;
    }

    /**
     * @return int The numeric (unique) id for this piece
     */
    public function getId():int{
        return $this->id;
    }

    public function getPlayer():Player{
        return $this->player;
    }
    /**
     * @return int the current x position of this piece
     */
    public function x():int{
        return $this->currentXPosition;
    }

    /**
     * @return int the current y position of this piece
     */
    public function y():int{
        return $this->currentYPosition;
    }

    /**
     * Move this piece can move from start to end position. Assumed it's on the board.
     * @param int $xStart the x coord to move from
     * @param int $yStart the y coord to move from
     * @param int $xEnd the x coord to move to
     * @param int $yEnd the y coord to move to
     * @param bool $force true to move regardless of pieces mobility
     * @return void
     * @throws MoveException if the move isn't possible by this piece
     */
    public final function move(int $xStart,int $yStart,int $xEnd,int $yEnd,bool $force=false){
        if(($force===false)&&(!$this->isValidMove($xStart,$yStart,$xEnd,$yEnd))){   //if we aren't being forced, check if it's a valid move
            throw new MoveException("Invalid move for a ".$this->getType());
        }
        //valid or forced, track where we moved to
        $this->currentXPosition=$xEnd;
        $this->currentYPosition=$yEnd;
        $this->isFirstMove=false;
    }

    /**
     * Check if a move is valid for this piece
     * @param int $xStart the x coord to move from
     * @param int $yStart the y coord to move from
     * @param int $xEnd the x coord to move to
     * @param int $yEnd the y coord to move to
     * @return bool true if valid
     */
    protected abstract function isValidMove(int $xStart,int $yStart,int $xEnd,int $yEnd):bool;
}