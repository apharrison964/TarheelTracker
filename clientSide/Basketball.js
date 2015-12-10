
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
