<?php $session = session();
$id = $session->get('id');
$name = $session->get('name');
$email = $session->get('email');
$role = $session->get('role');
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Eseo CRM">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="Eseo CRM">
    <meta name="robots" content="noindex, nofollow" />




    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Eseo CRM</title>


    <link href="<?= base_url(); ?>assets/css/app.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <style>
            .container.mt-5 {
                background: azure;
            }
        </style> -->

</head>

<body>
    <div class="wrapper">
        <?php echo view('admin/sidebar'); ?>


        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="<?= base_url(); ?>assets/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?= $name ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>