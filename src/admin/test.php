<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Display</title>
</head>
<body>

<form action="upload_image.php" method="post" enctype="multipart/form-data">
    <label for="image">Choose an image:</label>
    <input type="file" name="image" id="image" accept="image/*">
    <input type="submit" name="upload">Upload</input>
</form>

<?php
$servername = "mysql_db";
$username = "root";
$password = "root";
$dbname = "db_turtle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['upload'])) {

    // Get image data
    $image = file_get_contents($_FILES['image']['tmp_name']);

    // Insert image data into the database
    $stmt = $conn->prepare("INSERT INTO users (image) VALUES (image)");
    $stmt->bind_param("sb", $image);
    
    if ($stmt->execute()) {
        echo "Image uploaded successfully!";
    } else {
        echo "Error uploading image: " . $stmt->error;
    }

    $stmt->close();
}

// Display images
$result = $conn->query("SELECT id, image FROM users");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="User Image">';
        echo '</div>';
    }
} else {
    echo "No images found.";
}

$conn->close();
?>

</body>
</html>
