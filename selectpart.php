<?php
require 'connect/connect.php';
if (isset($_POST['officeid'])) {
    $id = $_POST['officeid'];
    $sql = "SELECT DISTINCT tbuser.partid,tbpart.partname FROM tbuser INNER JOIN tbpart on tbuser.partid = tbpart.partid WHERE officeid='$id'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        echo '<option selected disabled value="">--ເລືອກ--</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['partid'] . '>' . $row['partname'] . '</option>';
        }
    } else {
        echo "<option selected disabled>--ເລືອກ--</option>";
    }
} else {
    echo 'no';
}
