<?php
require '../backend/db.php';
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";


date_default_timezone_set('Asia/Taipei');
$apiKey = "10f78797831bb67ce3a30494eeff3534";
$cityId = "1707052";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();




$select = "SELECT `id`, `name`, `subject`, SUBSTRING(message, 1, 100) AS preview, `date_created`  FROM `report` ORDER BY `date_created` DESC LIMIT 6";
$query = mysqli_query($connection, $select);


?>




<?php include "layouts/_header_main.php" ?>

<body>
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
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="vendors/images/banner-img.png" alt="">
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Welcome back <div class="weight-600 font-30 text-blue">
                                <?= $_SESSION['firstName'] ?>
                                <?= $_SESSION['lastName'] ?>!
                            </div>
                        </h4>
                        <p class="font-18 max-width-600">Your dedication and expertise are invaluable in our mission to
                            protect and conserve these magnificent sea creatures. Let's dive into another productive and
                            fulfilling journey of safeguarding our ocean's treasures. Welcome back!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="chart"></div>
                            </div>
                            <div class="widget-data">
                                <?php
                                $select = "SELECT * FROM users WHERE account_type = 'user' AND email_verified_at IS NOT NULL ";
                                $query_run = mysqli_query($connection, $select);

                                $row = mysqli_num_rows($query_run);
                                echo '<span class="h4 mb-0">' . $row . '</span>';
                                ?>
                                <div class="weight-600 font-14">Registered Volunteers</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="chart2"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">40</div>
                                <div class="weight-600 font-14">Trained Volunteers</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="chart3"></div>
                            </div>
                            <div class="widget-data">
                                <?php
                                $select = "SELECT * FROM nesting_data";
                                $query_run = mysqli_query($connection, $select);

                                $row = mysqli_num_rows($query_run);
                                echo '<span class="h4 mb-0">' . $row . '</span>';
                                ?>
                                <div class="weight-600 font-14">Total Number of Nest</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="chart4"></div>
                            </div>
                            <div class="widget-data">
                                <?php
                                $select = "SELECT SUM(number_transplanted) AS total_sum FROM nesting_data";
                                $result = $connection->query($select);

                                $row = $result->fetch_assoc();

                                $totalSum = $row["total_sum"];

                                echo '<span class="h4 mb-0">' . $totalSum . '</span>';
                                ?>
                                <div class="weight-600 font-14">Total Number of Hatchling</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h2 class="h4 mb-20">Activity</h2>
                        <div id="chart5"></div>
                    </div>
                </div>

                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="pd-20 h5 mb-0">Weather Update</h5>
                        <div class="list-group">
                            <div><span style="color: black;">Date:</span>
                                <?php echo date("F j, Y", $currentTime) . ' || ' . date("l", $currentTime); ?>
                                <br>
                                <br>
                            </div>
                            <div><span style="color: black;">Time:</span>
                                <span id="demo"></span>
                            <br>
                            <br>
                            </div>
  
                            <div><span style="color: black;">Weather Forecast:</span>
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 10px; text-transform: capitalize;">
                                        <?php echo $data->weather[0]->description; ?>
                                     </div>
                                     <span>
                                        <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="weather-forecast">
                            <div><span style="color: darkblue;">Temperature:</span>
                                <?php echo $data->main->temp_max; ?>&deg;
                            </div>
                            <br>
                        </div>
                        <div class="time">
                            <div><span style="color: darkred;">Humidity:</span>
                                <?php echo $data->main->humidity; ?> %
                            </div>
                            <br>
                            <div><span style="color: darkgreen;">Wind:</span>
                                <?php echo $data->wind->speed; ?> Km/H
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Lead Target</h2>
                    <div id="chart6"></div>
                </div>
            </div>

        </div>

        <div class="footer-wrap pd-20 mb-20 card-box">
            SEE Turtles - A Cross-platform Application Developed By <a href="#"
                target="_blank">Team Incognito</a>
        </div>
    </div>
    </div>
    <!-- Time Script -->
    <script>
        function myClock() {
            setTimeout(function () {
                const d = new Date();
                const n = d.toLocaleTimeString();
                document.getElementById("demo").innerHTML = n;
                myClock();
            }, 1000)
        }
        myClock();
    </script>
    <?php include "layouts/_footer_main.php" ?>