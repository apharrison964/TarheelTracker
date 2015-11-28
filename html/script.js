function insertAfter( referenceNode, newNode ) {
    referenceNode.parentNode.insertBefore( newNode, referenceNode.nextSibling );
}

function makeTable() {
	var table = document.createElement("TABLE");
	table.border = "1";
	document.body.appendChild(table);
	var getTeamForm = document.getElementById("teamForm");
	insertAfter(getTeamForm, createTable);
}

