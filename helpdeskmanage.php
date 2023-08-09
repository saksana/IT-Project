<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    $id = $_GET['id'];
    require 'connect/connect.php';
    $sql = "SELECT tbticket.ticketid,tbticket.ticketdate,tbticket.userid,tbuser.fullname, tbuser.tel,tbuser.position,tbuser.partid,tbpart.partname,tbuser.deid,tbdepartment.dename,tbuser.officeid, tboffice.officename,tbticket.ticketinfo,tbticket.tickettype,tbticket.detail,tbticket.img,tbticket.sttid,tbstatus.sttname FROM tbticket LEFT JOIN tbuser ON tbticket.userid = tbuser.userid LEFT JOIN tbpart ON tbuser.partid = tbpart.partid LEFT JOIN tbdepartment on tbuser.deid = tbdepartment.deid LEFT JOIN tboffice ON tbuser.officeid = tboffice.officeid LEFT JOIN tbstatus ON tbticket.sttid = tbstatus.sttid WHERE tbticket.ticketid = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $newDate = date("d/m/Y H:i:s", strtotime($row["ticketdate"]));

    $limtsttid = $row['sttid'];
    $sqlstt = "select * from tbstatus where sttid != 'S04' AND sttid > '$limtsttid'";
    $resultstt = mysqli_query($con, $sqlstt);

    $id = $row['ticketid'];

    $sqlup = "SELECT tbupdateticket.upticketdate,tbstatus.sttname,tbupdateticket.admin,tbupdateticket.upticketdetail FROM tbupdateticket LEFT JOIN tbstatus ON tbupdateticket.sttid = tbstatus.sttid WHERE ticketid = '$id'";
    $resultup = mysqli_query($con, $sqlup);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/nav.css">
        <style>

        </style>
    </head>

    <body>
        <?php require 'navadmin.php';
        ?>
        <div style="padding-top: 45px;">
            <?php require 'menu.php' ?>
            <div id="main" class="contents">
                <div class="container">
                    <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ລາຍລະອຽດການແຈ້ງບັນຫາ</span></div>

                    <div class="text-end my-2">
                        <?php if ($row['sttid'] != 'S04') { ?>
                            <a onclick="checkcancle('<?php echo $id ?>')" class="btn btn-danger btn-sm p-2">ຍົກເລີກລາຍການ</a>
                        <?php } ?>
                    </div>


                    <div class="table-responsive-md">
                        <table class="table table-striped table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-end"><label class="me-3">ລະຫັດ</label></td>
                                    <td><?php echo $row["ticketid"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ວັນທີ</label></td>
                                    <td><?php echo $newDate; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຊື່ຜູ້ແຈ້ງ</label></td>
                                    <td><?php echo $row["fullname"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ເບີໂທ</label></td>
                                    <td><?php echo $row["tel"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຕຳແໜ່ງ</label></td>
                                    <td><?php echo $row["position"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຝ່າຍ</label></td>
                                    <td><?php echo $row["partname"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ພະແນກ</label></td>
                                    <td><?php echo $row["dename"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຫ້ອງການສາຂາ</label></td>
                                    <td><?php echo $row["officename"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ກ່ຽວກັບບັນຫາ</label></td>
                                    <td><?php echo $row["ticketinfo"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ປະເພດບັນຫາ</label></td>
                                    <td><?php echo $row["tickettype"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຂໍ້ມູນການແຈ້ງ</label></td>
                                    <td><?php echo $row["detail"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ຮູບພາບປະກອບ</label></td>
                                    <td><?php echo $row["img"]; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-end"><label class="me-3">ສະຖານະປະຈຸບັນ</label></td>
                                    <td class="text-primary fs-6"><?php echo $row["sttname"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-sm btn-primary p-2" data-bs-toggle="modal" data-bs-target="#myModal">ອັບເດດສະຖານະ</a>
                        <a onclick="history.back()" class="btn btn-sm btn-danger p-2 px-3">ຍ້ອນກັບ</a>
                    </div>
                    <hr>
                    <label>ປະຫວັດ</label>
                    <div class="alert alert-danger mt-3">ຂໍ້ມູນການແຈ້ງບັນຫາ : <?php echo $row["detail"]; ?></div>
                    <?php while ($rowup = mysqli_fetch_assoc($resultup)) { ?>
                        <div class="alert alert-info">
                            <div>ສະຖານະ : <?php echo $rowup["sttname"]; ?></div>
                            <div>ວັນທີ : <?php echo $rowup["upticketdate"]; ?></div>
                            <div>ຜູ້ອັບເດດຂໍ້ມູນ : <?php echo $rowup["admin"]; ?></div>
                            <div>ລາຍລະອຽດການອັບເດດ : <?php echo $rowup["upticketdetail"]; ?></div>
                        </div>
                    <?php } ?>
                    <div class="footer" style="height: 50px;">

                    </div>


                    <form action="ticket/ticketupdate.php" method="post" class="needs-validation" novalidate>
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <label class="modal-title">ອັບເດດສະຖານະ</label>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label class="form-label">ລະຫັດ</label>
                                            <input type="text" name="ticketid" class="form-control form-control-sm" value="<?php echo $row['ticketid'] ?>" readonly required>
                                        </div>
                                        <label class="form-label">ສະຖານະ</label>
                                        <select name="sttid" class="form-select form-select-sm" required>
                                            <option value="" selected disabled>ເລືອກ</option>
                                            <?php while ($rowstt = mysqli_fetch_row($resultstt)) { ?>
                                                <option value="<?php echo $rowstt[0] ?>"><?php echo $rowstt[1] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="form-label mt-2">ລາຍລະອຽດການອັບເດດ</label>
                                        <textarea name="detail" rows="3" class="form-control" required></textarea>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-sm btn-primary" value="ອັບເດດຂໍ້ມູນ" />
                                        <button type="button" class="btn btn-sm btn-danger px-4" data-bs-dismiss="modal">ປິດ</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                'use strict'
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
        <script>
            function checkcancle(data) {
                let id = data;
                let detail;
                Swal.fire({
                    text: "ຕ້ອງການຍົກເລີກລາຍການຫຼືບໍ່?",
                    input: 'text',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK, cancle it',
                    cancelButtonText: 'Exit',
                    animation: "slide-from-top",
                    inputPlaceholder: "ລາຍລະອຽດຍົກເລີກລາຍການ"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value == "") {
                            detail = 'ຍົກເລີກລາຍການ';
                        } else {
                            detail = result.value;
                        }
                        window.location.href = "ticket/ticketcancle.php?ticketid=" + id + "&detail=" + detail;
                    }
                })
            }
        </script>
    </body>

    </html>

<?php

} else {

    header("Location: admin/adminlogin.php");

    exit();
}

?>