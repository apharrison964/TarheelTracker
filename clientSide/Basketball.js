
var Player = function(player_json) {
    this.firstName = player_json.firstName;
    this.lastName = player_json.lastName;
    this.position = player_json.position;
    this.firstSeason = player_json.firstSeason;
    this.lastSeason = player_json.lastSeason;
    this.heightFeet = player_json.heightFeet;
    this.heightInches = player_json.heightInches;
    this.weight = player_json.weight;
    this.college = player_json.college;
    this.birthDate = player_json.birthDate;
    this.playerID = player_json.playerID;
};

Player.prototype.makeCompactDiv = function() {
    var compactDiv = $("<div></div>");
    compactDiv.addClass('player');

    var firstNameDiv = $("<div></div>");
    firstNameDiv.addClass('firstName');
    firstNameDiv.html(this.firstName);
    contentDiv.append(firstNameDiv);

    var lastNameDiv = $("<div></div>");
    lastNameDiv.addClass('lastName');
    lastNameDiv.html(this.lastName);
    contentDiv.append(lastNameDiv);

    compactDiv.data('player', this);

    return contentDiv;
};

Player.prototype.makeEditDiv = function() {
    var ediv = $("<div></div>");

    var ediv_form = $("<form></form>");
    ediv_form.addClass('edit_form');
    
    ediv_form.append($("<input type='text' name='title'>").val(this.title));
    ediv_form.append("<br>");

    ediv_form.append($("<textarea name='note'></textarea>").val(this.note));
    ediv_form.append("<br>");

    ediv_form.append("Project: ");
    ediv_form.append($("<input type='text' name='project'>").val(this.project));
    ediv_form.append("<br>");

    ediv_form.append("Due Date: ");
    if (this.due_date) {
	ediv_form.append($("<input type='text' name='due_date'>").val(this.due_date.toDateString()));
    } else {
	ediv_form.append($("<input type='text' name='due_date'>"));
    }
    ediv_form.append("<br>");

    ediv_form.append("Priority: ");
    ediv_form.append($("<input type='text' name='priority'>").val(this.priority));
    ediv_form.append("<br>");

    ediv_form.append("Complete ");
    complete_checkbox = $("<input type='checkbox' name='complete' value=1>");
    if (this.complete) {
	complete_checkbox[0].checked = true;
    }
    ediv_form.append(complete_checkbox);
    ediv_form.append("<br>");

    ediv_form.append("<button type='submit'>Save</button><button type='button' class='cancel'>Cancel</button>");
    ediv.append(ediv_form);
    
    ediv.data('player', this);
    return ediv;
}
