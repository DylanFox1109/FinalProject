<?php
	session_start();	
	if(!isset($_SESSION['pos']){
	    $_SESSION['pos'] = new Maze();
	}	
	
	class Maze {
		private $x;
		private $y;
		private $mazedir = 'mazes';
		private $maze;
		
		public function __construct(){
			//randomize maze
			$mazeFiles = scandir($this->mazedir);
			$randIndex = rand(0, count($mazeFiles));
			$mazeFileName = $mazeFiles[$randIndex];
			$mazeFile = fopen($mazeFileName, 'r');		
			
			//initialize Maze array
			$this->maze = array();					
			$row = 0;
			while ( ($line = fgets($mazeFile)) ) {
			    $rowData = explode(' ', $line);
			    for ($i=0;$i < count($rowData);$i++){
			        $left = $right = $top = $bottom = false;    
			        
			        if(strpos($rowData[$i], '1') !== false)
			            $top = true;
		            if(strpos($rowData[$i], '2') !== false)
		                $right = true;
	                if(strpos($rowData[$i], '3') !== false)
	                    $bottom = true;
                    if(strpos($rowData[$i], '4') !== false)
                       $left = true;			        
                    if(strpos($rowData[$i], '5') !== false){
                       $this->x = $i;
                       $this->y = $row;                        
                   }
                           
			        $this->maze[$row][$i] = new MazeTile($left, $right, $top, $bottom);
			    }	  			    
			    $row++;
			}	
								
		}		
		
		public function toString() {
		    $htmlMaze = '';		    
		    $htmlMaze += '<table>';
		    for ($i=0; $i < count($this->maze); $i++) {
		        $htmlMaze += '<tr>';
		        for ($j=0; $j < count($this->maze); $j++) {
		            $htmlMaze += $this->maze[i][j]->toString();
		        }
		        $htmlMaze += '</tr>';
		    }
		    $htmlMaze += '</table>';
		    
		    return $htmlMaze;
		}
		
		public function up() {
			//check for collision
		    $pos = $this->maze[$this->x][$this->y];
		    if ($pos->up === true)
		        return $this.toString();
		    
		    //move maze pos
			$this->y -= 1;		    
			return $this.toString();
		}
		
		public function down() {
		    //check for collision
		    $pos = $this->maze[$this->x][$this->y];
		    if ($pos->down === true)
		        return $this.toString();
		        
		        //move maze pos
		        $this->y += 1;
		        return $this.toString();
		}		
		
		public function left() {
		    //check for collision
		    $pos = $this->maze[$this->x][$this->y];
		    if ($pos->left === true)
		        return $this.toString();
		        
		        //move maze pos
		        $this->x -= 1;
		        return $this.toString();
		}
		
		public function right() {		
		    //check for collision
		    $pos = $this->maze[$this->x][$this->y];
		    if ($pos->right === true)
		        return $this.toString();
		        
		        //move maze pos
		        $this->x += 1;
		        return $this.toString();
		}			
	}
	
	class MazeTile {
		public $left;
		public $right;
		public $top;
		public $bottom;
		public $marker;
		
		public function __construct($left, $right, $top, $bottom, $marker = false){
			$this->left = $left;
			$this->right = $right;
			$this->top = $top;
			$this->bottom->$bottom;		
			$this->marker = $marker;
		}	
		
		public function toString() {
			$modifier = '';
			if($this->left)
				$modifier += 'left';
			if($this->right)
				$modifier += 'right';
			if($this->top)
				$modifier += 'up';
			if($this->bottom)
				$modifier += 'bottom';
			if($this->marker)
			    $modifier += 'marker';
		
			return '<td class="' . $modifier . '"></td>';
		}	
	}

?>
