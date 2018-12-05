<?php
session_start();
if (! isset($_SESSION['maze']) or ($_SESSION['maze'] === 'null')) {
    $_SESSION['maze'] = new Maze();
} else if (isset($_GET["new"])) {
        $_SESSION['maze'] = new Maze();
        $_SESSION['maze']->won = false;
} else if(!$_SESSION['maze']->won) {
    if (isset($_GET["up"]))
        $_SESSION['maze']->up();
    else if (isset($_GET["right"]))
        $_SESSION['maze']->right();
    else if (isset($_GET["down"]))
        $_SESSION['maze']->down();
    else if (isset($_GET["left"]))
        $_SESSION['maze']->left();
}

if($_SESSION['maze']->won)
    echo 'Congratulations You Won!';
echo $_SESSION['maze']->toString();

class Maze
{
    private $x;
    private $y;
    private $mazedir = 'mazes\\*.csv';
    private $maze;
    public $won = false;

    public function __construct()
    {
        // randomize maze
        $mazeFiles = glob($this->mazedir);
        $randIndex = rand(0, count($mazeFiles));
        $mazeFileName = $mazeFiles[0];
        $mazeFile = fopen($mazeFileName, 'r');

        // initialize Maze array
        $this->maze = array();
        $row = 0;
        while (($line = fgets($mazeFile))) {
            $rowData = explode(' ', $line);
            for ($i = 0; $i < count($rowData); $i ++) {
                $left = $right = $top = $bottom = $marker = false;

                if (strpos($rowData[$i], '1') !== false)
                    $top = true;
                if (strpos($rowData[$i], '2') !== false)
                    $right = true;
                if (strpos($rowData[$i], '3') !== false)
                    $bottom = true;
                if (strpos($rowData[$i], '4') !== false)
                    $left = true;
                if (strpos($rowData[$i], '5') !== false) {
                    $this->x = $i;
                    $this->y = $row;
                    $marker = true;
                }

                $this->maze[$row][$i] = new MazeTile($left, $right, $top, $bottom, $marker);
            }
            $row ++;
        }
    }

    public function toString()
    {
        $htmlMaze = "";
        $htmlMaze = $htmlMaze . '<table>';
        for ($i = 0; $i < count($this->maze); $i ++) {
            $htmlMaze = $htmlMaze . '<tr>';
            for ($j = 0; $j < count($this->maze); $j ++) {
                $htmlMaze = $htmlMaze . $this->maze[$i][$j]->toString();
            }
            $htmlMaze = $htmlMaze . '</tr>';
        }
        $htmlMaze = $htmlMaze . '</table>';

        return $htmlMaze;
    }

    public function up()
    {
        // check for collision
        if ($this->maze[$this->y][$this->x]->top === true) {
            return; 
        } else if ($this->y - 1 < 0 ) {
            $this->won = true;
            return; 
        } else if ($this->maze[$this->y - 1][$this->x]->bottom === true){
            return; 
        }

        // move maze pos
        $this->maze[$this->y][$this->x]->marker = false;
        $this->y -= 1;         
        $this->maze[$this->y][$this->x]->marker = true;
        return $this->toString();
    }

    public function down()
    {           
        // check for collision
        if ($this->maze[$this->y][$this->x]->bottom === true){
            return;
        } else if ($this->y + 1 >= count($this->maze)){
            $this->won = true;
            return;
        } else if ( $this->maze[$this->y+1][$this->x]->top === true){
            return;
        }

        // move maze pos
        $this->maze[$this->y][$this->x]->marker = false;
        $this->y += 1;            
        $this->maze[$this->y][$this->x]->marker = true;
        return $this->toString();
    }

    public function left()
    {
        // check for collision
        if ($this->maze[$this->y][$this->x]->left === true){
            return;
        } else if ($this->x - 1 < 0 )     {
            $this->won = true;
            return;
        } else if ($this->maze[$this->y][$this->x - 1]->right === true){
            return;
        }        

        // move maze pos
        $this->maze[$this->y][$this->x]->marker = false;
        $this->x -= 1;
        if ($this->x < 0){
            $this->won = true;
            $this->x += 1;
            return;
        }                        
        $this->maze[$this->y][$this->x]->marker = true;
        return $this->toString();
    }

    public function right()
    {
        // check for collision
        if ($this->maze[$this->y][$this->x]->right === true) {
            return;
        } else if ($this->x + 1 >= count($this->maze)) {
            $this->won = true;
            return;            
        } else if ($this->maze[$this->y][$this->x + 1]->left === true) {
            return;
        }                        

        // move maze pos
        $this->maze[$this->y][$this->x]->marker = false;
        $this->x += 1;
        if ($this->x >= count($this->maze)){
            $this->won = true;
            $this->x -= 1;
            return;
        }            
        $this->maze[$this->y][$this->x]->marker = true;
        return $this->toString();
    }
}

class MazeTile
{

    public $left;

    public $right;

    public $top;

    public $bottom;

    public $marker;

    public function __construct($left, $right, $top, $bottom, $marker = false)
    {
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom = $bottom;
        $this->marker = $marker;
    }

    public function toString()
    {
        $modifier = '';
        if ($this->left)
            $modifier .= 'left ';
        if ($this->right)
            $modifier .= 'right ';
        if ($this->top)
            $modifier .= 'top ';
        if ($this->bottom)
            $modifier .= 'bottom ';
        if ($this->marker)
            $modifier .= 'marker ';

        return '<td class="' . $modifier . '"></td>';
    }
}

?>
