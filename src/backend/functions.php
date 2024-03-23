<?php
require "db.php";

function check_existing_email($email)
{
    global $connection;
    $flag = false;

    $query = "SELECT `id` FROM `users` WHERE `email` = '" . mysqli_escape_string($connection, $email) . "'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $flag = true;
    }
    return $flag;
}


function escape_string($field)
{
    global $connection;
    return mysqli_escape_string($connection, $field);
}

function save_registration($lastName, $firstName, $middleInitial, $birthday, $sex, $region, $province, $municipality, $barangay, $contactNumber, $email, $password, $account_type, $verification_code)
{
    global $connection;
    $users = [];

    $birthdate = new DateTime($birthday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

    $birthdateString = $birthdate->format('Y-m-d');

    $query = "INSERT INTO `users` (`lastName`, `firstName`, `middleInitial`,`birthdate`, `age`, `sex`, `region`, `province`, `municipality`, `barangay`, `contactNumber`,`email`, `password`, `account_type`, `verification_code`, `email_verified_at`) VALUES ('" . escape_string($lastName) . "','" . escape_string($firstName) . "','" . escape_string($middleInitial) . "', '". $birthdateString . "', '". escape_string($age) ."', '" . escape_string($sex) . "', '" . escape_string($region) . "', '" . escape_string($province) . "', '" . escape_string($municipality) . "', '" . escape_string($barangay) . "', '" . escape_string($contactNumber) . "', '" . escape_string($email) . "', '" . escape_string($password) . "', '" . $account_type . "', '" . $verification_code . "', NULL)";
    if (mysqli_query($connection, $query)) {
        $id = mysqli_insert_id($connection);
        $encrypted_password = md5(md5($id . $password)); //convert password to hash

        $query = "UPDATE `users` SET `password` = '" . $encrypted_password . "' WHERE `users`.`id` = '" . $id . "'";
        if (mysqli_query($connection, $query)) {
            $query = "SELECT * FROM `users` WHERE `users`.`password` = '" . escape_string($encrypted_password) . "' LIMIT 1";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($result);

            if (!empty($rows)) {
                $users = [
                    "id" => $row['id'],
                    "email" => $row['email']
                ];
            }
        }
    }
    return $users;
}

function validate_save_profile($lastName, $firstName, $middleInitial, $birthday, $sex, $region, $province, $municipality, $barangay, $contactNumber, $email, $password, $confirm_password){
    $validation_errors = [];

    if (!$_POST['lastName']) {
        $validation_errors[] = "• Last Name is Required.";
    }

    if (!$_POST['firstName']) {
        $validation_errors[] = "• First Name is Required.";
    }

    if (!$_POST['middleInitial']) {
        $validation_errors[] = "• Middle Initial is Required.";
    }

    if(!$_POST['birthday']){
        $validation_errors[] = "• Birthday is Required";
    }
    
    if(!$_POST['sex']){
        $validation_errors[]= "• Sex is Required";
    }

    if (!$_POST['region']) {
        $validation_errors[] = "• Region is Required.";
    }

    if (!$_POST['province']) {
        $validation_errors[] = "• Province is Required.";
    }

    if (!$_POST['municipality']) {
        $validation_errors[] = "• Municipality is Required.";
    }

    if (!$_POST['barangay']) {
        $validation_errors[] = "• Barangay is Required.";
    }

    if (empty($_POST['contactNumber'])) {
        $validation_errors[] = "• Contact Number is Required.";
    } elseif (!preg_match('/^\d{11}$/', $_POST['contactNumber'])) {
        $validation_errors[] = "• Contact Number must be 11 digits.";
    }

    if (!$_POST['email']) {
        $validation_errors[] = "• Email is Required.";
    }

    if (!$_POST['password']) {
        $validation_errors[] = "• Password is Required.";
    }

    if (!$_POST['confirm_password']) {
        $validation_errors[] = "• Confirm Password is Required.";
    }

    return $validation_errors;

}

function login_account($email, $password)
{
    global $connection;
    $user = [];

    $query = "SELECT * FROM `users` WHERE `users`.`email`='" . escape_string($email) . "' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if (!empty($row)) {
        $hash_password = md5(md5($row['id'] . $password));
        if ($hash_password == $row['password']) {
            $user = [
                "id" => $row['id'],
                "lastName" => $row['lastName'],
                "firstName" => $row['firstName'],
                "email" => $row['email']
            ];
        }
    }

    return $user;
}


function validate_edit_profile($lastName, $firstName, $middleInitial, $sex, $region, $province, $municipality, $barangay, $contactNumber)
{

    $validation_errors = [];

    if (!$_POST['lastName']) {
        $validation_errors[] = "• Last Name is Required.";
    }

    if (!$_POST['firstName']) {
        $validation_errors[] = "• First Name is Required.";
    }

    if (!$_POST['middleInitial']) {
        $validation_errors[] = "• Middle Initial is Required.";
    }

    if (!$_POST['contactNumber']) {
        $validation_errors[] = "• Contact Number is Required.";
    }

    return $validation_errors;
}

