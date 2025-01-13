<?php
session_start(); // Start the session at the very top
include_once '../model/config.php';
include '../model/db.php';

$db = new database();

// Redirect if not logged in
if (!isset($_SESSION['SES_LOGIN'])) {
    header("Location: login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Warehouse | </title>
    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include("csslink/styles.php"); ?>
</head>
<body class="nav-md">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 left_col bg-light">
                <div class="d-flex flex-column vh-100 p-3">
                    <div class="navbar nav_title text-center mb-4">
                        <a href="?page=index" class="site_title"><h2><b>Warehouse Systems</b></h2></a>
                    </div>

                    <!-- Profile Quick Info -->
                    <div class="profile text-center">
                        <div class="profile_pic mb-3">
                            <img src="../images/9440461.jpg" alt="Profile Image" class="rounded-circle" style="width: 80px; height: 80px;">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['SES_LOGIN'] ?? "User"; ?></h2>
                        </div>
                    </div>
                    <!-- /Profile Quick Info -->

                    <!-- Menu -->
                    <?php include("menu.php"); ?>
                    <!-- /Menu -->
                </div>
            </div>

            <!-- Top Navigation -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="../images/user.png" alt="" class="rounded-circle" style="width: 30px; height: 30px;">
                                        <?php echo $_SESSION['SES_LOGIN']; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="?pages=logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <?php
                                        function getUserIpAddr() {
                                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                return $_SERVER['HTTP_CLIENT_IP'];
                                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                return $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            }
                                            return $_SERVER['REMOTE_ADDR'];
                                        }
                                        echo 'User IP - ' . getUserIpAddr();
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <main>
                    <div class="container_content">
                        <?php
                        if (isset($_GET['pages'])) {
                            include $_GET['pages'] . ".php";
                        } else {
                            include 'dashboard.php';
                        }
                        ?>
                        <?php include("footer.php"); ?>
                    </div>
                </main>
                <!-- /Page Content -->
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS -->
   
    <?php include("jscript/js.php"); ?>
</body>
</html>
