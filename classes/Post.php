<?php 
	class Post {
		private $id;
		private $title;
		private $content;

		public function __construct($id,$title,$content) {
			$this->id = $id;
			$this->title = $title;
			$this->content = $content;
		}

		public function displayPlain() {
			$out = "<div class='post' method='post' action='post.php'>";
			$out .= "<label><strong>" . $this->title. "</strong></label><br>";
			$out .= "<span>" . $this->content . "</span>";
			$out .= "</div>";

			return $out;
		}
	}

?>