<?php
require_once('orm/Player.php');
$path_components = explode('/', $_SERVER['PATH_INFO']);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
 
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {
    
    $playerClass = ($path_components[1]);
    
    $player = Player::findByLastName($playerClass);
    if ($player == null) {
   
      header("HTTP/1.0 404 Not Found");
      print("Player ID: " . $playerClass . " not found.");
      exit();
    }
    
    if (isset($_REQUEST['delete'])) {
      $player->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    } 
    
    header("Content-type: application/json");
    print($player->getJSON());
    exit();
  }
 
  header("Content-type: application/json");
  print(json_encode(Player::getAllLastNames()));
  exit();
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {
    
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
    
    header("Content-type: application/json");
    print($player->getJSON());
    exit();
  } else {
    // Creating a new Player item
    // Validate values
    if (!isset($_REQUEST['firstName'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing first name");
      exit();
    }
    
    $firstName = trim($_REQUEST['firstName']);
    if (firstName == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad first name");
      exit();
    }
    if (!isset($_REQUEST['lastName'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing last name");
      exit();
    }
    
    $lastName = trim($_REQUEST['lastName']);
    if (lastName == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad last name");
      exit();
    }
    
    if (!isset($_REQUEST['position'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing position value");
      exit();
    }
    
    $position = trim($_REQUEST['position']);
    if (position == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad  position value");
      exit();
    }
    
    if (!isset($_REQUEST['firstSeason'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing first season");
      exit();
    }
    
    $firstSeason = trim($_REQUEST['firstSeason']);
    if (firstSeason == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad first season");
      exit();
    }
    
    if (!isset($_REQUEST['lastSeason'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing first season");
      exit();
    }
    
    $lastSeason = trim($_REQUEST['lastSeason']);
    if (lastSeason == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad season value");
      exit();
    }
    
    if (!isset($_REQUEST['heightFeet'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing height feet");
      exit();
    }
    
    $heightFeet = trim($_REQUEST['heightFeet']);
    if (heightFeet == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad height feet");
      exit();
    }
    
    if (!isset($_REQUEST['heightInches'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing height inches");
      exit();
    }
    
    $heightInches = trim($_REQUEST['heightInches']);
    if (heightInches == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad height inches");
      exit();
    }
    
    if (!isset($_REQUEST['weight'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing weight");
      exit();
    }
    
    $weight = trim($_REQUEST['weight']);
    if (weight == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad weight");
      exit();
    }
    
    if (!isset($_REQUEST['college'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing college");
      exit();
    }
    
    $college = trim($_REQUEST['college']);
    if (college == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad college");
      exit();
    }
    
    if (!isset($_REQUEST['birthDate'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing birth date");
      exit();
    }
    
    $birthDate = trim($_REQUEST['birthDate']);
    if (birthDate == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad birth date");
      exit();
    }
    
    if (!isset($_REQUEST['playerID'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing playerID");
      exit();
    }
    
    $title = trim($_REQUEST['playerID']);
    if (playerID == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad playerID");
      exit();
    }

    $new_player = Player::create($firstName, $lastName, $position, $firstSeason, $lastSeason, 
    		             $heightFeet, $heightInches, $weight, $college, $birthDate, $playerID);
    // Report if failed
    if ($new_player == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new player.");
      exit();
    }
    
   
    header("Content-type: application/json");
    print($new_player->getJSON());
    exit();
  }
}
// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.
header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");
?>
