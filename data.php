<?php

require_once 'libdb.php';
// insert name of your database
DB::init("yourDatabase");

class patient {

    protected $id;
    protected $name;
    protected $surname;
    protected $birthdate;
    protected $address;
    protected $phone;
    protected $diagnoses;

    function __construct($id, $name, $surname, $birthdate, $address, $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->phone = $phone;
        $this->diagnoses = array();
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getSurname() {
        return $this->surname;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function getBirthdate() {
        return $this->birthdate;
    }

    function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    function getAddress() {
        return $this->address;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function getPhone() {
        return $this->phone;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function getDiagnoses() {
        // adding new patient, id is '', list of diagnoses is empty
        if ($this->id == '') {
            $listOfPatientDiagnoses = array();
        } else {
            $diagnosesId = DB::doSql("SELECT diagnosis_id FROM patient_diagnosis WHERE patient_id=" . DB::toSql($this->id));

            // array of patient's current diagnoses
            $listOfPatientDiagnoses = array();
            $i = 0;
            foreach ($diagnosesId as $diagnosesArray) {

                foreach ($diagnosesArray as $diagnosis) {

                    $listOfPatientDiagnoses[$i] = $diagnosis;
                    $i++;
                }
            }
        }
        return $listOfPatientDiagnoses;
    }

    function setDiagnoses($addedDiagnoses) {
        $this->diagnoses = $addedDiagnoses;
    }

    function savePatient($id = null) {
        // if there is an id, patient existed and we're editing row, so we use UPDATE
        if ($id) {
            $sql = sprintf(
                    "UPDATE patient SET name=%s, surname=%s, birthdate=%s, address=%s, phone=%s WHERE id=%s",
                    DB::toSql($this->getName(), TRUE),
                    DB::toSql($this->getSurname(), TRUE),
                    DB::toSql($this->getBirthdate(), TRUE),
                    DB::toSql($this->getAddress(), TRUE),
                    DB::toSql($this->getPhone(), TRUE),
                    DB::toSql($id)
            );
            DB::doSql($sql);
        } else { // if patient didn't exist, we must use INSERT to create new row
            $sql = sprintf(
                    "INSERT INTO patient SET name=%s, surname=%s, birthdate=%s, address=%s, phone=%s",
                    DB::toSql($this->getName(), TRUE),
                    DB::toSql($this->getSurname(), TRUE),
                    DB::toSql($this->getBirthdate(), TRUE), 
                    DB::toSql($this->getAddress(), TRUE), 
                    DB::toSql($this->getPhone(), TRUE)
            );
            DB::doSql($sql);
            $this->id = mysqli_insert_id(DB::getDB());
        }

        // delete all saved diagnoses
        DB::doSql("DELETE FROM patient_diagnosis WHERE patient_id=" . DB::toSql($this->id));

        // insert all chosen diagnoses
        foreach ($this->diagnoses as $diagnosisId) {
            DB::doSql("INSERT INTO patient_diagnosis SET patient_id=" . DB::toSql($this->id) . ", diagnosis_id=" . DB::toSql($diagnosisId));
        }
    }

    // delete patient from database
    function delete() {
        DB::doSql("DELETE FROM patient WHERE id=" . DB::toSql($this->id));
        DB::doSql("DELETE FROM patient_diagnosis WHERE patient_id=" . DB::toSql($this->id));
    }

}

class diagnosis {

    protected $id;
    protected $name;
    protected $description;

    // function for making new diagnosis object
    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

}

// array of all existing diagnoses ordered by id
$diagnoses = DB::doSql("SELECT * FROM diagnosis ORDER BY id");
$listOfDiagnoses = array();
foreach ($diagnoses as $diagnosis) {
    $listOfDiagnoses[$diagnosis['id']] = new diagnosis($diagnosis['id'], $diagnosis['name']);
}

// array of all existing patients ordered by surname
$patients = DB::doSql("SELECT * FROM patient ORDER BY surname");
$listOfPatients = array();
foreach ($patients as $patient) {
    $listOfPatients[$patient['id']] = new patient($patient['id'], $patient['name'], $patient['surname'], $patient['birthdate'], $patient['address'], $patient['phone']);
}