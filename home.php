<?php
	session_start()
	
	if(!isset($_SESSION['pos'])
		$_SESSION['pos'] = new Maze(0,0);
	
	
	class Maze {
		private $x;
		private $y;
		
		public function __ construct($x, $y){
			$this->x = $x;
			$this->y = $y;
		}		
		
		public function toString() {
		
		}
		
		public function up() {
			$this->x 
			return toString();
		}
		
		public function down() {
			return toString();
		}		
		
		public function left() {
			return toString();
		}
		
		public function right() {
		
			return toString();
		}			
	}
	
	class MazeTile {
		public $left;
		public $right;
		public $top;
		public $bottom;
		
		public function __ construct($left, $right, $top, $bottom){
			$this->left = $left;
			$this->right = $right;
			$this->top = $top;
			$this->bottom->$bottom;			
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
		
			return '<td class="' . modifier . '"></td>'
		}		.	
	}

?>
