<?php
require_once 'data.php';

if (array_key_exists('editId', $_POST)) {
    // edit patient
    $actPatient = $listOfPatients[$_POST['editId']];
} else {
    // add new patient
    $actPatient = new patient("", "", "", "", "", "");
}

$actPatient->setName($_POST['name']);
$actPatient->setSurname($_POST['surname']);

// convert birthdate to right format
$var = $_POST['birthdate'];
$date = str_replace('/', '-', $var);
$_POST['birthdate'] = date('Y-m-d', strtotime($date));

$actPatient->setBirthdate($_POST['birthdate']);
$actPatient->setAddress($_POST['address']);
$actPatient->setPhone($_POST['phone']);

// create array of added diagnoses
$addedDiagnoses = array();
foreach ($listOfDiagnoses as $diagnosis) {
    if (array_key_exists($diagnosis->getId(), $_POST) && $_POST[$diagnosis->getId()] == 'YES') {
        array_push($addedDiagnoses, $diagnosis->getId());
    }
}
$actPatient->setDiagnoses($addedDiagnoses);

// save patient
if (array_key_exists('editId', $_POST)) {
    $actPatient->savePatient($_POST['editId']);
} else {
    $actPatient->savePatient();
}

