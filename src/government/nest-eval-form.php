<?php
require '../backend/db.php';
include "../backend/functions.php";
include "../backend/session.php";
include "../backend/check_login.php";

$errors = [];

if ($_POST['submit']) {
    $errors = validate_data($_POST['location_nest']);
    if (empty($errors)) {
        $save_nesting_data = save_nesting_data(
            $_POST['location_nest'],
            $_POST['latitude'],
            $_POST['longitude'],
            $_POST['clutch_size'],
            $_POST['new_location'],
            $_POST['number_transplanted'],
            $_POST['date_transplanted'],
            $_POST['date_1'],
            $_POST['time_1'],
            $_POST['no_hatchling_1'],
            $_POST['collected_by_1'],
            $_POST['date_2'],
            $_POST['time_2'],
            $_POST['no_hatchling_2'],
            $_POST['collected_by_2'],
            $_POST['date_3'],
            $_POST['time_3'],
            $_POST['no_hatchling_3'],
            $_POST['collected_by_3'],
            $_POST['date_4'],
            $_POST['time_4'],
            $_POST['no_hatchling_4'],
            $_POST['collected_by_4'],
            $_POST['no_egg_hatched'],
            $_POST['no_egg_unhatched'],
            $_POST['no_unhatched_fertile'],
            $_POST['live_piped_eggs'],
            $_POST['dead_piped_eggs'],
            $_POST['without_visible_development'],
            $_POST['predated'],
            $_POST['hatchling_dead_nest'],
            $_POST['hatchling_live_nest'],
            $_POST['turtle_id']
        );
        if ($save_nesting_data) {
            header("Location: nest-record.php");
            exit;
        } else {
            $errors[] = "Could not save data. Please try again later.";
        }
    }
}

$select = "SELECT `id`, `name`, `subject`, SUBSTRING(message, 1, 100) AS preview, `date_created`  FROM `report` ORDER BY `date_created` DESC LIMIT 6";
$query = mysqli_query($connection, $select);

?>

