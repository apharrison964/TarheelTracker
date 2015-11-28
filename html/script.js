function insertAfter( referenceNode, newNode ) {
    referenceNode.parentNode.insertBefore( newNode, referenceNode.nextSibling );
}

function makeTable() {
	var table = document.createElement("TABLE");
	table.setAttribute("id", "createdTable");
	table.border = "1";
	document.body.appendChild(table);
	
	var row = document.createElement("TR");
	row.setAttribute("id", "row");
	document.getElementById("createdTable").appendChild(row);
	
	var column = document.createElement("TD");
	column.setAttribute("id", "column");
	document.getElementById("createdTable").appendChild(column);
	
	var getTeamForm = document.getElementById("teamForm");
	insertAfter(getTeamForm, createTable);
}

