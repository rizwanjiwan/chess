<?php
require_once('ColourConsole.php');

class Square
{
    CONST BLACK=0;
    CONST WHITE=1;

    private ChessPiece|null $piece=null;
    private int $colour;

/**
 * Square constructor.
 * @param int $colour the colour of this square (BLACK or WHITE)
 * @param ChessPiece|null $piece
 */
    public function __construct(int $colour, ChessPiece|null $piece=null){
        $this->piece=$piece;
        $this->colour=$colour;
    }

    /**
     * @return int The colour of this square
     */
    public function getColour():int{
        return $this->colour;
    }

    /**
     * @return bool Is this square empty?
     */
    public function isEmpty(): bool {
        return $this->piece===null;
    }

    /**
     * @return ChessPiece The piece on this square. Errors out if this square is empty.
     */
    public function getPiece():ChessPiece{
        return $this->piece;
    }
    /**
     * Tell the piece on this square to move from start to end position
     * @param int $xStart the x coord to move from
     * @param int $yStart the y coord to move from
     * @param int $xEnd the x coord to move to
     * @param int $yEnd the y coord to move to
     * @param bool $force true to move regardless of pieces mobility
     * @return void
     * @throws MoveException if the move isn't possible by this piece or if square is empty
     */
    public function movePiece(int $xStart,int $yStart,int $xEnd,int $yEnd,bool $force=false){
        if($this->isEmpty())
            throw new MoveException('Can\'t move an empty square');
        $this->piece->move($xStart,$yStart,$xEnd,$yEnd,$force);
    }

    /**
     * @return string Get the string showing the square (colour and any piece on it)
     */
    public function __toString():string{
        $colourization=$this->getColourizationString();
        if($this->isEmpty()){
           return ColourConsole::set("   ",$colourization);
        }
        else {
            $piece = $this->getPiece();
            return ColourConsole::set(" ".$piece->getTypeSymbol()." ",$colourization);
        }
    }

    /**
     * @return string Get the descripiotn of how to colourize this square for  ColourConsole::set
     */
    private function getColourizationString():string{
        if($this->colour===self::BLACK)
            return "black_bg+white";
        return "white_bg+black";
    }
}