function save_nesting_data($location_nest, $latitude, $longitute, $clutch_size, $new_location, $number_transplanted, $date_transplanted, $date_1, $time_1, $no_hatchling_1, $collected_by_1, $date_2, $time_2, $no_hatchling_2, $collected_by_2, $date_3, $time_3, $no_hatchling_3, $collected_by_3, $date_4, $time_4, $no_hatchling_4, $collected_by_4, $no_egg_hatched, $no_egg_unhatched, $no_unhatched_fertile, $live_piped_eggs, $dead_piped_eggs, $without_visible_development, $predated, $hatchling_dead_nest, $hatchling_live_nest, $turtle_id)
{
    global $connection;
    $flag = false;

    $query = "INSERT INTO `nesting_data` (`location_nest`, `latitude`, `longitude`, `clutch_size`, `new_location`, `number_transplanted`, `date_transplanted`, `date_1`, `time_1`, `no_hatchling_1`, `collected_by_1`, `date_2`, `time_2`, `no_hatchling_2`, `collected_by_2`, `date_3`, `time_3`, `no_hatchling_3`, `collected_by_3`, `date_4`, `time_4`, `no_hatchling_4`, `collected_by_4`, `no_egg_hatched`, `no_egg_unhatched`, `no_unhatched_fertile`, `live_piped_eggs`, `dead_piped_eggs`, `without_visible_development`, `predated`, `hatchling_dead_nest`, `hatchling_live_nest`, `turtle_id`) 
        VALUES('" . mysqli_real_escape_string($connection, $location_nest) . "', '" . mysqli_real_escape_string($connection, $latitude) . "', '" . mysqli_real_escape_string($connection, $longitute) . "', '" . mysqli_real_escape_string($connection, $clutch_size) . "', '" . mysqli_real_escape_string($connection, $new_location) . "', '" . $number_transplanted . "', '" . $date_transplanted . "', '" . mysqli_real_escape_string($connection, $date_1) . "', '" . mysqli_real_escape_string($connection, $time_1) . "', '" . mysqli_real_escape_string($connection, $no_hatchling_1) . "', '" . mysqli_real_escape_string($connection, $collected_by_1) . "','" . mysqli_real_escape_string($connection, $date_2) . "', '" . mysqli_real_escape_string($connection, $time_2) . "', '" . mysqli_real_escape_string($connection, $no_hatchling_2) . "', '" . mysqli_real_escape_string($connection, $collected_by_2) . "', '" . mysqli_real_escape_string($connection, $date_3) . "', '" . mysqli_real_escape_string($connection, $time_3) . "', 
        '" . mysqli_real_escape_string($connection, $no_hatchling_3) . "', '" . mysqli_real_escape_string($connection, $collected_by_3) . "', '" . mysqli_real_escape_string($connection, $date_4) . "', '" . mysqli_real_escape_string($connection, $time_4) . "', '" . mysqli_real_escape_string($connection, $no_hatchling_4) . "', '" . mysqli_real_escape_string($connection, $collected_by_4) . "', '" . mysqli_real_escape_string($connection, $no_egg_hatched) . "', '" . mysqli_real_escape_string($connection, $no_egg_unhatched) . "', '" . mysqli_real_escape_string($connection, $no_unhatched_fertile) . "', '" . mysqli_real_escape_string($connection, $live_piped_eggs) . "', '" . mysqli_real_escape_string($connection, $dead_piped_eggs) . "', '" . mysqli_real_escape_string($connection, $without_visible_development) . "', '" . mysqli_real_escape_string($connection, $predated) . "', '" . mysqli_real_escape_string($connection, $hatchling_dead_nest) . "', '" . mysqli_real_escape_string($connection, $hatchling_live_nest) . "', 
        '" . mysqli_real_escape_string($connection, $turtle_id) . "')";

    if (mysqli_query($connection, $query)) {
        $flag = true;
    }

    return $flag;

}

function validate_data($location_nest)
{
    $validation_error = [];

    if (!$_POST['location_nest']) {
        $validation_error[] = "Location is required";
    }



    return $validation_error;
}


function get_categories()
{
    global $connection;
    $categories = [];
    $query = "SELECT * FROM `categories`";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $categories = $result;
    }

    return $categories;
}




function save_material($users_id, $category_id, $title, $date, $time, $location, $body)
{
    global $connection;
    $flag = false;

    $date_created = date("Y-m-d H:i:s");
    $query = "INSERT INTO `materials` (`users_id`, `category_id`, `title`, `date`, `time`,`location`, `body`, `date_created`) VALUES ('" . mysqli_real_escape_string($connection, $users_id) . "', '" . mysqli_real_escape_string($connection, $category_id) . "', '" . mysqli_real_escape_string($connection, $title) . "', '" . mysqli_real_escape_string($connection, $date) . "', '" . mysqli_real_escape_string($connection, $time) . "', '" . mysqli_real_escape_string($connection, $location) . "',  '" . mysqli_real_escape_string($connection, $body) . "', '" . $date_created . "')";

    if (mysqli_query($connection, $query)) {
        $flag = true;
    }

    return $flag;
}

