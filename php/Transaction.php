<?php

class Transaction
{
	private $id;
	private $player;
	private $owner;
	private $price;

	public static function create($player, $owner, $price) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", 
                                     "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli->query("insert into Transaction values (0, " . 
			                     $player . ", " . $owner . ", " . $price . ")");
		if ($result) {
			$new_id = $mysqli->insert_id;
			return new Transaction($new_id, $player, $owner, $price);
		}
		return null;
	}

	public static function findByID($id) {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli->query("select * from Transaction where id = " . $id);
		if ($result) {
			if ($result->num_rows == 0){
				return null;
			}
			$transaction_info = $result->fetch_array();
			return new Transaction($transaction_info['id'],
					       $transaction_info['player'],
					       $transaction_info['owner'],
					       $transaction_info['price']);
		}
		return null;
	}

	public static function getRange($start, $end) {
		if ($start < 0) {
			if ($end > $start) {
				return null;
			}
			$direction = "DESC";
			$start *= -1;
			$end *= -1;
		} else {
			if ($end < $start) {
				return null;
			}
			$direction = "ASC";
		}
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli->query("select id from Transaction order by id " . $direction);
		$transactions = array();

		if ($result) {
			for ($i=1; $i<$start; $i++) {
				$result->fetch_row();
			}
			for ($i=$start; $i<=$end; $i++) {
				$next_row = $result->fetch_row();
				if ($next_row) {
					$transactions[] = Transaction::findByID($next_row[0]);
				}
			}
		}
		return $transactions;
	}

	private function __construct($id, $player, $owner, $price) {
		$this->id = $id;
		$this->player = $player;
		$this->owner = $owner;
		$this->price = $price;
	}

	public function getID() {
		return $this->id;
	}

	public function getOwner() {
		// We'll just return the owner's id here, but what we should do is 
		// use the owner's id to retrieve the appropriate owner object from the
		// Owner ORM class and return that.
		return $this->owner;
	}

	public function getPlayer() {
		// Same caveat as above with owner.
		return $this->player;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($new_price) {
		// Should do validation here
		// If price is wrong in some way, return false.
		
		$this->price = $new_price;
		// Implicit style updating
		return $this->update();
	}

	private function update() {
		$mysqli = new mysqli("classroom.cs.unc.edu", "apharri3", "CH@ngemenow99Please!apharri3", "apharri3db");
		$result = $mysqli->query("update Transaction set price = " . $this->price . " where id = " . $this->id);
		return $result;
	}

}
