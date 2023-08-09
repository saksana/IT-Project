<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../css/style.css">
<?php
require '../connect/connect.php';
$id = $_GET["id"];
$sql = "delete from tbadmin where adminid = '$id'";
$result = mysqli_query($con, $sql);
if ($result) {
    $link_address = "../admin.php";
    echo "<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: 'success',
                    title: 'ສຳເຫຼັດ',
                    text: 'ລົບຂໍ້ມູນແລ້ວ',
                    showConfirmButton : false,
                    timer:1500,
                    footer: '<a class=" . '"btn btn-primary"' . " href=" . "$link_address" . ">OK</a>'
                  });
            });
            </script>";
    header("refresh:1.5, Url=$link_address");
    exit();
} else {
    echo mysqli_error($con);
}
