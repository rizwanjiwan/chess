# Chess

The basic groundwork for a console chess game

This is the code I'm using for a programming class I'm teaching. The objective is to teach about classes, objects, inheritence, etc.

<img src="https://rizwanjiwan.com/chess-screenie.png" alt="screenshot" width="500"/>

Tip: if it's hard to see the board, increase the font size of your terminal.

## Next steps for students

This is code works but many parts of chess aren't supported. Students should understand this code and then improve/add to it.

Possible improvements:
* Write the code needed to enforce proper Knight movement
* Detect check
* Detect checkmate (this is harder than it sounds)
* Track and enforce the next player to move
* Detect and track landing on the other players pieces. Display it to the user on demand.
* Prevent landing on your own piece
* Make it so pieces can "see" the board to support:
  * Pawns making it to the other end
  * Castling
  * Preventing hopping over pieces (where applicable)
* Add fun Easter Eggs like the cheat code that already exists
* Add more cheat code taunts
* Add chess notation/move support (https://en.wikipedia.org/wiki/Chess_notation)
* Add a log functionality that can spit out the history of moves for the user on demand or at the end of the game
* Huge amount of work: Add support for a web based interface (requires supporting persistence OR the introduction of javascript)
* Huge amount of work: Add network support for multi player over the internet either peer to peer (https://www.php.net/manual/en/function.fsockopen.php) or using a web server in the middle (https://www.php.net/manual/en/curl.examples.php)
