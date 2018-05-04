function deleteAliment (id) {
	var msg = "voulez vous supprimer ?";
	if (confirm(msg)) {
		location.replace("delete.php?id=" +id);
	}
}