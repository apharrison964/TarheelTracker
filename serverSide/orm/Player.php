<?php
date_default_timezone_set('America/New_York');

class Player {

	private $firstName;
	private $lastName;
	private $position;
	private $firstSeason;
	private $lastSeason;
	private $heightFeet;
	private $heightInches;
	private $weight;
	private $college;
	private $birthDate;
	private $playerID;

	// If any issue with this, check KMP's example code

	// Display all of the players (or that is what I want it to do)
	public static function findAll() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli -> query("SELECT * FROM 426FinalPlayers");
		return $result;
	}
	
	// We could consider writing two helper methods in case a first or last is just given, but as the data is now it is
	// probably not needed
	public static function findByName($firstName, $lastName) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli -> query("SELECT * FROM 426FinalPlayers WHERE FirstName = '" . $firstName . "' AND LastName = '" . $lastName . "'");
		if ($result) {
			if ($result -> num_rows == 0) {
				return null;
			}
		}
		return $result;
	}

	public static function getAllLastNames() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

		$result = $mysqli -> query("SELECT LastName FROM 426FinalPlayers");
		$lastName_array = array();

		if ($result) {
			while ($next_row = $result -> fetch_array()) {
				$lastName_array[] = intval($next_row['lastName']);
			}
		}
		return $lastName_array;
	}

	private function __construct($firstName, $lastName, $position, $firstSeason, $lastSeason, 
								 $heightFeet, $heightInches, $weight, $college, $birthDate, $playerID) {

		$this -> firstName = $firstName;
		$this -> lastName = $lastName;
		$this -> position = $position;
		$this -> firstSeason = $firstSeason;
		$this -> lastSeason = $lastSeason;
		$this -> heightFeet = $heightFeet;
		$this -> heightInches = $heightInches;
		$this -> weight = $weight;
		$this -> college = $college;
		$this -> birthDate = $birthDate;
		$this -> playerID = $playerID;
	}

	public function getID() {
		return $this -> id;
	}

	public function getTitle() {
		return $this -> title;
	}

	public function getNote() {
		return $this -> note;
	}

	public function getProject() {
		return $this -> project;
	}

	public function getDueDate() {
		return $this -> due_date;
	}

	public function getPriority() {
		return $this -> priority;
	}

	public function isComplete() {
		return $this -> complete;
	}

	public function setTitle($title) {
		$this -> title = $title;
		return $this -> update();
	}

	public function setNote($note) {
		$this -> note = $note;
		return $this -> update();
	}

	public function setProject($project) {
		$this -> project = $project;
		return $this -> update();
	}

	public function setDueDate($due_date) {
		$this -> due_date = $due_date;
		return $this -> update();
	}

	public function setPriority($priority) {
		$this -> priority = $priority;
		return $this -> update();
	}

	public function setComplete() {
		$this -> complete = true;
		return $this -> update();
	}

	public function clearComplete() {
		$this -> complete = false;
		return $this -> update();
	}

	private function update() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

		if ($this -> due_date == null) {
			$dateString = "null";
		} else {
			$dateString = "'" . $this -> due_date -> format('Y-m-d') . "'";
		}

		if ($this -> complete) {
			$completeString = "1";
		} else {
			$completeString = "0";
		}

		$result = $mysqli -> query("update Todo set " . "title=" . "'" . $mysqli -> real_escape_string($this -> title) . "', " . "note=" . "'" . $mysqli -> real_escape_string($this -> note) . "', " . "project=" . "'" . $mysqli -> real_escape_string($this -> project) . "', " . "due_date=" . $dateString . ", " . "priority=" . $this -> priority . ", " . "complete=" . $completeString . " where id=" . $this -> id);
		return $result;
	}

	public function delete() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$mysqli -> query("delete from Todo where id = " . $this -> id);
	}

	public function getJSON() {
		if ($this -> due_date == null) {
			$dateString = null;
		} else {
			$dateString = $this -> due_date -> format('Y-m-d');
		}

		$json_obj = array('id' => $this -> id, 'title' => $this -> title, 'note' => $this -> note, 'project' => $this -> project, 'due_date' => $dateString, 'priority' => $this -> priority, 'complete' => $this -> complete);
		return json_encode($json_obj);
	}

}
