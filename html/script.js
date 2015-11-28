function insertAfter( referenceNode, newNode ) {
    referenceNode.parentNode.insertBefore( newNode, referenceNode.nextSibling );
}

var x = document.createElement("TABLE");
// TODO: Add object for table to be created under (somewhere in the carousel)
insertAfter(TODO , x);
