<?php
require 'connect/connect.php';
if (isset($_POST['partid'])) {
    $id = $_POST['partid'];
    $sql = "SELECT * FROM tbdepartment where partid='$id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        //echo '<option selected disabled value="">--ເລືອກ--</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['deid'] . '>' . $row['dename'] . '</option>';
        }
    } else {
        echo "<option>ບໍ່ມີຂໍ້ມູນ id: $id</option>";
    }
} else {
    echo 'no';
}