function validate_form_material($category_id)
{
    $validation_errors = [];

    if (!$_POST['category_id']) {
        $validation_errors[] = "Category is required.";
    }

    return $validation_errors;
}

function view_materials($id) {
    global $connection;
    $material = [];

    $query = "SELECT `b`.`id` as material_id, `b`.`title`, `b`.`body`,  `b`.`category_id`, `b`.`users_id`, `c`.`category_name`, `u`.`lastName`, `u`.`email` FROM `materials` as `b` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` WHERE `b`.`id` = '".mysqli_real_escape_string($connection, $id)."'";

    $result = mysqli_query($connection, $query);
    $rows = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) > 0) {
       $material = $rows;
    } 

    //echo("Error description: " . mysqli_error($connection));



    return $material;
}


function get_all_materials()
{
    global $connection;
    $materials = [];

    $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` ORDER BY `b`.`id` DESC LIMIT 6";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = $result;
    }


    return $materials;
}

function get_all_training()
{
    global $connection;
    $materials = [];

    $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` WHERE `category_id` = '1' ORDER BY `b`.`id` DESC LIMIT 6";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = $result;
    }

    return $materials;      
}

function get_all_awareness()
{
    global $connection;
    $materials = [];

    $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` WHERE `category_id` = '2' ORDER BY `b`.`id` DESC LIMIT 6";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = $result;
    }

    return $materials;      
}

function get_all_volunteer()
{
    global $connection;
    $materials = [];

    $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` WHERE `category_id` = '3' ORDER BY `b`.`id` DESC LIMIT 6";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = $result;
    }

    return $materials;      
}

function get_all_news()
{
    global $connection;
    $materials = [];

    $query = "SELECT `b`.`id` as `material_id`, `b`.`title`, `b`.`date`, `b`.`time`, `b`.`location`, `b`.`body`, `c`.`category_name`, `u`.`email`, `b`.`date_created`, `u`.`lastName` FROM `materials` as `b` INNER JOIN `categories` as `c` ON `c`.`id` = `b`.`category_id` INNER JOIN `users` as `u` ON `u`.`id` = `b`.`users_id` WHERE `category_id` = '4' ORDER BY `b`.`id` DESC LIMIT 6";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = $result;
    }

    return $materials;      
}

function display_material_preview($field, $length)
{
    return substr($field, 0, $length);
}

function is_owner($current_user, $blog_user_id) {
    return ($current_user == $blog_user_id) ? true : false;
}

function save_report($name, $email, $subject, $message)
{
    global $connection;
    $flag = false;

    $date_created = date("Y-m-d H:i:s");
    $query = "INSERT INTO `report` (`name`, `email`, `subject`, `message`, `date_created`) 
        VALUES('" . escape_string( $name) . "', 
        '" . mysqli_real_escape_string($connection, $email) . "', 
        '" . mysqli_real_escape_string($connection, $subject) . "',
        '" . mysqli_real_escape_string($connection, $message) . "',
        '" . $date_created . "')";

    if (mysqli_query($connection, $query)) {
        $flag = true;
    }

    return $flag;


}

function validate_report($subject, $message)
{
    $validation_errors = [];

    if (!$_POST['subject']) {
        $validation_errors[] = "Title is required.";
    }

    if (strlen($_POST['subject']) < 10) {
        $validation_errors[] = "The subject of the material must have atleast 10 characters.";
    }

    if (!$_POST['message']) {
        $validation_errors[] = "Body is required.";
    }

    return $validation_errors;
}

function save_superadmin($lastName, $firstName, $email, $password, $account)
{
    global $connection;
    $flag = false;

    $email_verified_at = date("Y-m-d H:i:s");

    $query = "INSERT INTO `users` (`lastName`, `firstName`, `email`, `password`, `account_type`, `email_verified_at`) VALUES ('" . escape_string($lastName) . "','" . escape_string($firstName) . "', '" . escape_string($email) . "', '" . escape_string($password) . "', '" . escape_string($account) . "', '" . escape_string($email_verified_at) . "')";
    if (mysqli_query($connection, $query)) {
        $id = mysqli_insert_id($connection);
        $encrypted_password = md5(md5($id . $password)); //convert password to hash

        $query = "UPDATE `users` SET `password` = '" . $encrypted_password . "' WHERE `users`.`id` = '" . $id . "'";
        if (mysqli_query($connection, $query)) {
            $query = "SELECT * FROM `users` WHERE `users`.`password` = '" . escape_string($encrypted_password) . "' LIMIT 1";

            if (mysqli_query($connection, $query)) {
                $flag = true;
            }
        
        }
    }
    
    return $flag;
}




?>