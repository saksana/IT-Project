<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">
<?php
require '../connect/connect.php';
$fullname = $_POST["fullname"];
$tel = $_POST["tel"];
$position = $_POST["position"];
$partid = $_POST["partid"];
$deid = $_POST["deid"];
$officeid = $_POST["officeid"];
$status = $_POST["status"];
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "insert into tbuser(fullname,tel,position,partid,deid,officeid,status,username,password) values('$fullname','$tel','$position','$partid','$deid','$officeid','$status','$username','$password')";
$result = mysqli_query($con, $sql);
if ($result) {
    $link_address = "../user.php";
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
    echo mysqli_error($con);
}

?>