<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">
<?php
require '../connect/connect.php';
$time = date("H:i:s");
$date = $_POST['antdate'];
$newdate =  str_replace('/', '-', $date); 
$dt = date("Y-m-d", strtotime($newdate))." ".$time;  

$antid=$_POST['antid'];
$antdate= $dt;
$adminid=$_POST['adminid'];
$userid=$_POST['userid'];
$device=$_POST['device'];
$brand=$_POST['brand'];
$sn=$_POST['sn'];
$os=$_POST['os'];
$uninstall=$_POST['uninstall'];
$install=$_POST['install'];
$scan=$_POST['scan'];
$detail=$_POST['detail'];

$sql = "update tbdataan set antid='$antid',antdate='$antdate',adminid='$adminid',userid='$userid',device='$device',brand='$brand',sn='$sn',os='$os',uninstall='$uninstall',install='$install',scan='$scan',detail='$detail' WHERE antid='$antid'";
$result = mysqli_query($con, $sql);
if ($result) {
    $link_address = "../antivirusdashbroad.php";
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
    echo mysqli_error($con);
}

?>