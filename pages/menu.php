<?php
$outstandingCount = $db->countOutstandingPutAway();
?>

<!-- Sidebar Menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu bg-light p-3">
    <div class="menu_section">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['pages'] == "dashboard") ? "active" : ""; ?>" href="?pages=dashboard">
                    <i class="fa fa-home me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['pages'] == "m_catalog") ? "active" : ""; ?>" href="?pages=m_catalog">
                    <i class="fa fa-barcode me-2"></i>Catalog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['pages'] == "stock_list") ? "active" : ""; ?>" href="?pages=stock_list">
                    <i class="fa fa-plus me-2"></i>Stock List
                </a>
            </li>

            <!-- Inbound Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#inboundMenu" role="button" aria-expanded="false" aria-controls="inboundMenu">
                    <i class="fa fa-sign-in me-2"></i>Inbound<span class="fa fa-chevron-down ms-2"></span>
                </a>
                <div class="collapse" id="inboundMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "good_receive") ? "active" : ""; ?>" href="?pages=good_receive">Good Receive</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "good_receive_report") ? "active" : ""; ?>" href="?pages=good_receive_report">Good Receive Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "put_away") ? "active" : ""; ?>" href="?pages=put_away">
                                Put Away
                                <?php if ($outstandingCount > 0) { ?>
                                    <span class="badge bg-danger ms-2"><?php echo $outstandingCount; ?></span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Outbound Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#outboundMenu" role="button" aria-expanded="false" aria-controls="outboundMenu">
                    <i class="fa fa-sign-out me-2"></i>Outbound<span class="fa fa-chevron-down ms-2"></span>
                </a>
                <div class="collapse" id="outboundMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "order_list") ? "active" : ""; ?>" href="?pages=order_list">Order List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "goods_issue") ? "active" : ""; ?>" href="?pages=goods_issue">Good Issue List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "ready_pickup") ? "active" : ""; ?>" href="?pages=ready_pickup">Pickup List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Report Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#reportMenu" role="button" aria-expanded="false" aria-controls="reportMenu">
                    <i class="fa fa-bar-chart me-2"></i>Report<span class="fa fa-chevron-down ms-2"></span>
                </a>
                <div class="collapse" id="reportMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "receive_item") ? "active" : ""; ?>" href="?pages=receive_item">Report Item Receive</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "usage_item") ? "active" : ""; ?>" href="?pages=usage_item">Report Item Usage</a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Master Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#masterMenu" role="button" aria-expanded="false" aria-controls="masterMenu">
                    <i class="fa fa-cogs me-2"></i>Master<span class="fa fa-chevron-down ms-2"></span>
                </a>
                <div class="collapse" id="masterMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($_GET['pages'] == "master_brand") ? "active" : ""; ?>" href="?pages=master_brand">Master Brand</a>
                        </li>
                        <!-- Add additional master items here -->
                        <?php if ($_SESSION['SES_LEVEL'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($_GET['pages'] == "master_user") ? "active" : ""; ?>" href="?pages=master_user">Master User</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