<?php include "layouts/_header_eval_forms.php" ?>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="Search Here">
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="ion-arrow-down-c"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <?php
                                $num = mysqli_num_rows($query);
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo '<li>';
                                        echo '<a href="#">';
                                        echo '<img src="../assets/img/main_page/profile_icon.png" alt="">';
                                        echo '<h3>' . $row['name'] . '</h3>';
                                        echo '<h5>' . $row['subject'] . '</h5>';
                                        echo '<p>' . $row['preview'] . '</p>';
                                        echo '<p>' . date("F m, Y @ g:H a", strtotime($row['date_created'])) . '</p>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-1" checked="">
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-2">
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
                            value="icon-style-3">
                        <label class="custom-control-label" for="sidebaricon-3"><i
                                class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-1" checked="">
                        <label class="custom-control-label" for="sidebariconlist-1"><i
                                class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-2">
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                                aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-3">
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-4" checked="">
                        <label class="custom-control-label" for="sidebariconlist-4"><i
                                class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-5">
                        <label class="custom-control-label" for="sidebariconlist-5"><i
                                class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
                            value="icon-list-style-6">
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">Reset Settings</button>
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
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="index.php">Main Dashboard</a></li>
                            <li><a href="index2.php">Create Material</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-analytics-21"></span><span class="mtext">Nest Management</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="nest-eval-form.php">Nest Evaluation Form</a></li>
                            <li><a href="nest-record.php">Nesting Sites</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="micon icon-copy dw dw-group" aria-hidden="true"></i><span
                                class="mtext">Volunteers</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="volunteer-profile.php">Volunteer Profiles</a></li>
                            <li><a href="manage-volunteers.php">Manage Volunteers</a></li>
                        </ul>
                    </li>
                </ul>
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
                                <h4>Marine Turtle Nest Evaluation</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Nest Management</li>
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
                            <h4 class="text-blue h4">MT06 Marine Turtle Nest Evaluation Form</h4>
                            <?php if (!empty($errors)) { ?>
                                <?php include "../layouts/_error-messages.php" ?>
                            <?php } ?>
                        </div>
                    </div>
                    <form method="post" class="myForm" autocomplete="off">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Island/Location of Nest:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" id="location_nest" name="location_nest"
                                    value="<?= $_POST['location_nest'] ?>" placeholder="Location of Nest...">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Latitude:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="latitude" id="latitude"
                                    value="<?= $_POST['latitude'] ?>" placeholder="Latitude..." readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Longitude:</label>
                            <div class="col-sm-12 col-md-10">
                                <div id="out"></div>
                                <input class="form-control" name="longitude" id="longitude"
                                    value="<?= $_POST['longitude'] ?>" placeholder="longitude..." readonly>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-lg" onclick="getLocation()">Get Location</button>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Clutch Size if Known:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="new_location" id="new_location"
                                    value="<?= $_POST['clutch_size'] ?>" placeholder="Clutch size if known..."
                                    type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">New Location:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="new_location" id="new_location"
                                    value="<?= $_POST['new_location'] ?>" placeholder="New location..." type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Number of Eggs When Transplanted:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="number_transplanted" id="number_transplanted"
                                    value="<?= $_POST['number_transplanted'] ?>"
                                    placeholder="Number of eggs when transplanted..." type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Date Transplanted:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control date-picker" name="date_transplanted" id="date_transplanted"
                                    value="<?= $_POST['date_transplanted'] ?>" placeholder="Select Date" type="text">
                            </div>
                        </div>

                        <!-- Input Table -->
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Emergence:</label>
                            <div class="col-sm-12 col-md-10">
                                <table class="table-input">
                                    <thead>
                                        <tr>
                                            <th>Date of Emergence</th>
                                            <th>Time of Emergence</th>
                                            <th>No. of Hatchlings Emerged</th>
                                            <th>Collected/Recorded by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="date-picker" type="text" name="date_1" id="date_1"
                                                    value="<?= $_POST['date_1'] ?>" placeholder=""></td>
                                            <td><input class="time-picker" type="text" name="time_1" id="time_1"
                                                    value="<?= $_POST['time_1'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="no_hatchling_1" id="no_hatchling_1"
                                                    value="<?= $_POST['no_hatchling_1'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="collected_by_1" id="collected_by_1"
                                                    value="<?= $_POST['collected_by_1'] ?>" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td><input class="date-picker" type="text" name="date_2" id="date_2"
                                                    value="<?= $_POST['date_2'] ?>" placeholder=""></td>
                                            <td><input class="time-picker" type="text" name="time_2" id="time_2"
                                                    value="<?= $_POST['time_2'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="no_hatchling_2" id="no_hatchling_2"
                                                    value="<?= $_POST['no_hatchling_2'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="collected_by_2" id="collected_by_2"
                                                    value="<?= $_POST['collected_by_2'] ?>" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td><input class="date-picker" type="text" name="date_3" id="date_3"
                                                    value="<?= $_POST['date_3'] ?>" placeholder=""></td>
                                            <td><input class="time-picker" type="text" name="time_3" id="time_3"
                                                    value="<?= $_POST['time_3'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="no_hatchling_3" id="no_hatchling_3"
                                                    value="<?= $_POST['no_hatchling_3'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="collected_by_3" id="collected_by_3"
                                                    value="<?= $_POST['collected_by_3'] ?>" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td><input class="date-picker" type="text" name="date_4" id="date_4"
                                                    value="<?= $_POST['date_4'] ?>" placeholder=""></td>
                                            <td><input class="time-picker" type="text" name="time_4" id="time_4"
                                                    value="<?= $_POST['time_4'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="no_hatchling_4" id="no_hatchling_4"
                                                    value="<?= $_POST['no_hatchling_4'] ?>" placeholder=""></td>
                                            <td><input class="" type="text" name="collected_by_4" id="collected_by_4"
                                                    value="<?= $_POST['collected_by_4'] ?>" placeholder=""></td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total Hatchlings Emerged:</td>
                                            <td><input class="" type="text" placeholder=""></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- End of Input Table -->

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">EGGS: </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(S) No. of Eggshell Hatched:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="no_egg_hatched" id="no_egg_hatched"
                                    value="<?= $_POST['no_egg_hatched'] ?>" placeholder="" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(UHT) Unhatched Full Embryo:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="no_egg_unhatched"
                                    value="no_egg_unhatched" value="<?= $_POST['no_egg_unhatched'] ?>" placeholder=""
                                    type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(UH) Unhatched Fertile Eggs:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="no_unhatched_fertile" id="no_unhatched_fertile"
                                    value="<?= $_POST['no_unhatched_fertile'] ?>" placeholder="" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(LPE) Live Piped Eggs:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="live_piped_eggs" id="live_piped_eggs"
                                    value="<?= $_POST['live_piped_eggs'] ?>" placeholder="" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(DPE) Dead Piped Eggs:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="dead_piped_eggs" id="dead_piped_eggs"
                                    value="<?= $_POST['dead_piped_eggs'] ?>" placeholder="" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(UD) Eggs Without Visible
                                Development:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="without_visible_development"
                                    id="without_visible_development"
                                    value="<?= $_POST['without_visible_development'] ?>" placeholder="" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(P) Predated:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" placeholder="" type="number" name="predated" id="predated"
                                    value="<?= $_POST['predated'] ?>" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">HATCHLINGS: </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(DIN) Hatchlings Dead in Nest:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" placeholder="" type="number" name="hatchling_dead_nest"
                                    id="hatching_dead_nest" value="<?= $_POST['hatchling_dead_nest'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">(LIP) Hatchlings Live in Nest:</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" placeholder="" type="number" name="hatchling_live_nest"
                                    id="hatchling_live_nest" value="<?= $_POST['hatchling_live_nest'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Turtle ID (type unknown if not applicable):</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" placeholder="" type="number" name="hatchling_live_nest"
                                    id="hatchling_live_nest" value="<?= $_POST['turtle_id'] ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="SAVE RECORD" />
                </div>
                </form>
                <script>
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function (position) {
                                    // Get latitude and longitude from the Geolocation API
                                    var latitude = position.coords.latitude;
                                    var longitude = position.coords.longitude;

                                    // Set the values in the input fields
                                    document.getElementById('latitude').value = latitude.toFixed(6);
                                    document.getElementById('longitude').value = longitude.toFixed(6);

                                    // Build the OpenStreetMap Nominatim API URL
                                    var apiUrl = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json&zoom=18&addressdetails=1`;
                                    // Make the HTTP request
                                    fetch(apiUrl)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Get the formatted address
                                            var formattedAddress = data.display_name;

                                            // Set the address in the input box
                                            document.getElementById('location_nest').value = formattedAddress;
                                        })
                                        .catch(error => console.error('Error:', error));
                                },
                                function (error) {
                                    console.error('Error getting user location:', error.message);
                                }
                            );
                        } else {
                            console.error('Geolocation is not supported by this browser.');
                        }
                    }
                </script>
                <!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- buttons for Export datatable -->
<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
<!-- Datatable Setting js -->
<script src="vendors/scripts/datatable-setting.js"></script>
</body>

</html>
                