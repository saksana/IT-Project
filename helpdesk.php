<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    require 'connect/connect.php';

    $sql = "SELECT tbticket.ticketid,tbticket.ticketdate,tbticket.userid,tbuser.fullname, tbticket.ticketinfo,tbticket.tickettype,tbticket.detail,tbticket.img, tbticket.sttid,tbstatus.sttname FROM tbticket LEFT JOIN tbuser on tbticket.userid = tbuser.userid LEFT JOIN tbstatus ON tbticket.sttid = tbstatus.sttid ORDER BY tbticket.ticketid DESC";
    $result = mysqli_query($con, $sql);
    $countall = mysqli_num_rows($result);

    //
    $sql1 = "select * from tbticket where sttid='S01'";
    $result1 = mysqli_query($con, $sql1);
    $count1 = mysqli_num_rows($result1);
    //
    $sql2 = "select * from tbticket where sttid='S02'";
    $result2 = mysqli_query($con, $sql2);
    $count2 = mysqli_num_rows($result2);
    //
    $sql3 = "select * from tbticket where sttid='S03'";
    $result3 = mysqli_query($con, $sql3);
    $count3 = mysqli_num_rows($result3);
    //
    $sql4 = "select * from tbticket where sttid='S04'";
    $result4 = mysqli_query($con, $sql4);
    $count4 = mysqli_num_rows($result4);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Helpdesk</title>
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
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ຂໍ້ມູນການແຈ້ງບັນຫາ</span></div>
                    <hr>
                    <a href="helpdesk.php" class="btn btn-info btn-sm mt-1 py-1">ລາຍການທັງໝົດ <span class="badge bg-white text-dark fs-6" style="font-family: 'Times New Roman';"><?php echo $countall  ?></span></a>
                    <a href="selecthelpdesk.php?sttid=S01" class="btn btn-primary btn-sm mt-1 py-1">ລໍຖ້າດຳເນີນງານ <span class="badge bg-white text-dark fs-6" style="font-family: 'Times New Roman';"><?php echo $count1  ?></span></a>
                    <a href="selecthelpdesk.php?sttid=S02" class="btn btn-warning btn-sm mt-1 py-1">ກຳລັງດຳເນີນງານ <span class="badge bg-white text-dark fs-6" style="font-family: 'Times New Roman';"><?php echo $count2  ?></span></a>
                    <a href="selecthelpdesk.php?sttid=S03" class="btn btn-success btn-sm mt-1 py-1">ດຳເນີນງານສຳເລັດ <span class="badge bg-white text-dark fs-6" style="font-family: 'Times New Roman';"><?php echo $count3  ?></span></a>
                    <a href="selecthelpdesk.php?sttid=S04" class="btn btn-danger btn-sm mt-1 py-1">ຍົກເລີກລາຍການ <span class="badge bg-white text-dark fs-6" style="font-family: 'Times New Roman';"><?php echo $count4  ?></span></a>
                  <hr>
                    <div class="text-primary">
                        <span>ຂໍ້ມູນ: ລາຍການທັງໝົດ</span>
                    </div>

                    <?php if ($countall > 0) { ?>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <td>ວັນທີ</td>
                                        <td>ລະຫັດການແຈ້ງບັນຫາ</td>
                                        <td>ຜູ້ໃຊ້</td>
                                        <td>ລາຍລະອຽດ</td>
                                        <td>ສະຖານະ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {
                                        $newDate = date("d/m/Y H:i:s", strtotime($row["ticketdate"]));
                                    ?>
                                        <tr class="text-center">
                                            <td class="text-center"><?php echo $newDate ?></td>
                                            <td><?php echo $row["ticketid"]; ?></td>
                                            <td><?php echo $row["fullname"]; ?></td>
                                            <td><?php echo $row["detail"]; ?></td>
                                            <td class="text-center"><?php echo $row["sttname"]; ?></td>
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