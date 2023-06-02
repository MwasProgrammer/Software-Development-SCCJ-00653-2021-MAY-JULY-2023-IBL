<?php
// PHP code for database server connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aquadata";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the database (Replace with your own query)
$userQuery = "SELECT * FROM userprofile WHERE id = 1";
$userResult = $conn->query($userQuery);

// Check if user data exists
if ($userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();


 // Define the array keys if they are not present in the database
 if (!isset($user['enable_notifications'])) {
    $user['enable_notifications'] = false; // or true, depending on your requirement
}
if (!isset($user['enable_reminder'])) {
    $user['enable_reminder'] = false; // or true, depending on your requirement
}
} else {
// Handle case where user data is not found
$user = null;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Water Reminder App - Settings</title>
  <link rel="stylesheet" href="settings.css">
  
</head>
<body>
<div class="container2">
        <header class="main-header">
            <h1>AquaGroove<span><img src="img/drop.jpg" height="50" width="50"></h1>
        </header>
        <nav id = "navbar">
            <div class="container1">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Records</a></li>
                    <li><a href="#">Achievements</a></li>
                    <li><a href="settings.php">Settings</a></li>
                </ul>
            </div>
        </nav>

  <h2>Settings</h2>

  <form method="POST" action="settings.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required><br><br>

    <label for="targetWaterIntake">Target Water Intake:</label>
    <input type="number" name="targetWaterIntake" id="targetWaterIntake" value="<?php echo $user['target_water_intake']; ?>" required><br><br>

    <label for="enableNotifications">Enable Notifications:</label>
    <input type="checkbox" name="enableNotifications" id="enableNotifications" <?php echo ($user['enable_notifications'] ? 'checked' : ''); ?>><br><br>

    <label for="enableReminder">Enable Reminder:</label>
    <input type="checkbox" name="enableReminder" id="enableReminder" <?php echo ($user['enable_reminder'] ? 'checked' : ''); ?>><br><br>

    <button type="submit">Save</button>
  </form>

  <h2>Edit Profile</h2>
  <form method="POST" action="edit_profile.php">
    <label for="name" class="form-label">Name:</label>
        <input type="text" name="name"  id="name" class="form-input" required><br><br>
        <label for="age" class="form-label">Age:</label>
        <input type="text" name="age"  id="age" class="form-input" required><br><br>
        <label for="gender" class="form-label">Gender:</label>
        <input type="text" name="gender"  id="gender" class="form-input" required><br><br>
        <label for="height" class="form-label">Height(cm):</label>
        <input type="number" name="height" id="height" class="form-input" required><br><br>
        <label for="weight" class="form-label">Weight(kg):</label>
        <input type="number" name="weight" id="weight" class="form-input" required><br><br>
        <label for="targetWaterIntake" class="form-label">Target Water Intake:</label>
        <input type="number" name="targetWaterIntake" id="targetWaterIntake" class="form-input" required><br><br>
    <button type="submit">Save Profile</button>
  </form>

  
</div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
