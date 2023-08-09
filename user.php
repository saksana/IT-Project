<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';
    $sql = "SELECT tbuser.userid,tbuser.fullname,tbuser.tel,tbuser.position,tbuser.partid,tbpart.partname,tbuser.deid,tbdepartment.dename,tbuser.officeid,tboffice.officename,tbuser.status,tbuser.username,tbuser.password FROM tbuser LEFT JOIN tbpart ON tbuser.partid = tbpart.partid LEFT JOIN tbdepartment ON tbuser.deid = tbdepartment.deid LEFT JOIN tboffice ON tbuser.officeid = tboffice.officeid";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

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
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຜູ້ໃຊ້ງານ</span></div>
                    <div class="mt-4">
                        <a href="userfrmsave.php" class="btn btn-primary btn-sm px-3 py-2">
                            ເພີ່ມຂໍ້ມູນ
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive-sm">
                        <?php if ($count > 0) { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr style="font-weight:600;">
                                        <td class="fst-normal"></td>
                                        <td>ຊື່ແລະນາມສະກຸນ</td>
                                        <td>ເບີໂທ</td>
                                        <td>ຝ່າຍ</td>
                                        <td>ພະແນກ</td>
                                        <td>ຫ້ອງການ-ສາຂາ</td>
                                        <td>ສະຖານະ</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php //echo $row["adminid"]; 
                                                ?></td>
                                            <td><?php echo $row["fullname"]; ?></td>
                                            <td><?php echo $row["tel"]; ?></td>
                                            <td><?php echo $row["partname"]; ?></td>
                                            <td><?php echo $row["dename"]; ?></td>
                                            <td><?php echo $row["officename"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td>
                                            <td class="text-center"><a href="userfrmedit.php?id=<?php echo $row["userid"]; ?>" class="btn btn-warning btn-sm">ຈັດການ</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                                ບໍ່ມີຂໍ້ມູນຜູ້ໃຊ້
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {

    header("Location: admin/adminlogin.php");

    exit();
}

?>