<?php
include "../backend/session.php";
include "../backend/functions.php";
include "../backend/check_login.php";



$errors = [];

$categories = get_categories();


if ($_POST['submit']) {
	$errors = validate_form_material($_POST['category']);
	if (empty($errors)) {
		$save_material = save_material( $_SESSION['id'], $_POST['category_id'], $_POST['title'], $_POST['date'], $_POST['time'], $_POST['location'], $_POST['body']);
		if ($save_material) {
			echo '<script>
                    alert("Material creation successful!");
                    window.location.href = "index2.php";
                  </script>';
		} else {
			$errors[] = "Could not create a material. Please try again later.";
		}
	}
}

$select = "SELECT `id`, `name`, `subject`, SUBSTRING(message, 1, 100) AS preview, `date_created`  FROM `report` ORDER BY `date_created` DESC LIMIT 6";
$query = mysqli_query($connection, $select);


?>




<?php include "layouts/_header_eval_forms.php" ?>

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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Create Material</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Create Material</li>
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
							<h4 class="text-blue h4">Create Material <span style="font-style: italic;">(Training/Awareness/Volunteer/News)</span></h4>
							<?php if (!empty($errors)) { ?>
								<?php include "../layouts/_error-messages.php" ?>
							<?php } ?>
						</div>
					</div>

					<form method="post" class="myForm" autocomplete="off" onchange="toggleFields()">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Category:</label>
							<div class="col-sm-12 col-md-10">
								<select name="category_id" id="category" class="form-control">
									<option value="">--- Select Category ---</option>
									<?php if (!empty($categories)) { ?>
										<?php foreach ($categories as $row) { ?>
											<option value="<?= $row['id'] ?>" <?= ($row['id'] == $_POST['category_id']) ? 'selected' : '' ?>>
												<?= $row['category_name'] ?>
											</option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Title:</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" name="title" id="title" value="<?= $_POST['title'] ?>"
									placeholder="Enter A Title..." type="text">
							</div>
						</div>
						<div class="form-group row" id="dateField">
							<label class="col-sm-12 col-md-2 col-form-label">Date:</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control date-picker" name="date" id="date"
									value="<?= $_POST['date'] ?>" placeholder="Select Date" type="text">
							</div>
						</div>
						<div class="form-group row" id="timeField">
							<label class="col-sm-12 col-md-2 col-form-label">Time:</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control time-picker" name="time" id="time"
									value="<?= $_POST['time'] ?>" placeholder="Select Date" type="text">
							</div>
						</div>
						<div class="form-group row" id="locationField">
							<label class="col-sm-12 col-md-2 col-form-label">Location (Optional):</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" name="location" id="location"
									value="<?= $_POST['location'] ?>" placeholder="Event Location" type="text">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Description:</label>
							<div class="col-sm-12 col-md-10">
								<textarea class="form-control" type="text" name="body" id="body"
									value="<?= $_POST['body'] ?>" placeholder="body"> </textarea>
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