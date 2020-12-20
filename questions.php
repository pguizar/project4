<?php

class Questions {
	private $ownerid, $title, $body, $skills;

	public function __construct($ownerid, $title, $body, $skills){
		$this->ownerid= $ownerid;
		$this->title = $title;
		$this->body = $body;
		$this->skills = $skills;

	}

	public function getOwnerid(){
		return $this->ownerid;
	}
	public function setId($ownerid) {
		$this->ownerid = $ownerid;
	}

		public function getTitle(){
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
	}

		public function getBody(){
		return $this->body;
	}
	public function setBody($body) {
		$this->body = $body;
	}

		public function getSkills(){
		return $this->skills;
	}
	public function setSkills($skills) {
		$this->skills = $skills;
	}
}

?>
