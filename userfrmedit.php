<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    if (isset($_GET["id"])) {
        require 'connect/connect.php';
        $id = $_GET["id"];
        $sql = "select * from tbuser where userid='$id'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $sqlp = "select * from tbpart";
        $resultp = mysqli_query($con, $sqlp);

        $partid = $row['partid'];
        $sqlde = "select * from tbdepartment where partid = '$partid'";
        $resultde = mysqli_query($con, $sqlde);

        $sqlof = "select * from tboffice";
        $resultof = mysqli_query($con, $sqlof);

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User</title>
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
                        <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຈັດການຂໍ້ມູນຜູ້ໃຊ້ງານ</span></div>
                        <?php if ($count > 0) { ?>
                            <div class="text-end mt-1 me-2"><a onclick="checkdelete(<?php echo $id ?>)" class="btn btn-danger btn-sm p-2 px-3">ລົບຂໍ້ມູນ</a></div>
                            <form action="user/useredit.php" method="POST">
                                <div class="row">
                                    <div class="d-non col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ລະຫັດ</label>
                                        <input name="userid" type="text" class="form-control form-control-sm bg-light" placeholder="" value="<?php echo $row['userid'] ?>" readonly>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ຊື່ຜູ້ໃຊ້ງານ</label></label>
                                        <input name="fullname" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['fullname'] ?>">
                                        <div class="invalid-feedback ms-2">
                                            *ກະລຸນາໃສ່ຊື່ຜູ້ໃຊ້ງານ
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ເບີໂທ</label>
                                        <input name="tel" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['tel'] ?>">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ຕຳແໜ່ງ</label>
                                        <input name="position" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['position'] ?>">
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ຝ່າຍ</label>
                                        <select id="part" onchange="FetchDepartment(this.value)" class="form-select form-select-sm" name="partid">
                                            <?php while ($rowp = mysqli_fetch_row($resultp)) { ?>
                                                <option value="<?php echo $rowp[0] ?>" <?php if ($rowp[0] == $row['partid']) echo 'selected="selected"'; ?>><?php echo $rowp[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ພະແນກ</label>
                                        <select id="department" class="form-select form-select-sm" name="deid">
                                            <?php while ($rowde = mysqli_fetch_row($resultde)) { ?>
                                                <option value="<?php echo $rowde[0] ?>" <?php if ($rowde[0] == $row['deid']) echo 'selected="selected"'; ?>><?php echo $rowde[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label selected disabled class="mx-1 mt-3 mb-1">ຫ້ອງການສາຂາ</label>
                                        <select class="form-select form-select-sm" name="officeid">
                                            <?php while ($rowof = mysqli_fetch_row($resultof)) { ?>
                                                <option value="<?php echo $rowof[0] ?>" <?php if ($rowof[0] == $row['officeid']) echo 'selected="selected"'; ?>><?php echo $rowof[1] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback ms-2">
                                            *ກະລຸນາເລືອກສາຂາ
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">Username</label>
                                        <input name="username" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['username'] ?>">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">Password</label>
                                        <input name="password" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['password'] ?>">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-6">
                                        <label class="mx-1 mt-3 mb-1">ສະຖານະ</label>
                                        <select class="form-select form-select-sm" name="status">
                                            <option value="Active" <?php if ($row['status'] == 'Active') echo 'selected="selected"'; ?>>Active</option>
                                            <option value="NotActive" <?php if ($row['status'] == 'NotActive') echo 'selected="selected"'; ?>>Not Active</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <input type="submit" class="btn btn-sm btn-primary py-2" data-bs-dismiss="modal" value="ອັບເດດຂໍ້ມູນ" />
                                        <a href="user.php" type="button" class="btn btn-sm btn-danger px-3 py-2">ຍົກເລີກ</a>
                                    </div>
                                </div>
                            </form>
                        <?php } else {
                            header("Location: user.php");
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
                            window.location.href = "user/userdelete.php?id=" + id;
                        }
                    })
                }
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
        header("Location: user.php");
        exit();
    }
} else {

    header("Location: userlogin.php");

    exit();
}

?>