<?php
require_once 'data.php';
?>
<html>
    <div class="container">
        <head>
            <title>MediApp</title>
            <link rel="shortcut icon" href="mediApp.ico"/> 
            <meta charset="utf-8" /> 
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
            <link rel="stylesheet" href="css/style.css" />
            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="mediApp.js"></script>
            <link rel="stylesheet" href="css/font-awesome.min.css" />

        </head>
        <body>
            <section>
                <header>
                    <h1><img src="mediApp.png" alt="logo"/> MediApp</h1>
                </header>
                <h2>Seznam pacientů</h2>
                <div class="patientBox">
                    <table class="table">
                        <ul class="list-group">
                            <?php
                            foreach ($listOfPatients as $idPatient => $parametrsOfPatients) {
                                echo "<tr><td width=80% style='border-top: none;'>"
                                . "<li class='list-group-item'>{$parametrsOfPatients->getName()} {$parametrsOfPatients->getSurname()}"
                                . "</td>"
                                . "<td width=20% style='border-top: none;'>"
                                . "<button id=" . $idPatient . ' type="button" class="btn btn-default btn-lg edit" data-toggle="modal" data-target="#myModal">'
                                . '<i class="fa fa-pencil" aria-hidden="true"></i></button>'
                                . " <button id=" . $idPatient . ' type="button" class="btn btn-danger btn-lg delete">'
                                . '<i class="fa fa-times" aria-hidden="true"></i></button></li>'
                                . '</td></tr>';
                            }
                            if ($listOfPatients == NULL) {
                                echo "<p>Seznam je prázdný.</p>";
                            }
                            ?>
                        </ul>
                    </table>
                </div>
                <div class="rightMenu">
                    <button type="button" class="btn btn-success btn-lg add" id="add-button" data-toggle="modal" data-target="#myModal">Přidat pacienta</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog" style="text-align:left;">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h2 class="modal-title">Karta pacienta</h2>
                            </div>
                            <div class="modal-body">
                                <!-- this part is in showModal.php file -->
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </body>
    </div>
</html>