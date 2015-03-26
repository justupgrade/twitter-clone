<?php 
	class User {
		private $id;
		private $email;

		public function __construct($id, $email) {
			$this->id = $id;
			$this->email = $email;
		}

		public function getID() {
			return $this->id;
		}

		public function getEmail() {
			return $this->email;
		}
	}
?>
