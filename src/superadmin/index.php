<?php
include "../backend/session.php";
include "../backend/functions.php";
include "check_login.php";


$save_user = [];
$errors = array();
$success_message = "";

if (isset($_POST["submit"])) {
    // Validate input
    if (empty($_POST['lastName'])) {
        $errors[] = "Last Name is required.";
    }

    if (empty($errors)) {
        // Simulate user saving
        $save_user = save_superadmin($_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password'], $_POST['account']);
        if ($save_user) {
            // Set success message
            $success_message = "Account Creation Successful!";
        }
    }
}

?>





<?php include "layouts/_header_eval_forms.php" ?>

<body>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="src/images/logo_profile.png" alt="">
                        </span>
                        <span class="user-name">
                            <?= $_SESSION['firstName'] ?>
                            <?= $_SESSION['lastName'] ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="logout.php?logout=true"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.php">
                <img src="src/images/curma-logo-dark.png" alt="" class="dark-logo">
                <img src="src/images/curma_logo_light.png" alt="" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Create Accounts</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Super Admin</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Accounts</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Export List</a>
                                    <a class="dropdown-item" href="#">Policies</a>
                                    <a class="dropdown-item" href="#">View Assets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Create New Admin/Staff Account<span style="font-style: italic;"></span></h4>
                            <?php if (!empty($errors)) { ?>
                                <?php include "../layouts/_error-messages.php" ?>
                            <?php } ?>
                            <?php if (!empty($success_message)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $success_message ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <form method="post" class="myForm" autocomplete="off" onchange="toggleFields()">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Last Name:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="lastName" id="lastName" value="<?= $_POST['lastName'] ?>"
                                    placeholder="Last Name" type="text" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">First Name:</label>
                            <div class="col-sm-12 col-md-10">
                                <input  class="form-control" name="firstName" id="firstName" value="<?= $_POST['firstName'] ?>"
                                    placeholder="First Name" type="text" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Email:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="email" id="email" value="<?= $_POST['email'] ?>"
                                    placeholder="Email" type="email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Password: </label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="password" id="password" value="<?= $_POST['password'] ?>"
                                    placeholder="***************"  type="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Account Type:</label>
                            <div class="col-sm-12 col-md-10">
                                <select name="account" id="account" value="<?= $_POST['account'] ?>" class="form-control" required>
                                    <option value="" >--- Select Account Type ---</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="government">Government</option>
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="SAVE" />
                </div>
                </form>
            </div>
        </div>
        <script>
            function showAlert(message) {
                alert(message);
            }
        </script>
    <?php include "layouts/_footer_eval_forms.php" ?>