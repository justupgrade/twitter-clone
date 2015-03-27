<?php
	class Message {
		private $sender;
		private $receiver;
		private $message;
		private $id;

		public function __construct($sender, $receiver, $message, $id) {
			$this->sender = $sender;
			$this->receiver = $receiver;
			$this->message = $message;
			$this->id = $id;
		}

		public function getID() {
			return $this->id;
		}

		public function getSender() {
			return $this->sender;
		}

		public function getMessage() {
			return $this->message;
		}

		public function getReceiver() {
			return $this->receiver;
		}
	}
?>