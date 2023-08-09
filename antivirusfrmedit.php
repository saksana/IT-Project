<?php
session_start();
date_default_timezone_set("Asia/Bangkok");


if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
    if (isset($_GET['antid'])) {

        $antid = $_GET['antid'];
        require 'connect/connect.php';
        $adminid = $_SESSION['adminid'];
        $adminname = $_SESSION['adminname'];

        $sql = "SELECT tbdataan.antid,tbdataan.antdate,tbdataan.adminid,tbadmin.adminname,tbdataan.userid,tbuser.fullname,tbdataan.device, tbdataan.brand,tbdataan.sn,tbdataan.os,tbdataan.install,tbdataan.uninstall,tbdataan.scan,tbdataan.detail FROM tbdataan LEFT JOIN tbadmin ON tbdataan.adminid = tbadmin.adminid LEFT JOIN tbuser ON tbdataan.userid =tbuser.userid where antid='$antid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        $date = strtotime($row['antdate']);
        echo $newdate = date('d/m/Y', $date);

        $sqlb = "select * from tbbrand";
        $resultb = mysqli_query($con, $sqlb);

        $sqlos = "select * from tbos";
        $resultos = mysqli_query($con, $sqlos);

        $sqlof = "select * from tboffice";
        $resultof = mysqli_query($con, $sqlof);


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Antivirus</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="css/nav.css">
        </head>

        <body>
            <?php require 'navadmin.php';
            ?>
            <div style="padding-top: 45px;">
                <?php require 'menu.php' ?>
                <div id="main" class="contents">
                    <div class="container">
                        <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ສ້າງລາຍການຕິດຕັ້ງ Antivirus</span></div>
                        <div class="text-end mt-1 me-2"><a onclick="checkdelete('<?php echo $antid ?>')" class="btn btn-danger btn-sm p-2 px-3">ລົບຂໍ້ມູນ</a></div>
                        <form name="myForm" action="form/antivirusedit.php" method="POST" class="" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ລະຫັດ</label>
                                    <input name="antid" type="text" class="form-control form-control-sm" placeholder="" required value="<?php echo $antid ?>" readonly>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ວັນທີ</label>
                                    <input id="dt" name="antdate" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $newdate ?>" required>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ຜູ້ດູແລລະບົບ</label>

                                    <select name="adminid" class="form-select form-select-sm" id="">
                                        <option value="<?php echo $row['adminid'] ?>" selected><?php echo $row['adminname'] ?></option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ຜູ້ໃຊ້ງານ</label>
                                    <span id="erruser" class="text-end text-danger"></span>
                                    <input id="userid" name="userid" type="text" class="form-control form-control-sm d-none" placeholder="" readonly value="<?php echo $row['userid'] ?>">
                                    <div class="input-group">
                                        <input value="<?php echo $row['fullname'] ?>" id="fullname" data-bs-toggle="modal" data-bs-target="#myModal" name="fullname" type="text" class="form-control form-control-sm" placeholder="--ເລືອກ--" readonly onclick="closeerr()">
                                        <span class="input-group-text" onclick="clearuser()" style="cursor: pointer;"><i class="fa-solid fa-xmark"></i></span>
                                    </div>

                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ປະເພດອຸປະກອນ</label>
                                    <span id="errdevice" class="text-end text-danger"></span>
                                    <select name="device" class="form-select form-select-sm" id="" class="required" onchange="cleardevice()">
                                        <option selected disabled value="" selected>--ເລືອກ--</option>
                                        <option value="Computer Desktop" <?php if ($row['device'] == "Computer Desktop") echo "selected" ?>>Computer Desktop</option>
                                        <option value="Computer Laptop" <?php if ($row['device'] == "Computer Laptop") echo "selected" ?>>Computer Laptop</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">brand</label>
                                    <span id="errbrand" class="text-end text-danger"></span>
                                    <select class="form-select form-select-sm" name="brand" onchange="clearbrand()">
                                        <option selected disabled value="" selected>--ເລືອກ--</option>
                                        <?php while ($rowb = mysqli_fetch_row($resultb)) { ?>
                                            <option value="<?php echo $rowb[1] ?>" <?php if ($rowb[1] == $row['brand']) echo "selected" ?>><?php echo $rowb[1] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">S/N</label>
                                    <input id="sn" name="sn" type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row['sn'] ?>">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">OS</label>
                                    <select name="os" class="form-select form-select-sm" id="">
                                        <option selected disabled value="" selected>--ເລືອກ--</option>
                                        <?php while ($rowos = mysqli_fetch_row($resultos)) { ?>
                                            <option value="<?php echo $rowos[1] ?>" <?php if ($rowos[1] == $row['os']) echo "selected" ?>><?php echo $rowos[1] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ຖອນການຕິດຕັ້ງ</label>
                                    <select name="uninstall" class="form-select form-select-sm" id="">
                                        <option selected disabled value="">--ເລືອກ--</option>
                                        <option value="ສຳເລັດ" <?php if ("ສຳເລັດ" == $row['uninstall']) echo "selected" ?>>ສຳເລັດ</option>
                                        <option value="ບໍ່ສຳເລັດ" <?php if ("ບໍ່ສຳເລັດ" == $row['uninstall']) echo "selected" ?>>ບໍ່ສຳເລັດ</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ຕິດຕັ້ງໃໝ່</label>
                                    <select name="install" class="form-select form-select-sm" id="">
                                        <option selected disabled value="">--ເລືອກ--</option>
                                        <option value="ສຳເລັດ" <?php if ("ສຳເລັດ" == $row['install']) echo "selected" ?>>ສຳເລັດ</option>
                                        <option value="ບໍ່ສຳເລັດ" <?php if ("ບໍ່ສຳເລັດ" == $row['install']) echo "selected" ?>>ບໍ່ສຳເລັດ</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label class="mx-1 mt-3 mb-1">ສະແກນ</label>
                                    <select name="scan" class="form-select form-select-sm" id="">
                                        <option selected disabled value="">--ເລືອກ--</option>
                                        <option value="ສຳເລັດ" <?php if ("ສຳເລັດ" == $row['scan']) echo "selected" ?>>ສຳເລັດ</option>
                                        <option value="ບໍ່ສຳເລັດ" <?php if ("ບໍ່ສຳເລັດ" == $row['scan']) echo "selected" ?>>ບໍ່ສຳເລັດ</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-md-6 col-lg-4">
                                    <label id="detail" class="mx-1 mt-3 mb-1">ລາຍລະອຽດ</label>
                                    <textarea class="form-control" name="detail" rows="1"><?php echo $row['detail'] ?></textarea>
                                </div>


                                </textarea>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-sm btn-primary py-2" data-bs-dismiss="modal" value="ອັບເດດຂໍ້ມູນ" />
                                    <a href="antivirusdashbroad.php" type="button" class="btn btn-sm btn-danger px-3 py-2">ຍົກເລີກ</a>
                                </div>

                            </div>
                        </form>

                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <span id="fullname" class="fs-6" style="font-weight:600;">ເລືອກຜູ້ໃຊ້ງານ</span>
                                        <input type="button" class="btn-close" data-bs-dismiss="modal">
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <label class="mx-1 mt-3 mb-1">ບ່ອນປະຈຳການ</label>
                                        <select id="office" onchange="FetchPart(this.value)" class="form-select form-select-sm" name="office">
                                            <option value="" selected disabled>--ເລືອກ--</option>
                                            <?php while ($rowof = mysqli_fetch_row($resultof)) { ?>
                                                <option value="<?php echo $rowof[0] ?>"><?php echo $rowof[1] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label class="mx-1 mt-3 mb-1">ຝ່າຍ</label>
                                        <select id="part" onchange="FetchDepartment(this.value)" class="form-select form-select-sm" name="office">
                                            <option value="" selected disabled>--ເລືອກ--</option>
                                        </select>
                                        <label class="mx-1 mt-3 mb-1">ພະແນກ</label>
                                        <select id="department" onchange="FetchUser(this.value)" class="form-select form-select-sm" name="office">
                                            <option value="" selected disabled>--ເລືອກ--</option>
                                        </select>
                                        <label class="mx-1 mt-3 mb-1">ຜູ້ໃຊ້ງານ</label>
                                        <select id="user" class="form-select form-select-sm" name="selectuser" equired>
                                            <option value="" selected disabled>--ເລືອກ--</option>
                                        </select>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <input onclick="Setvalue()" type="submit" class="btn btn-sm btn-primary px-3 py-2" data-bs-dismiss="modal" value="ເລືອກ" />
                                        <input type="button" class="btn btn-sm btn-danger px-3 py-2" data-bs-dismiss="modal" value="ປິດ" onclick="Clear()">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--footer-->
                    <div class="footer mt-3">

                    </div>
                </div>

            </div>
            <script src="js/script.js"></script>
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            
            <script>
                flatpickr("#dt", {
                    dateFormat: "d/m/Y"
                });
            </script>
            <script type="text/javascript">
                function FetchPart(id) {
                    // $('#department').html('');
                    $('#department').html('<option value="" selected disabled>--ເລືອກ--</option>');
                    $('#user').html('<option value="" selected disabled>--ເລືອກ--</option>');
                    $.ajax({
                        type: 'post',
                        url: 'selectpart.php',
                        data: {
                            officeid: id
                        },
                        success: function(data) {
                            $('#part').html(data);
                        }
                    })
                }

                function FetchDepartment(id) {
                    $('#user').html('<option value="" selected disabled>--ເລືອກ--</option>');
                    $.ajax({
                        type: 'post',
                        url: 'selectdepartment.php',
                        data: {
                            partid: id
                        },
                        success: function(data) {
                            $('#department').html(data);
                        }
                    })
                }

                function FetchUser(id) {
                    // $('#department').html('');
                    $.ajax({
                        type: 'post',
                        url: 'selectuser.php',
                        data: {
                            deid: id
                        },
                        success: function(data) {
                            $('#user').html(data);
                        }
                    })
                }

                function Clear() {
                    //  $('#part').html('<option value="" selected disabled>--ເລືອກ--</option>');
                    //  $('#department').html('<option value="" selected disabled>--ເລືອກ--</option>');
                    //  $('#user').html('<option value="" selected disabled>--ເລືອກ--</option>');
                }

                function Setvalue() {
                    var userid = document.getElementById('user').value;
                    var username = document.getElementById('user');
                    let text = username.options[username.selectedIndex].text;
                    if (text != "--ເລືອກ--") {
                        document.getElementById('userid').value = userid;
                        document.getElementById('fullname').value = text;
                    }
                }

                function validateForm() {
                    var user = document.forms["myForm"]["fullname"].value;
                    var type = document.forms["myForm"]["device"].value;
                    var brand = document.forms["myForm"]["brand"].value;

                    if (user == "") {
                        document.getElementById("erruser").innerHTML = "*ກະລຸນາເລືອກຜູ້ໃຊ້ງານ";
                        document.getElementById("fullname").focus();
                        return false;
                    }
                    if (type == "") {
                        document.getElementById("errdevice").innerHTML = "*ກະລຸນາເລືອກປະເພດອຸປະກອນ";
                        return false;
                    }
                    if (brand == "") {
                        document.getElementById("errbrand").innerHTML = "*ກະລຸນາເລືອກbrand";
                        return false;
                    }
                }

                function closeerr() {
                    document.getElementById("erruser").innerHTML = "";
                }

                function clearuser() {
                    document.getElementById("userid").value = null;
                    document.getElementById("fullname").value = null;
                }

                function cleardevice() {
                    document.getElementById("errdevice").innerHTML = "";
                }

                function clearbrand() {
                    document.getElementById("errbrand").innerHTML = "";
                }
                
            </script>
            <script>
                function checkdelete(data) {
                    let id = data;
                    Swal.fire({
                        title: 'ແຈ້ງເຕືອນ',
                        text: "ຕ້ອງການລົບຂໍ້ມູນຫຼືບໍ່",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "form/antivirusdelete.php?id=" + id;
                        }
                    })
                }
            </script>

        </body>

        </html>

<?php
    } else {
        header("Location: antivirusdashbroad.php");
        exit();
    }
} else {
    header("Location: admin/adminlogin.php");
    exit();
}

?>