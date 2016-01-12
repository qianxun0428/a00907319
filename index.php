<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        if (isset($_GET['board'])) {
            $squares = $_GET['board'];
        } else {
            $squares = '---------';
        }
        $game = new Game($squares);
        if ($game->winner('o')) {
            echo "You win. Lucky guesses!";
        } else if ($game->winner('x')) {
            echo "I win. Muahahahaha";
        } else {
            $squares = $game->pick_move();
            $game = new Game($squares);
            if ($game->winner('x')) {
                echo "I win. Muahahahaha";
            }
        } $game->display();
        ?>
        
    </body>
</html>
<?php

//add the board position property
class Game {
    
//add constryctor, taking a position parameter
    var $position;
    
//taking a position parameter
    function __construct($squares) {
        $this->position = str_split($squares);
    }

    function winner($token) {
        //
        $result = false;
        for ($row = 0; $row < 3; $row++) {
            $result = true;
            for ($col = 0; $col < 3; $col++) {
                if ($this->position[3 * $row + $col] != $token) {
                    $result = false;
                }
            }
            if ($result == true) {
                return $result;
            }
        }
        for ($col = 0; $col < 3; $col++) {
            $result = true;
            for ($row = 0; $row < 3; $row++) {
                if ($this->position[3 * $row + $col] != $token) {
                    $result = false;
                }
            }
            if ($result == true) {
                return $result;
            }
        }
        if ($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
            $result = true;
        }
        if ($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
            $result = true;
        }
        return $result;
    }

    //add new method inside game class
    function show_cell($which) {
        $token = $this->position[$which];
        if ($token <> '-') {
            return '<td>' . $token . '</td>';
        }
        $this->newposition = $this->position;
        $this->newposition[$which] = 'o';
        $move = implode($this->newposition);
        $link = '/A00907319/?board=' . $move;
        return '<td><a href="' . $link . '">-</a></td>';
    }

    function display() {
        echo '<table cols=”3” style=”font­size:large; font­weight:bold”>';
        echo '<tr>'; // open the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2) {
                echo '</tr><tr>';
            }
        }
        echo '</tr>';
        echo '</table>';
    }

    function pick_move() {
        $newposition = $this->position;
        for ($pos = 0; $pos < 9; $pos++) {
            if ($this->position[$pos] == '-') {
                $newposition[$pos] = 'x';
                $move = implode($newposition);
                return $move;
            }
        }
    }

}
?>
