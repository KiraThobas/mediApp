<?php
require_once 'data.php';

// edit or add button was pressed
if (array_key_exists('editId', $_POST) || array_key_exists('addId', $_POST)) {

    // if add button was pressed, create new empty patient
    if (array_key_exists('addId', $_POST)) {
        $actPatient = new patient("", "", "", "", "", "");
    } else {
        // edit button - add patient with sent id
        $actPatient = $listOfPatients[$_POST['editId']];
    }
    ?>

    <form id="patientForm" method="POST">
        <table class="table">
            <tr>
                <th>jméno:</th>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($actPatient->getName()); ?>"></td>
            </tr>
            <tr>
                <th>příjmení:</th>
                <td><input type="text" name="surname" value="<?php echo htmlspecialchars($actPatient->getSurname()); ?>"></td>
            </tr>
            <tr>
                <th>datum narození:</th>
                <td><input type="text" id="datepicker" name="birthdate" value="<?php echo htmlspecialchars($actPatient->getBirthdate()); ?>"></td>
            </tr>
            <tr>
                <th>adresa:</th>
                <td><textarea name="address" cols="20" rows="3"><?php echo htmlspecialchars($actPatient->getAddress()); ?></textarea></td>
            </tr>
            <tr>
                <th>telefonní číslo:</th>
                <td><input type="text" name="phone" value="<?php echo htmlspecialchars($actPatient->getPhone()); ?>"></td>
            </tr>
        </table>

        <h3>Diagnózy:</h3>
        <?php
        // checking for actual diagnoses of actual patient

        $actDiagnoses = $actPatient->getDiagnoses();

        // go through all existing diagnoses, all of them print to list
        echo '<ul class="list-group">';
        foreach ($listOfDiagnoses as $diagnosisId => $parametrsOfDiagnosis) {
            $diaName = $parametrsOfDiagnosis->getName();
            echo "
            <div class='checkbox'>
                <li class='list-group-item'><label><input type='checkbox' name='{$diagnosisId}' value='YES'";
            // if current diagnosis is in patient's diagnoses list, toggle its checkbox
            if ($actDiagnoses) {
                foreach ($actDiagnoses as $actDiagnosis) {
                    if ($diagnosisId == $actDiagnosis) {
                        echo "checked";
                    }
                }
            }
            echo ">{$diaName}</label></li>
            </div>";
        }
        echo '</ul>';
        ?>
        <div class="right">
            <button type="submit" class="btn btn-success send"><i class="fa fa-check" aria-hidden="true"></i></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </form>

    <?php
// delete button was pressed, delete patient
} elseif (array_key_exists('deleteId', $_POST)) {
    $listOfPatients[$_POST['deleteId']]->delete();
}
    
    

