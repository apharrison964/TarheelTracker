<?php

require_once('orm/Player.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // GET means either instance look up, index generation, or deletion

  // Following matches instance URL in form
  // /todo.php/<id>

  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    // Interpret <id> as integer
    $playerClass = intval($path_components[1]);

    // Look up object via ORM
    $player = Player::findByID($playerClass);

    if ($player == null) {
      // Todo not found.
      header("HTTP/1.0 404 Not Found");
      print("Player ID: " . $playerClass . " not found.");
      exit();
    }

    // Check to see if deleting
    if (isset($_REQUEST['delete'])) {
      $player->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    } 

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($player->getJSON());
    exit();

  }

  // ID not specified, then must be asking for index
  header("Content-type: application/json");
  print(json_encode(Player::getAllIDs()));
  exit();

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Either creating or updating

  // Following matches /todo.php/<id> form
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    //Interpret <id> as integer and look up via ORM
    $playerClass = intval($path_components[1]);
    $player = Player::findByID($playerClass);

    if ($player == null) {
      // Player not found.
      header("HTTP/1.0 404 Not Found");
      print("Player ID: " . $playerClass . " not found while attempting update.");
      exit();
    }

    // Validate values
    $new_firstName = false;
    if (isset($_REQUEST['firstName'])) {
      $new_firstName = trim($_REQUEST['firstName']);
      if ($new_firstName == "") {
	header("HTTP/1.0 400 Bad Request");
	print("Bad first name");
	exit();
      }
    }
	
    $new_lastName = false;
    if (isset($_REQUEST['lastName'])) {
      $new_lastName = trim($_REQUEST['lastName']);
      if ($new_lastName == "") {
	header("HTTP/1.0 400 Bad Request");
	print("Bad last name");
	exit();
      }
    }

    $new_position = false;
    if (isset($_REQUEST['position'])) {
      $new_position = trim($_REQUEST['position']);
    }

    $new_firstSeason = false;
    if (isset($_REQUEST['firstSeason'])) {
      $new_firstSeason = trim($_REQUEST['firstSeason']);
    }

    $new_lastSeason = false;
    if (isset($_REQUEST['lastSeason'])) {
      $new_firstSeason = trim($_REQUEST['lastSeason']);
    }

    $new_heightFeet = false;
    if (isset($_REQUEST['heightFeet'])) {
      $new_heightFeet = trim($_REQUEST['heightFeet']);
    }

    $new_heightInches = false;
    if (isset($_REQUEST['heightInches'])) {
      $new_heightInches = trim($_REQUEST['heightInches']);
    }
    
    $new_weight = false;
    if (isset($_REQUEST['weight'])) {
      $new_weight = trim($_REQUEST['weight']);
    }
    
    $new_college = false;
    if (isset($_REQUEST['college'])) {
      $new_college = trim($_REQUEST['college']);
    }
    
    $new_birthDate = false;
    if (isset($_REQUEST['birthDate'])) {
      $new_birthDate = trim($_REQUEST['birthDate']);
    }
    
    $new_playerID = false;
    if (isset($_REQUEST['playerID'])) {
      $new_playerID = trim($_REQUEST['playerID']);
    }

    // Update via ORM
    if ($new_firstName) {
      $firstName->setFirstName($new_firstName);
    }
    
    if ($new_lastName) {
      $lastName->setLastName($new_lastName);
    }
    
    if ($new_position) {
      $position->setPosition($new_position);
    }
    
    if ($new_firstSeason) {
      $firstSeason->setFirstSeason($new_firstSeason);
    }
    
    if ($new_lastSeason) {
      $lastSeason->setLastSeason($new_lastSeason);
    }
    
    if ($new_heightFeet) {
      $heightFeet->setHeightFeet($new_heightFeet);
    }
    
    if ($new_heightInches) {
      $heightInches->setHeightInches($new_heightInches);
    }
    
    if ($new_weight) {
      $weight->setWeight($new_weight);
    }
    
    if ($new_college) {
      $college->setCollege($new_college);
    }
    
    if ($new_birthDate) {
      $birthDate->setBirthDate($new_birthDate);
    }
    
    if ($new_playerID) {
      $playerID->setPlayerID($new_playerID);
    }

    // Return JSON encoding of updated Todo
    header("Content-type: application/json");
    print($player->getJSON());
    exit();
  } else {

    // Creating a new Player item

    // Validate values
    if (!isset($_REQUEST['title'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing title");
      exit();
    }
    
    $title = trim($_REQUEST['title']);
    if ($title == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad title");
      exit();
    }

    $note = "";
    if (isset($_REQUEST['note'])) {
      $note = trim($_REQUEST['note']);
    }

    $project = "";
    if (isset($_REQUEST['project'])) {
      $project = trim($_REQUEST['project']);
    }

    $due_date = null;
    if (isset($_REQUEST['due_date'])) {
      $date_str = trim($_REQUEST['due_date']);
      if ($date_str != "") {
	$due_date = new DateTime($date_str);
      }
    }

    $priority = 1;
    if (isset($_REQUEST['priority'])) {
      $priority = intval($_REQUEST['priority']);
      if (!($priority > 0 && $priority <= 10)) {
	header("HTTP/1.0 400 Bad Request");
	print("Priority value out of range");
	exit();
      }
    }

    if (isset($_REQUEST['complete'])) {
      $complete = true;
    } else {
      $complete = false;
    }


    // Create new Todo via ORM
    $new_todo = Todo::create($title, $note, $project, $due_date, $priority, $complete);

    // Report if failed
    if ($new_todo == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new todo.");
      exit();
    }
    
    //Generate JSON encoding of new Todo
    header("Content-type: application/json");
    print($new_todo->getJSON());
    exit();
  }
}

// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");

?>
