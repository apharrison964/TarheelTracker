var url_base = "https://htmlpreview.github.io/?https://github.com/apharrison964/TarheelTracker/blob/master/kmpORM";
// JS isn't rendering because the URL base is connected to KMP's, can we do it with the previewer URL?
$(document).ready(function () {

	$.ajax(url_base + "/todo.php",
	       {type: "GET",
		       dataType: "json",
		       success: function(todo_ids, status, jqXHR) {
		       for (var i=0; i<todo_ids.length; i++) {
			   load_todo_item(todo_ids[i]);
		       }
		   }
	       });


	$('#new_todo_form').on('submit',
			       function (e) {
				   e.preventDefault();
				   $.ajax(url_base + "/todo.php",
					  {type: "POST",
						  dataType: "json",
						  data: $(this).serialize(),
						  success: function(todo_json, status, jqXHR) {
						  var t = new Todo(todo_json);
						  $('#todo_list').append(t.makeCompactDiv());
					      },
						  error: function(jqXHR, status, error) {
						  alert(jqXHR.responseText);
					      }});
			       });

	$('#todo_list').on('dblclick',
			   'div.todo',
			   null,
			   function (e) {
			       var t = $(this).data('todo');
			       $(this).replaceWith(t.makeEditDiv());
			   });

	$('#todo_list').on('submit',
			   'form.edit_form',
			   null,
			   function (e) {
			       e.preventDefault();
			       var edit_div = $(this).parent();
			       var t = edit_div.data('todo');
			       $.ajax(url_base + "/todo.php/" + t.id,
				      {type: "POST",
					      dataType: "json",
					      data: $(this).serialize(),
					      success: function(todo_json, status, jqXHR) {
					      var t = new Todo(todo_json);
					      edit_div.replaceWith(t.makeCompactDiv());
					  },
					      error: function(jqXHR, status, error) {
					      alert(jqXHR.responseText);
					  }});
			   });

	$('#todo_list').on('click',
			   'form.edit_form > button.cancel',
			   null,
			   function (e) {
			       var edit_div = $(this).parent().parent();
			       var t = edit_div.data('todo');
			       edit_div.replaceWith(t.makeCompactDiv());
			   });
    });


var load_todo_item = function (id) {
    $.ajax(url_base + "/todo.php/" + id,
{type: "GET",
 dataType: "json",
 success: function(todo_json, status, jqXHR) {
	var t = new Todo(todo_json);
	$('#todo_list').append(t.makeCompactDiv());
    }
});
}
