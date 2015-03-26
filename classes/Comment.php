<?php 
	
	class Comment {
		private $created_on;
		private $created_by;
		private $content;

		public function __construct($created_on, $created_by, $content) {
			$this->created_on = $created_on;
			$this->created_by = $created_by;
			$this->content = $content;
		}

		public function displayPlain() {
			$out = "<div class='comment'>";
			$out .= "<span>" . $this->content . "</span><br>";
			$out .= "<strong><small> Created By:" .$this->created_by. "</small></strong>";
			$out .= "</div>";
			return $out;
		}

		static public function displayCommentForm() {
			$out = "<form method='post'>";
			$out .= "<label> Add Comment: </label><br>";
			$out .= "<textarea name='content'></textarea><br>";
			$out .= "<input type='submit' value='Comment' name='addComment'>";
			$out .= "</form>";
			return $out;
		}
	}

?>