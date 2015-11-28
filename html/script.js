function insertAfter( referenceNode, newNode ) {
    referenceNode.parentNode.insertBefore( newNode, referenceNode.nextSibling );
}

var createTable = document.createElement("TABLE");
var getTeamForm = document.getElementById("teamForm");
insertAfter(getTeamForm, createTable);
