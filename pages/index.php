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
    <?php include("csslink/styles.php"); ?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="?page=index" class="site_title"><h2><b>Warehouse Systems</b></h2></a>
                    </div>

                    <!-- Profile Quick Info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="../images/9440461.jpg" alt="Profile Image" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['SES_LOGIN'] ?? "User"; ?></h2>
                        </div>
                    </div>
                    <!-- /Profile Quick Info -->

                    <br />

                    <!-- Menu -->
                    <?php include("jscript/js.php"); ?>
                    <?php include("menu.php"); ?>
                    <!-- /Menu -->
                </div>
            </div>

            <!-- Top Navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../images/user.png" alt=""><?php echo $_SESSION['SES_LOGIN']; ?>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="?pages=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
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
                    </nav>
                </div>
            </div>
            <!-- /Top Navigation -->

            <!-- Page Content -->
            <div class="right_col" role="main">
                <div class="post">
                    <div class="post-center">
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
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
</body>
</html>
