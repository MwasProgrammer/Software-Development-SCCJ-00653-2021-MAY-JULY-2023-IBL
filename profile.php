<!DOCTYPE html>
<html>
<head>
  <title>Water Reminder App</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-button {
      padding: 8px 16px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-button:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
    // JavaScript code
    window.addEventListener('DOMContentLoaded', (event) => {
         //Progress of number of water cups taken
        const drinkWater = () => {
        setWaterIntake(waterIntake + 1);
      };
      // Add event listener to the drink water button
      const drinkWaterButton = document.getElementById('drinkWaterButton');
      drinkWaterButton.addEventListener('click', () => {
        // Perform any necessary JavaScript actions
        alert('Water intake recorded!');
      });
    });
  </script>

</head>
<body>
  <?php
  // Database configuration
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'aquadata';

  // Connect to the database
  $conn = mysqli_connect($host, $username, $password, $database);
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Fetch user profile
  $query = "SELECT * FROM userprofile";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  // Fetch water intake
  $query = "SELECT COUNT(*) as count FROM water_intake";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $waterIntake = $row['count'];

  // Handle form submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $targetWaterIntake = $_POST['targetWaterIntake'];

    // Update or insert user profile
    $query = "REPLACE INTO userprofile (name, target_water_intake) VALUES ('$name', '$targetWaterIntake')";
    mysqli_query($conn, $query);

   

    // Refresh the page to show updated user profile
    header('Location: profile.php');
    exit;
  }
  ?>
<div class="container">
    <h1>AquaGroove<span><img src="img/drop.jpg" height="50" width="50"></h1>

    <?php if ($user) : ?>
        <div>
        <p>Welcome, <?php echo $user['name']; ?>!</p>
        <p>Your target water intake: <?php echo $user['target_water_intake']; ?> cups</p>
        <form method="POST" action="profile.php">
        <Button onClick={drinkWater}>Drink Water</Button>
        </form>
        <p>Water Intake: <?php echo $waterIntake; ?> cups</p>
        </div>
    <?php else : ?>
        <form method="POST" action="profile.php">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name"  id="name" class="form-input" required><br><br>
        <label for="age" class="form-label">Age:</label>
        <input type="text" name="age"  id="age" class="form-input" required><br><br>
        <label for="gender" class="form-label">Gender:</label>
        <input type="text" name="gender"  id="gender" class="form-input" required><br><br>
        <label for="targetWaterIntake" class="form-label">Target Water Intake:</label>
        <input type="number" name="targetWaterIntake" id="targetWaterIntake" class="form-input" required><br><br>
        <label for="height" class="form-label">Height:</label>
        <input type="number" name="height" id="height" class="form-input" required><br><br>
        <label for="weight" class="form-label">Weight:</label>
        <input type="number" name="weight" id="weight" class="form-input" required><br><br>
        <button type="submit" class="form-button">Save Profile</button>
        </form>
    <?php endif; ?>
  </div>