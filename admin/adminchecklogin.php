<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">
<?php
session_start();
$name = $_POST['username'];
include '../connect/connect.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $usn = $_POST['username'];
    $psw = $_POST['password'];
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    if (empty($username)) {
        header("Location: adminlogin.php?psw=$psw&erroru=*ກະລຸນາປ້ອນຊື່ຜູ້ໃຊ້");
        exit();
    } else if (empty($password)) {
        header("Location: adminlogin.php?usn=$usn&errorp=*ກະລຸນາປ້ອນລະຫັດຜ່ານ");
        exit();
    } else {
        $sql = "SELECT * FROM tbadmin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                echo "Logged in!";
                $_SESSION['adminid'] = $row['adminid'];
                $_SESSION['adminname'] = $row['adminname'];
                $_SESSION['username'] = $row['username'];
                header("Location: ../dashboard.php");
                exit();
            } else {
                //
            }
        } else {
            $link_address = "adminlogin.php?usn=$usn&psw=$psw";
            $btn = "btn btn-warning";
            // header("Location: login.php?error=*ຊື່ຜູູ້ໃຊ້ ຫຼື ລະຫັດຜ່ານ ບໍ່ຖືກຕ້ອງ !");
            echo "<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ຊື່ຜູູ້ໃຊ້ ຫຼື ລະຫັດຜ່ານ ບໍ່ຖືກຕ້ອງ!',
                    showConfirmButton : false,
                    timer:2000,
                    footer: '<a class=".'"btn btn-primary"'." href=" . "$link_address" . ">OK</a>'
                  });
            });
            </script>";
            header("refresh:2, Url=$link_address");
            exit();
        }
    }
} else {
    header("Location: adminlogin.php");
    exit();
}
