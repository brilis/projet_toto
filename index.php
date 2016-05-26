<?php

require 'inc/db.php';

$sql = '
	SELECT ses_opening, ses_ending, ses_id
	FROM session 
';
$pdoStatement = $pdo->query($sql);
//si erreur
if ($pdoStatement === false) {
	print_r($pdo->errorInfo());
}
// sinon
else {
	//je recupere toutes les donnees
	$sessionList = $pdoStatement->fetchAll();
	//print_r($sessionList);
}

$etudiantListe = array();
$citiesList = array(
	1 => 'Arlon',
	2 => 'Luxembourg',
	3 => 'Verdun',
	4 => 'Longwy',
	5 => 'Rodange',
	6 => 'Pissange',
	7 => 'Pétange',
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
	6 => 'Allemagne',
);
$maritalStatusList = array(
	1 => 'Célibataire',
	2 => 'Marié(e)',
	3 => 'Divorcé(e)',
	4 => 'Veuf/veuve',
);


$sql = '
	SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
	FROM student
	LEFT OUTER JOIN country ON country.cou_id = student.cou_id
	LEFT OUTER JOIN city ON city.cit_id = student.cit_id
	LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
';
$pdoStatement = $pdo->query($sql);

// Si erreur
if ($pdoStatement === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	$etudiantListe = $pdoStatement->fetchAll();
}

require 'inc/header.php';
require 'inc/index_view.php';
require 'inc/add_view.php';
require 'inc/footer.php';

