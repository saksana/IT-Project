<?php
session_start();
if (isset($_SESSION['adminid']) && isset($_SESSION['adminname']) && isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>dashboard</title>
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
                <div class="mt-3"><span class="px-2 fs-6" style="border-left:6px solid #da0b0b;font-weight:600;">ໜ້າຫຼັກ</span></div>
                    <hr>
                    <div class="alert alert-danger mt-3">
                            ບໍ່ມີຂໍ້ມູນ
                        </div>
                </div>
            </div>
        </div>

        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php

} else {

    header("Location: admin/adminlogin.php");

    exit();
}

?>