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

	public function getFirstName() {
		return $this -> firstName;
	}

	public function getLastName() {
		return $this -> lastName;
	}

	public function getPosition() {
		return $this -> position;
	}

	public function getFirstSeason() {
		return $this -> firstSeason;
	}

	public function getLastSeason() {
		return $this -> lastSeason;
	}

	public function getHeightFeet() {
		return $this -> heightFeet;
	}
	
	public function getHeightInches() {
		return $this -> heightInches;
	}
	
	public function getWeight() {
		return $this -> weight;
	}
	
	public function getCollege() {
		return $this -> college;
	}
	
	public function getBirthDate() {
		return $this -> birthDate;
	}
	
	public function getPlayerID() {
		return $this -> playerID;
	}

	public function setFirstName($firstName) {
		$this -> firstName = $firstName;
		return $this -> update();
	}

	public function setLastName($lastName) {
		$this -> lastName = $lastName;
		return $this -> update();
	}

	public function setPosition($position) {
		$this -> position = $position;
		return $this -> update();
	}

	public function setFirstSeason($firstSeason) {
		$this -> firstSeason = $firstSeason;
		return $this -> update();
	}
	
	public function setLastSeason($LastSeason) {
		$this -> LasttSeason = $LasttSeason;
		return $this -> update();
	}

	public function setHeightFeet($heightFeet) {
		$this -> heightFeet = $heightFeet;
		return $this -> update();
	}

	public function setHeightInches($heightInches) {
		$this -> heightInches = $heightInches;
		return $this -> update();
	}

	public function setWeight($weight) {
		$this -> weight = $weight;
		return $this -> update();
	}

	public function setCollege($college) {
		$this -> college = $college;
		return $this -> update();
	}
	
	public function setBirthDate($birthDate) {
		$this -> birthDate = $birthDate;
		return $this -> update();
	}
	
	public function setPlayerID($playerID) {
		$this -> playerID = $playerID;
		return $this -> update();
	}
	

	private function update() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

		$result = $mysqli -> query("UPDATE 426FinalPlayers SET " . "title=" . "'" . $mysqli -> real_escape_string($this -> title) . "', " . "note=" . "'" . $mysqli -> real_escape_string($this -> note) . "', " . "project=" . "'" . 
									$mysqli -> real_escape_string($this -> project) . "', " . "due_date=" . $dateString . ", " . "priority=" . $this -> priority . ", " . "complete=" . $completeString . " where id=" . $this -> id);
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
