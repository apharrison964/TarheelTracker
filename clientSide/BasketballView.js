var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f15/users/apharri3/Codiad/workspace/finalProject/serverSide";

$(document).ready(function () {
$("#playerTable").html("<table border='1'><tr><td>First Name</td><td>Last Name</td></tr><tr><td>Shaquille</td><td>O'Neil</td></tr><tr><td>Kareem</td><td>Abdul-Jabar</td></tr><tr><td>Dirk</td><td>Nowitzki</td></tr><tr><td>Michael</td><td>Jordan</td></tr></table>");

	$.ajax(url_base + "/PlayerRun.php",
	       {type: "GET",
		       dataType: "json",
		       success: function(playerClass, status, jqXHR) {
		       for (var i=0; i<playerClass.length; i++) {
			   loadPlayerItem(playerClass[i]);
		       }
		   }
	       });


	$('#teamForm').on('submit',
			       function (e) {
				   e.preventDefault();
					      }});
			       });


	
    });


var loadPlayerItem = function (playerID) {
    $.ajax(url_base + "/PlayerRun.php/" + playerID,
	{type: "GET",
	 dataType: "json",
	 success: function(player_json, status, jqXHR) {
		var p = new Player(player_json);
		$('#playerTable').append(p.makeCompactDiv());
	    }
});
}

function showDiv() {
   document.getElementById('welcomeDiv').style.display = "block";
}

function showJordanDiv() {
   document.getElementById('JordanDiv').style.display = "block";
}
function showShaqDiv() {
   document.getElementById('ShaqDiv').style.display = "block";
}
function showKareemDiv() {
   document.getElementById('KareemDiv').style.display = "block";
}
function showDirkDiv() {
   document.getElementById('DirkDiv').style.display = "block";
}
