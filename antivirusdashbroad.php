<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';
    $sql = "SELECT tbdataan.antid,tbdataan.antdate,tbdataan.adminid,tbadmin.adminname,tbdataan.userid,tbuser.fullname,tbdataan.device, tbdataan.brand,tbdataan.sn,tbdataan.os,tbdataan.install,tbdataan.uninstall,tbdataan.scan,tbdataan.detail FROM tbdataan LEFT JOIN tbadmin ON tbdataan.adminid = tbadmin.adminid LEFT JOIN tbuser ON tbdataan.userid =tbuser.userid";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Antivirus dashboard</title>
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
                <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຂໍ້ມູນການຕິດຕັ້ງ Antivirus</span></div>
                    <div class="mt-3">
                        <a href="antivirusfrmsave.php" class="btn btn-primary btn-sm px-3 py-2">ສ້າງລາຍການ</a>
                    </div>
                    <hr>
                    <div class="table-responsive-sm">
                        <?php if ($count > 0) { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr style="font-weight:600;">
                                        <td>ລະຫັດ</td>
                                        <td>ວັນທີ</td>
                                        <td>ຊື່ຜູ້ໃຊ້ງານ</td>
                                        <td>ອຸປະກອນ</td>
                                        <td>ແບນ</td>
                                        <td>ຕິດຕັ້ງ</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $newDate = date("d/m/Y H:i:s", strtotime($row["antdate"]));
                                     ?>
                                        <tr>
                                            <td><?php echo $row["antid"]; ?></td>
                                            <td><?php echo $newDate; ?></td>
                                            <td><?php echo $row["fullname"]; ?></td>
                                            <td><?php echo $row["device"]; ?></td>
                                            <td><?php echo $row["brand"]; ?></td>
                                            <td><?php echo $row["install"]; ?></td>
                                            <td class="text-center"><a href="antivirusfrmedit.php?antid=<?php echo $row["antid"]; ?>" class="btn btn-warning btn-sm">ຈັດການ</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                                ບໍ່ມີຂໍ້ມູນ
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