<?php
session_start();
require '../connect/connect.php';
$userid = $_SESSION['userid'];
$sql = "select * from tbticket where userid='$userid'";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>follow ticket</title>
</head>

<body>
    <?php require '../navuser.php' ?>
    <div class="container">
        <div class="mt-3">
            <a href="../ticket.php" class="btn btn-sm btn-danger px-3 py-2">ກັບຄືນ</a>
        </div>
        <hr>
        <div>ຕິດຕາມງານ</div>
        <?php if ($count > 0) { ?>
            <table class="table table-striped">
                <thead>
                    <tr style="font-weight:600;">
                        <td class="fst-normal"></td>
                        <td>ລະຫັດ</td>
                        <td>ວັນທີ</td>
                        <td>ບັນຫາກ່ຽວກັບ</td>
                        <td>ປະເພດບັນຫາ</td>
                        <td>ລາຍລະອຽດ</td>
                        <td>ສະຖານະ</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php //echo $row["adminid"]; 
                                ?></td>
                            <td><?php echo $row["ticketid"]; ?></td>
                            <td><?php echo $row["ticketdate"]; ?></td>
                            <td><?php echo $row["ticketinfo"]; ?></td>
                            <td><?php echo $row["tickettype"]; ?></td>
                            <td><?php echo $row["detail"]; ?></td>
                            <td><?php echo $row["sttid"]; ?></td>
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

    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>