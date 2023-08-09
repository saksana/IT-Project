<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">
<?php
require '../connect/connect.php';
date_default_timezone_set("Asia/Bangkok");
$ticketid = "T" . date("ymdHis");
$ticketdate = date("Y-m-d H:i:s");
$userid = $_POST['userid'];
$ticketinfo = $_POST['info'];
$tickettype = $_POST['type'];
$detail = $_POST['detail'];
$upticketdetail='ສ້າງລາຍການໃໝ່';
$img = '';
$sttid = 'S01';
$admin='ຜູ້ໃຊ້ງານ';
$sql = "insert into tbticket(ticketid,ticketdate,userid,ticketinfo,tickettype,detail,img,sttid) values('$ticketid','$ticketdate','$userid','$ticketinfo','$tickettype','$detail','$img','$sttid')";
$result = mysqli_query($con, $sql);
if ($result) {
    $sqlup = "INSERT INTO tbupdateticket(upticketdate,sttid,upticketdetail,ticketid,admin ) VALUES('$ticketdate','$sttid','$upticketdetail','$ticketid','$admin')";
    $resultup = mysqli_query($con, $sqlup);
    if ($resultup) {
        $link_address = "../ticket.php";
        echo "<script>
                $(document).ready(function(){
                    Swal.fire({
                        icon: 'success',
                        title: 'ສຳເຫຼັດ',
                        text: 'ບັນທຶກຂໍ້ມູນແລ້ວ',
                        showConfirmButton : false,
                        timer:2000,
                        footer: '<a class=" . '"btn btn-primary"' . " href=" . "$link_address" . ">OK</a>'
                      });
                });
                </script>";
        header("refresh:2, Url=$link_address");
        exit();
    } else {
        echo 'ບໍ່ສາມາດບັນທຶກການອັບເດດໄດ້';
    }
} else {
    echo mysqli_error($con);
}

?>