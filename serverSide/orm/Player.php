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
	
	public static function findByID($playerID) {
    		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

		$result = $mysqli->query("SELECT * FROM 426FinalPlayers WHERE PlayerID = " . $playerID);
	
	        if ($result) {
	          if ($result->num_rows == 0) {
			return null;
	        }
	
	        $playerInfo = $result->fetch_array();
	
	        return new Todo (
			      $playerInfo['FirstName'],
			      $playerInfo['LastName'],
			      $playerInfo['Position'],
			      intval($playerInfo['FirstSeason']),
			      intval($playerInfo['LastSeason']),
			      intval($playerInfo['HeightFeet']),
			      intval($playerInfo['HeightInches']),
			      intval($playerInfo['Weight']),
			      $playerInfo['College'],
			      $playerInfo['BirthDate'],
			      intval($playerInfo['PlayerID']));
	    }
	    return null;
      }
	
	
	// We could consider writing two helper methods in case a first or last is just given, but as the data is now it is
	// probably not needed
	public static function findByFirstName($firstName) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli -> query("SELECT * FROM 426FinalPlayers WHERE FirstName = '" . $firstName . "'");
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
				$lastName_array[] = ($next_row['lastName']);
			}
		}
		return $lastName_array;
	}

   public static function getAllIDs() {
   		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

    	$result = $mysqli->query("SELECT PlayerID FROM 426FinalPlayers");
    	$playerIDArray = array();

	    if ($result) {
	      while ($next_row = $result->fetch_array()) {
				$playerIDArray[] = intval($next_row['PlayerID']);
	      }
	    }
	    return $playerIDArray;
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

		$result = $mysqli -> query("UPDATE 426FinalPlayers SET " . 
				       	   "FirstName=" . "'" . $mysqli -> real_escape_string($this -> firstName) . "', " . 
					   "LastName=" . "'" . $mysqli -> real_escape_string($this -> lastName) . "', " . 
					   "Position=" . "'" . $mysqli -> real_escape_string($this -> position) . "', " .  
					   "FirstSeason=" . $this -> firstSeason . ", " . 
					   "LastSeason=" . $this -> lastSeason . ", " . 
					   "HeightFeet=" . $this -> heightFeet . ", " . 
					   "HeightInches=" . $this -> heightInches . ", " . 
					   "Weight=" . $this -> weight . ", " . 
					   "College=" . "'" . $mysqli -> real_escape_string($this -> college) . "', " . 
					   "BirthDate=" . "'" . $mysqli -> real_escape_string($this -> birthDate) . "', " . 
					   " WHERE PlayerID=" . $this -> playerId);
		return $result;
	}

	public function deletePlayer() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$mysqli -> query("DELETE FROM 426FinalPlayers WHERE PlayerID = " . $this -> playerID);
	}

	public function getJSON() {
		$json_obj = array('FirstName' => $this -> firstName, 'LastName' => $this -> lastName, 'Position' => $this -> position, 'FirstSeason' => $this -> firstSeason, 
				  'LastSeason' => $this -> lastSeason, 'HeightFeet' => $this -> heightFeet, 'HeightInches' => $this -> heightInches, 
				   'Weight' => $this -> weight, 'College' => $this -> college, 'BirthDate' => $this -> birthDate);
		return json_encode($json_obj);
	}

}
