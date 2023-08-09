<?php
session_start();
$userid = $_SESSION['userid'];
require 'connect/connect.php';
$userid = $_SESSION['userid'];
$sql = "SELECT tbupdateticket.upticketdate,tbupdateticket.sttid,tbstatus.sttname, tbupdateticket.upticketdetail,tbupdateticket.ticketid,tbticket.userid,tbuser.fullname,tbupdateticket.admin,tbticket.detail FROM tbupdateticket LEFT JOIN tbstatus ON tbupdateticket.sttid = tbstatus.sttid LEFT JOIN tbticket ON tbupdateticket.ticketid = tbticket.ticketid LEFT JOIN tbuser ON tbticket.userid = tbuser.userid WHERE tbticket.userid='$userid' ORDER BY tbupdateticket.upticketid DESC";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

$sqlt = "select * from tbtickettype";
$resultt = mysqli_query($con, $sqlt);

$sqlall = "select * from tbticket where userid='$userid'";
$resultall = mysqli_query($con, $sqlall);
$countall = mysqli_num_rows($resultall);

$sql1 = "select * from tbticket where userid='$userid' AND sttid='S01'";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

$sql2 = "select * from tbticket where userid='$userid' AND sttid='S02'";
$result2 = mysqli_query($con, $sql2);
$count2 = mysqli_num_rows($result2);

$sql3 = "select * from tbticket where userid='$userid' AND sttid='S03'";
$result3 = mysqli_query($con, $sql3);
$count3 = mysqli_num_rows($result3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>user</title>
</head>

<body class="bg-white">
    <?php require 'navuser.php' ?>
    <div class="container">
        <div class="mt-3 bg-white">
            <a href="#" class="btn btn-sm btn-primary px-3 py-2" data-bs-toggle="modal" data-bs-target="#myModal">ແຈ້ງບັນຫາ</a>
        </div>
        <!-- The Modal -->
        <form action="ticket/ticketsave.php" method="post">
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <label>ບັນທຶກການແຈ້ງບັນຫາ</label>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div>
                                <label>ລະຫັດຜູ້ໃຊ້ງານ</label>
                                <input name="userid" type="text" class="form-control" value="<?php echo $_SESSION['userid'] ?>" />
                            </div>
                            <div>
                                <label>ບັນຫາກ່ຽວກັບ</label>
                                <select name="info" class="form-select form-select-sm">
                                    <option value="" selected>--ເລືອກ--</option>
                                    <option>Hardware</option>
                                    <option>Software</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label>ປະເພດບັນຫາ</label>
                                <select name="type" class="form-select form-select-sm">
                                    <option value="" selected>--ເລືອກ--</option>
                                    <?php while ($rowt = mysqli_fetch_assoc($resultt)) { ?>
                                        <option><?php echo $rowt['tickettypename'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label>ລາຍລາຍອຽດ</label>
                                <textarea name="detail" class="form-control"></textarea>
                            </div>
                            <div class="mt-2">
                                <label>ຮູບພາບ</label>
                                <input name="img" type="file" class="form-control" />
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="ບັນທຶກ">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ປິດ</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <div class="card mt-2">
                    <div class="card-body text-center py-4"><span style="font-size:2.5rem"><?php echo $countall ?></span></div>
                    <div class="card-footer text-center"><a class="btn btn-sm text-primary" href="ticket/ticketfollow.php">ການແຈ້ງບັນຫາ</a></div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <div class="card mt-2">
                    <div class="card-body text-center py-4"><span style="font-size:2.5rem"><?php echo $count1 ?></span></div>
                    <div class="card-footer text-center"><a class="btn btn-sm text-primary" href="#">ລໍຖ້າດຳເນີນງານ</a></div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <div class="card mt-2">
                    <div class="card-body text-center py-4"><span style="font-size:2.5rem"><?php echo $count2 ?></span></div>
                    <div class="card-footer text-center"><a class="btn btn-sm text-primary" href="#">ກຳລັງດຳເນີນງານ</a></div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <div class="card mt-2">
                    <div class="card-body text-center py-4"><span style="font-size:2.5rem"><?php echo $count3 ?></span></div>
                    <div class="card-footer text-center bg-white"><a class="btn btn-sm text-primary" href="#">ດຳເນີນງານສຳເຫຼັດ</a></div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <label class="">ປະຫວັດການອັບເດດຂໍ້ມູນ</label>
            <?php if ($count > 0) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr style="font-weight:600;">
                            <td>ວັນທີ</td>
                            <td>ຂໍ້ມູນການແຈ້ງ</td>
                            <td>ຜູ້ອັບເດດຂໍ້ມູນ</td>
                            <td>ສະຖານະ</td>
                            <td>ລາຍລະອຽດ</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                            $newDate = date("d/m/Y H:i:s", strtotime($row["upticketdate"]));
                        ?>
                            <tr>
                                <td><?php echo $newDate; ?></td>
                                <td><?php echo $row["detail"]; ?></td>
                                <td><?php echo $row["admin"]; ?></td>
                                <td><?php echo $row["sttname"]; ?></td>
                                <td><?php echo $row["upticketdetail"]; ?></td>
                                <!-- <td class="text-center"><a href="userfrmedit.php?id=" class="btn btn-warning btn-sm">ຈັດການ</a></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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