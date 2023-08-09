<?php
require 'connect/connect.php';
if (isset($_POST['deid'])) {
    $id = $_POST['deid'];
    $sql = "SELECT * from tbuser WHERE deid='$id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        echo '<option selected disabled value="">--ເລືອກ--</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['userid'] . '>' . $row['fullname'] . '</option>';
        }
    } else {
        echo "<option selected disabled>--ເລືອກ--</option>";
    }
} else {
    echo 'no';
}
