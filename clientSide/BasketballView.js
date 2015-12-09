var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f15/users/apharri3/Codiad/workspace/finalProject/serverSide";
console.log("What is going on");
$("#playerTable").html("<table border='1'><tr><td>Field1</td><td>Field2</td></tr><tr><td>Content1</td><td>Content2</td></tr></table>");

$(document).ready(function () {

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
				   $.ajax(url_base + "/PlayerRun.php",
					  {type: "POST",
						  dataType: "json",
						  data: $(this).serialize(),
						  success: function(todo_json, status, jqXHR) {
						  var p = new Player(todo_json);
						  $('#todo_list').append(p.makeCompactDiv());
					      },
						  error: function(jqXHR, status, error) {
						  alert(jqXHR.responseText);
					      }});
			       });


	$('#playerForm').on('submit',
			   'form.edit_form',
			   null,
			   function (e) {
			       e.preventDefault();
			       var edit_div = $(this).parent();
			       var p = edit_div.data('todo');
			       $.ajax(url_base + "/PlayerRun.php/" + p.playerID,
				      {type: "POST",
					      dataType: "json",
					      data: $(this).serialize(),
					      success: function(todo_json, status, jqXHR) {
					      var p = new Player(todo_json);
					      edit_div.replaceWith(p.makeCompactDiv());
					  },
					      error: function(jqXHR, status, error) {
					      alert(jqXHR.responseText);
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
