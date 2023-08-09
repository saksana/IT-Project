<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';

    $sqlp = "select * from tbpart";
    $resultp = mysqli_query($con, $sqlp);

    $sqlof = "select * from tboffice";
    $resultof = mysqli_query($con, $sqlof);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/nav.css">
    </head>

    <body>
        <?php require 'navadmin.php';
        ?>
        <div style="padding-top: 45px;">
            <?php require 'menu.php' ?>
            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ເພີ່ມຂໍ້ມູນຜູ້ໃຊ້ງານ</span></div>
                    <form action="user/usersave.php" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="d-none col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ລະຫັດ
                                    <input name="userid" type="text" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ຊື່ຜູ້ໃຊ້ງານ</label></label>
                                <input name="fullname" type="text" class="form-control form-control-sm" placeholder="" required>
                                <div class="invalid-feedback ms-2">
                                    *ກະລຸນາໃສ່ຊື່ຜູ້ໃຊ້ງານ
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ເບີໂທ</label>
                                <input name="tel" type="text" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ຕຳແໜ່ງ</label>
                                <input name="position" list="list" type="text" class="form-control form-control-sm" placeholder="">
                                <datalist id="list">
                                    <option value="ພະນັກງານທົ່ວໄປ">
                                </datalist>
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ຝ່າຍ</label>
                                <select id="part" onchange="FetchDepartment(this.value)" class="form-select form-select-sm" name="partid" required>
                                    <option selected disabled value="" selected="selected">--ເລືອກ--</option>
                                    <?php while ($rowp = mysqli_fetch_row($resultp)) { ?>
                                        <option value="<?php echo $rowp[0] ?>"><?php echo $rowp[1] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback ms-2">
                                    *ກະລຸນາເລືອກຝ່າຍ
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ພະແນກ</label>
                                <select id="department" class="form-select form-select-sm" name="deid">
                                    <option selected disabled value="" selected="selected">--ເລືອກ--</option>
                                </select>
                                <div class="invalid-feedback ms-2">
                                    *ກະລຸນາເລືອກພະແນກ
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label selected disabled class="mx-1 mt-3 mb-1">ຫ້ອງການສາຂາ</label>
                                <select data-size="8" class="form-select form-select-sm" name="officeid" required>
                                    <option selected disabled value="" selected="selected">--ເລືອກ--</option>
                                    <?php while ($rowof = mysqli_fetch_row($resultof)) { ?>
                                        <option value="<?php echo $rowof[0] ?>"><?php echo $rowof[1] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback ms-2">
                                    *ກະລຸນາເລືອກຫ້ອງການສາຂາ
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">Username</label>
                                <input name="username" type="text" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">Password</label>
                                <input name="password" type="text" class="form-control form-control-sm" placeholder="">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                <label class="mx-1 mt-3 mb-1">ສະຖານະ</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="Active">Active</option>
                                    <option value="NotActive">Not Active</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <input type="submit" class="btn btn-sm btn-primary py-2" data-bs-dismiss="modal" value="ບັນທຶກຂໍ້ມູນ" />
                                <a href="user.php" type="button" class="btn btn-sm btn-danger px-3 py-2">ຍົກເລີກ</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!--footer-->
                <div class="footer mt-3">

                </div>
            </div>
        </div>
        <script src="js/script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
        <script type="text/javascript">
            function FetchDepartment(id) {
                $('#department').html('');
                $.ajax({
                    type: 'post',
                    url: 'selectdata.php',
                    data: {
                        partid: id
                    },
                    success: function(data) {
                        $('#department').html(data);
                    }
                })
            }
        </script>
    </body>

    </html>

<?php
} else {
    header("Location: adminlogin.php");
    exit();
}

?>