<?php

require '../inc/db.php';
require 'students_session2.php';

$sqlMail =
	 'SELECT stu_email
	  FROM student
';
$emailListe = array();
$pdoStatementMail = $pdo->query($sqlMail);

// Si erreur
if ($pdoStatementMail === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatementMail->rowCount() > 0) {
	$emailListe = $pdoStatementMail->fetchAll();
}
	

foreach ($emailListe as $key => $emailListe1) {
	foreach ($emailListe1 as $key1 => $email1) {
		$emailListeFinal[] = $email1;
	}
}

/*echo "<pre>";
print_r($emailListeFinal);
echo "<pre>";*/

$sql = '
	INSERT INTO student (stu_name, stu_firstname,stu_birthdate ,stu_email, stu_sex, stu_with_experience, stu_is_leader) 
	VALUES (:name, :firstname, :birthdate, :email,:sex , :with_experience, :is_leader)
';

	

foreach ($studentsList as $keySt => $valueStudent) {
	$name = $valueStudent['name'];
	$firstname = $valueStudent['firstname'];
	$birthdate = $valueStudent['birthdate'];
	$email = $valueStudent['email'];
	$sex = $valueStudent['sex'];
	$with_experience = $valueStudent['with_experience'];
	$is_leader = $valueStudent['is_leader'];


	$emailTest = false;

	if (in_array($email, $emailListeFinal)) {
		$emailTest = true;
		echo "existe";
	} else {
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':name',$name);
		$pdoStatement->bindValue(':firstname',$firstname);
		$pdoStatement->bindValue(':birthdate',$birthdate);
		$pdoStatement->bindValue(':email',$email);
		$pdoStatement->bindValue(':sex',$sex);
		$pdoStatement->bindValue(':with_experience',$with_experience, PDO::PARAM_INT);
		$pdoStatement->bindValue(':is_leader',$is_leader, PDO::PARAM_INT);
		$pdoStatement->execute();
		echo "Inseré";
	}
}

/*echo "<pre>";
print_r($valueStudent);
echo "<pre>";*/