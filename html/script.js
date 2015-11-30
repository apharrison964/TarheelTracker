// This function may not be working right
function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

// TODO: function not working, pressing submit just resets the page
function makeTable() {
	var table = document.createElement("TABLE");
	table.setAttribute("id", "createdTable");
	table.border = "1";
	document.body.appendChild(table);
	alert("It reached where it is about to create the row");
	var row = document.createElement("TR");
	row.setAttribute("id", "row");
	document.getElementById("createdTable").appendChild(row);
	
	var column = document.createElement("TD");
	column.setAttribute("id", "column");
	document.getElementById("createdTable").appendChild(column);
	
	var getTeamForm = document.getElementById("teamForm");
	insertAfter(getTeamForm, createTable);
}

