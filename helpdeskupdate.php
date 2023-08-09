<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';
    $sql = "SELECT tbupdateticket.upticketdate,tbupdateticket.sttid,tbstatus.sttname, tbupdateticket.upticketdetail,tbupdateticket.ticketid,tbticket.userid,tbuser.fullname,tbupdateticket.admin,tbticket.detail FROM tbupdateticket LEFT JOIN tbstatus ON tbupdateticket.sttid = tbstatus.sttid LEFT JOIN tbticket ON tbupdateticket.ticketid = tbticket.ticketid LEFT JOIN tbuser ON tbticket.userid = tbuser.userid ORDER BY tbupdateticket.upticketid DESC";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/nav.css">
        <style>
            .myalert {
                
                color: #005580;
            }
        </style>
    </head>

    <body>
        <?php require 'navadmin.php';
        ?>
        <div style="padding-top: 45px;">
            <?php require 'menu.php' ?>
            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຕິດຕາມງານ</span></div>
                    <hr>
                    <?php if ($count > 0) { ?>
                        <div class="table-responsive-sm mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <td class="c">ວັນທີ</td>
                                        <td class="c">ລະຫັດແຈ້ງບັນຫາ</td>
                                        <td class="c">ຜູ້ແຈ້ງບັນຫາ</td>
                                        <td class="c">ຂໍ້ມູນການແຈ້ງ</td>
                                        <td class="c">ອັບສະຖານະເປັນ</td>
                                        <td class="c">ໝາຍເຫດ</td>
                                        <td class="c">ຜູ້ອັບເດດ</td>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $newDate = date("d/m/Y H:i:s", strtotime($row["upticketdate"]));
                                    ?>
                                        <tr class="text-center r">
                                            <td class="text-center"><?php echo $newDate ?></td>
                                            <td><a class="text-decoration-none" href="helpdeskmanage.php?id=<?php echo $row["ticketid"]; ?>"><?php echo $row["ticketid"]; ?></a></span></td>
                                            <td><?php echo $row["fullname"]; ?></td>
                                            <td><?php echo $row["detail"]; ?></td>
                                            <td><label class="myalert"><?php echo $row["sttname"]; ?></label>
                        </div>
                        </td>
                        <td><?php echo $row["upticketdetail"]; ?></td>
                        <td class="text-center"><?php echo $row["admin"]; ?></td>
                        <td class="text-center"><a style="font-size:0.8rem" href="helpdeskmanage.php?id=<?php echo $row["ticketid"]; ?>" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>

            <?php } else { ?>
                <div class="alert alert-danger mt-3">
                    ບໍ່ມີຂໍ້ມູນ
                </div>
            <?php } ?>
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