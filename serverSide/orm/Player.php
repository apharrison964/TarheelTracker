<?php
date_default_timezone_set('America/New_York');

class Player
{
  private $playerID;
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

  public static function create($firstName, $lastName, $position, $firstSeason, $lastSeason, $heightFeet,
  				$heightInches, $weight, $college, $birthDate, $playerID) {
    $mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

    //if ($due_date == null) {
    //  $dateString = "null";
    //} else {
    //  $dateString = "'" . $due_date->format('Y-m-d') . "'";
    //}

    //if ($complete) {
    //  $completeString = "1";
    //} else {
    //  $completeString = "0";
    //}

    $result = $mysqli->query("INSERT INTO 426FinalPlayers values (
			     "'" . $mysqli->real_escape_string($title) . "', " .
			     "'" . $mysqli->real_escape_string($note) . "', " .
			     "'" . $mysqli->real_escape_string($project) . "', " .
			     $dateString . ", " .
			     $priority . ", " .
			     $completeString . ")");
    
    if ($result) {
      $id = $mysqli->insert_id;
      return new Player($firstName, $lastName, $position, $firstSeason, $lastSeason, $heightFeet,
  				$heightInches, $weight, $college, $birthDate, $playerID);
    }
    return null;
  }

  public static function findByID($id) {
    $mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

    $result = $mysqli->query("select * from Todo where id = " . $id);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $todo_info = $result->fetch_array();

      if ($todo_info['due_date'] != null) {
	$due_date = new DateTime($todo_info['due_date']);
      } else {
	$due_date = null;
      }

      if (!$todo_info['complete']) {
	$complete = false;
      } else {
	$complete = true;
      }

      return new Todo(intval($todo_info['id']),
		      $todo_info['title'],
		      $todo_info['note'],
		      $todo_info['project'],
		      $due_date,
		      intval($todo_info['priority']),
		      $complete);
    }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

    $result = $mysqli->query("select id from Todo");
    $id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	$id_array[] = intval($next_row['id']);
      }
    }
    return $id_array;
  }

  private function __construct($firstName, $lastName, $position, $firstSeason, $lastSeason, $heightFeet,
  				$heightInches, $weight, $college, $birthDate, $playerID) {
    
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->position = $position;
    $this->firstSeason = $firstSeason;
    $this->lastSeason = $lastSeason;
    $this->heightFeet = $heightFeet;
    $this->heightInches = $heightInches;
    $this->weight = $weight;
    $this->college = $college;
    $this->birthDate = $birthDate;
    $this->playerID = $playerID;
  }

  public function getID() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getNote() {
    return $this->note;
  }

  public function getProject() {
    return $this->project;
  }

  public function getDueDate() {
    return $this->due_date;
  }

  public function getPriority() {
    return $this->priority;
  }

  public function isComplete() {
    return $this->complete;
  }

  public function setTitle($title) {
    $this->title = $title;
    return $this->update();
  }

  public function setNote($note) {
    $this->note = $note;
    return $this->update();
  }

  public function setProject($project) {
    $this->project = $project;
    return $this->update();
  }

  public function setDueDate($due_date) {
    $this->due_date = $due_date;
    return $this->update();
  }

  public function setPriority($priority) {
    $this->priority = $priority;
    return $this->update();
  }

  public function setComplete() {
    $this->complete = true;
    return $this->update();
  }

  public function clearComplete() {
    $this->complete = false;
    return $this->update();
  }

  private function update() {
    $mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");

    if ($this->due_date == null) {
      $dateString = "null";
    } else {
      $dateString = "'" . $this->due_date->format('Y-m-d') . "'";
    }

    if ($this->complete) {
      $completeString = "1";
    } else {
      $completeString = "0";
    }

    $result = $mysqli->query("update Todo set " .
			     "title=" .
			     "'" . $mysqli->real_escape_string($this->title) . "', " .
			     "note=" .
			     "'" . $mysqli->real_escape_string($this->note) . "', " .
			     "project=" .
			     "'" . $mysqli->real_escape_string($this->project) . "', " .
			     "due_date=" . $dateString . ", " .
			     "priority=" . $this->priority . ", " .
			     "complete=" . $completeString . 
			     " where id=" . $this->id);
    return $result;
  }

  public function delete() {
    $mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
    $mysqli->query("delete from Todo where id = " . $this->id);
  }

  public function getJSON() {
    if ($this->due_date == null) {
      $dateString = null;
    } else {
      $dateString = $this->due_date->format('Y-m-d');
    }

    $json_obj = array('id' => $this->id,
		      'title' => $this->title,
		      'note' => $this->note,
		      'project' => $this->project,
		      'due_date' => $dateString,
		      'priority' => $this->priority,
		      'complete' => $this->complete);
    return json_encode($json_obj);
  }
}
