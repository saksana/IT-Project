<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">
<?php
session_start();
require '../connect/connect.php';
date_default_timezone_set("Asia/Bangkok");
$ticketid = $_GET['ticketid'];
$sttid = 'S04';
$upticketdetail = $_GET['detail'];;
$upticketdate= date("Y-m-d H:i:s");
$admin = $_SESSION['adminname'];
$sql = "update tbticket set sttid='$sttid' where ticketid ='$ticketid'";
$result = mysqli_query($con, $sql);
if ($result) {
    $sqldt = "INSERT INTO tbupdateticket(upticketdate,sttid,upticketdetail,ticketid,admin ) VALUES('$upticketdate','$sttid','$upticketdetail','$ticketid','$admin')";
    $resultdt = mysqli_query($con, $sqldt);
    if ($resultdt) {
        $link_address = "../helpdesk.php";
        echo "<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'ສຳເຫຼັດ',
                    text: 'ອັບເດດຂໍ້ມູນແລ້ວ',
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