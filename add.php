<?php

// Gestion du POST
$errorList = array();
// Si le formulaire a été soumis
if (!empty($_POST)) {
	// Je récupère tous les champs du formulaires
	// si isset($_POST['studentName']) == true alors récupère la valeur de $_POST['studentName'], sinon, la valeur ''
	$name = isset($_POST['studentName']) ? $_POST['studentName'] : '';
	/*équivalent à
	if (isset($_POST['studentName'])) {
		$name = $_POST['studentName'];
	}
	else {
		$name = '';
	}*/
	$firstname = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
	$email = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
	$birthdate = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
	$cityID = isset($_POST['cit_id']) ? intval($_POST['cit_id']) : 0;
	$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
	$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;

	if (empty($name)) {
		$errorList[] = 'Le nom est vide';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
	}
	if (empty($email)) {
		$errorList[] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'L\'email est incorrect';
	}
	if (empty($birthdate)) {
		$errorList[] = 'La date de naissance est vide';
	}
	if (empty($cityID)) {
		$errorList[] = 'La ville est manquante';
	}
	if (empty($countryID)) {
		$errorList[] = 'La nationalité est manquante';
	}

	if (empty($errorList)) {
		echo 'je peux insérer en DB<br />';
	}
	// Sinon, afficher le contenu du tableau $errorList dans view.php
}



require 'add_view.php';