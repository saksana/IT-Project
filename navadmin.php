<nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color:#0e1aa5">
    <div class="container-fluid px-4">
        <span>
            <a class="navbar-brand d-none d-sm-inline " href="#" style="font-family: 'Trebuchet MS'">IT Department</a>
            <span id="onof" class="on navbtn d-none d-sm-none d-md-inline" style="font-size:30px;cursor:pointer" onclick="onoffnav()">&#9776;</span>
            <span id="mb" class="off navbtn d-inline d-sm-inline d-md-none" style="font-size:30px;cursor:pointer" onclick="mbNav()">&#9776;</span>

        </span>
        <div class="dropdown">
            <a class="" href="" data-bs-toggle="dropdown" style="color:white;text-decoration:none"><i class="fa-regular fa-circle-user fs-4"></i> <?php echo $_SESSION['adminname'] ?></a>
            <ul class="dropdown-menu">
                <li class="text-danger"><a class="dropdown-item text-danger" href="logout.php">ອອກຈາກລະບົບ</a></li>
            </ul>
        </div>
    </div>
</nav>