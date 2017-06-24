$(document).ready(function () {

    var reloadAfterClose = false;

    $('.edit').click(handleClickEdit);
    function handleClickEdit() {
        var patientID = this.id;
        $.ajax({
            url: 'showModal.php',
            method: 'POST',
            data: {
                'editId': this.id
            },
            success: function (data, status)
            {
                $('.modal-body').html(data);
                $("#datepicker").datepicker();

                $('#patientForm').submit(function (event) { // catch sending form
                    event.preventDefault(); // don't send
                    var formData = new FormData(document.getElementById('patientForm'));
                    formData.append('editId', patientID);

                    $.ajax({
                        url: 'sendModal.php',
                        type: 'POST',
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (data, status)
                        {
                            alert('Pacient byl upraven.');
                            reloadAfterClose = true;
                            $('#myModal').modal('hide');
                        }
                    }).fail(function () {
                        alert("Úprava pacienta selhala.");
                    });
                });
            }
        });
    }

    $('.add').click(handleClickAdd);
    function handleClickAdd() {
        $.ajax({
            url: 'showModal.php',
            method: 'POST',
            data: {
                'addId': 'TRUE'
            },
            success: function (data, status)
            {
                $('.modal-body').html(data);
                $("#datepicker").datepicker();
                $('#patientForm').submit(function (event) {
                    event.preventDefault();
                    var formData = new FormData(document.getElementById('patientForm'));
                    $.ajax({
                        url: 'sendModal.php',
                        type: 'POST',
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (data, status)
                        {
                            alert('Pacient byl přidán.');
                            reloadAfterClose = true;
                            $('#myModal').modal('hide');
                        }
                    }).fail(function () {
                        alert("Přidání pacienta selhalo.");
                    });
                });
            }
        });
    }

    $('.delete').click(function () {
        $.ajax({
            url: 'showModal.php',
            method: 'POST',
            data: {
                'deleteId': this.id
            },
            success: function (data, status)
            {
                alert("Pacient smazán.");
                location.reload();
            }
        });

    });

    $('#myModal').on('hidden.bs.modal', function () {
        if (reloadAfterClose) {
            location.reload();
            reloadAfterClose = false;
        }
    });


});