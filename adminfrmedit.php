<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    if (isset($_GET["id"])) {
        require 'connect/connect.php';
        $id = $_GET["id"];
        $sql = "select * from tbadmin where adminid='$id'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
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
                        <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຈັດການຂໍ້ມູນຜູ້ດູແລລະບົບ</span></div>
                        <?php if ($count > 0) { ?>
                            <div class="text-end mt-1 me-2"><a onclick="checkdelete(<?php echo $id ?>)" class="btn btn-danger btn-sm p-2 px-3">ລົບຂໍ້ມູນ</a></div>
                            <div class="row px-lg-3 px-md-2">
                                <form action="admin/adminedit.php" method="POST">
                                    <div class="col-lg-6 col-md-8 col-sm-12 col-12">
                                        <div class="d-none">
                                            <label class="mx-1 mb-1">ລະຫັດ</label>
                                            <input name="adminid" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['adminid']; ?>" readonly>
                                        </div>
                                        <label class="mx-1 mb-1">ຊື່ຜູ້ດູແລລະບົບ</label>
                                        <input name="adminname" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['adminname']; ?>">
                                        <label class="mx-1 mt-3 mb-1">ເບີໂທ</label>
                                        <input name="tel" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['tel']; ?>">
                                        <label class="mx-1 mt-3 mb-1">ພະແນກ</label>
                                        <select class="form-select form-select-sm" name="department">
                                            <option value="ໄອທີ" selected="selected">ໄອທີ</option>
                                        </select>
                                        <label class="mx-1 mt-3 mb-1">ບ່ອນປະຈຳການ</label>
                                        <select class="form-select form-select-sm" name="office">
                                            <option value="ສຳນັກງານໃຫຍ່" selected="selected">ສຳນັກງານໃຫຍ່</option>
                                        </select>
                                        <label class="mx-1 mt-3 mb-1">Username</label>
                                        <input name="username" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['username']; ?>">
                                        <label class="mx-1 mt-3 mb-1">Password</label>
                                        <input name="password" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['password']; ?>">
                                        <!-- Modal footer -->
                                        <div class="mt-3">
                                            <input type="submit" class="btn btn-sm btn-primary py-2" data-bs-dismiss="modal" value="ອັບເດດຂໍ້ມູນ" />
                                            <a href="admin.php" class="btn btn-sm btn-danger px-3 py-2">ຍົກເລີກ</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } else {
                            header("Location: admin.php");
                            exit();
                        } ?>
                    </div>
                </div>
                <div class="footer mt-3">

                </div>
            </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="js/script.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                function checkdelete(data) {
                    let id = data;
                    Swal.fire({
                        title: 'ແຈ້ງເຕືອນ',
                        text: "ຕ້ອງການລົບຂໍ້ມູນຫຼືບໍ່",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "admin/admindelete.php?id=" + id;
                        }
                    })
                }
            </script>
        </body>

        </html>

<?php
    } else {
        header("Location: admin.php");
        exit();
    }
} else {

    header("Location: adminlogin.php");

    exit();
}

?>