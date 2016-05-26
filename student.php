<?php

require 'inc/db.php';


if (!empty($_GET['stu_id'])) {
	$studentID = $_GET['stu_id'];


	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE stu_id = :studentID
	';
	$pdoStatement = $pdo->prepare($sql);

	$pdoStatement->bindValue(':studentID', $studentID , PDO::PARAM_INT );

	// Si erreur
	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else if ($pdoStatement->rowCount() > 0) {
		$etudiantListe = $pdoStatement->fetch();
	}
}


$jour = $etudiantListe['birthdate'][8].$etudiantListe['birthdate'][9];
$mois = $etudiantListe['birthdate'][5].$etudiantListe['birthdate'][6];


require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

  $zodiacSign = $calculator->calculate(intval($jour),intval($mois));


$traductionFr = array(

	'libra' => 'balance' ,
	'aries' => 'bélier' ,
	'cancer' => 'cancer' ,
	'capricorn' => 'capricorne' ,
	'gemini' => 'gémeaux' ,
	'lion' => 'lion' ,
	'pisces' => 'poissons' ,
	'sagittarius' => 'sagittaire' ,
	'scorpio' => 'scorpion' ,
	'taurus' => 'taureau' ,
	'aquarius' => 'verseau' ,
	'virgo' => 'vierge' ,
 );


try {
$zodiaque = $traductionFr[$zodiacSign];
} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}
require 'inc/header.php';
require 'inc/student_view.php';
require 'inc/footer.php';

