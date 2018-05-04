function deleteContact (id) {
	var msg = "voulez vous supprimer ce contact";
	if (confirm(msg)) {
		location.replace("delete.php?id=" +id);
	}
}
function deleteUsers (id) {
	var msg = "voulez vous supprimer cet utilisateur";
	if (confirm(msg)) {
		location.replace("deleteUser.php?id=" +id);
	}
}