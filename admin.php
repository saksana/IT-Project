<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';
    $sql = "select * from tbadmin";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    $sqlde = "select * from tbdepartment";
    $resultde = mysqli_query($con, $sqlde);
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
        <style>

        </style>
    </head>

    <body>
        <?php require 'navadmin.php';
        ?>
        <div style="padding-top: 45px;">
            <?php require 'menu.php' ?>
            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຜູ້ດູແລລະບົບ</span></div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary btn-sm px-3 py-2" data-bs-toggle="modal" data-bs-target="#myModal">
                            ເພີ່ມຂໍ້ມູນ
                        </button>
                        <!-- The Modal -->
                        <form action="admin/adminsave.php" method="POST" class="needs-validation" novalidate>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <span class="fs-6" style="font-weight:600;">ຂໍ້ມູນຜູ້ດູແລລະບົບ</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <label class="mx-1 mb-1">ຊື່ຜູ້ດູແລລະບົບ</label>
                                            <input name="adminname" type="text" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-3 mb-1">ເບີໂທ</label>
                                            <input name="tel" type="text" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-3 mb-1">ພະແນກ</label>
                                            <select class="form-select form-select-sm" name="department">
                                                <option value="ໄອທີ" selected="selected">ໄອທີ</option>
                                            </select>
                                            <label class="mx-1 mt-3 mb-1">ບ່ອນປະຈຳການ</label>
                                            <select class="form-select form-select-sm" name="office">
                                                <option value="ສຳນັກງານໃຫຍ່" selected="selected">ສຳນັກງານໃຫຍ່</option>
                                            </select>
                                            <label class="mx-1 mt-3 mb-1">Username</label>
                                            <input name="username" type="text" class="form-control form-control-sm" placeholder="" required>
                                            <label class="mx-1 mt-3 mb-1">Password</label>
                                            <input name="password" type="text" class="form-control form-control-sm" placeholder="" required>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-sm btn-primary py-2" value="ບັນທຶກຂໍ້ມູນ" />
                                            <button type="button" class="btn btn-sm btn-danger px-3 py-2" data-bs-dismiss="modal">ປິດ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="table-responsive-sm">
                        <?php if ($count > 0) { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr style="font-weight:600;">
                                        <td class="fst-normal"></td>
                                        <td>ຊື່ຜູ້ດູແລລະບົບ</td>
                                        <td>ເບີໂທ</td>
                                        <td>ພະແນກ</td>
                                        <td>ສຳນັກງານ</td>
                                        <td>username</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $deleteid = $row["adminid"];
                                    ?>
                                        <tr>
                                            <td><?php //echo $row["adminid"]; 
                                                ?></td>
                                            <td><?php echo $row["adminname"]; ?></td>
                                            <td><?php echo $row["tel"]; ?></td>
                                            <td><?php echo $row["department"]; ?></td>
                                            <td><?php echo $row["office"]; ?></td>
                                            <td><?php echo $row["username"]; ?></td>
                                            <td class="text-center"><a href="adminfrmedit.php?id=<?php echo $row["adminid"]; ?>" class="btn btn-warning btn-sm">ຈັດການ</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                                ບໍ່ມີຂໍ້ມູນຜູ້ດູແລລະບົບ
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="footer mt-3">

                </div>
            </div>
        </div>
        <script src="js/script.js"></script>
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
    </body>

    </html>

<?php

} else {

    header("Location: adminlogin.php");

    exit();
}

?>