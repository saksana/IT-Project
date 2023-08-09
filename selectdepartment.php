<?php
require 'connect/connect.php';
if (isset($_POST['partid'])) {
    $id = $_POST['partid'];
    $sql = "SELECT DISTINCT tbuser.deid,tbdepartment.dename FROM tbuser INNER JOIN tbdepartment ON tbuser.deid = tbdepartment.deid WHERE tbuser.partid ='$id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        echo '<option selected disabled value="">--ເລືອກ--</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['deid'] . '>' . $row['dename'] . '</option>';
        }
    } else {
        echo "<option>ບໍ່ມີຂໍ້ມູນ</option>";
    }
} else {
    echo 'no';
}
