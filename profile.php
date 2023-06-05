<!DOCTYPE html>
<html>
<head>
  <title>AquaGroove</title>
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" type="text/css" href="dark.css">
  <!-- Include Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js">
    
    //Javascript for bar graph
  window.addEventListener('DOMContentLoaded', (event) => {
    // Get the canvas element
    const barChartCanvas = document.getElementById('barChart').getContext('2d');

    // Create the bar chart
    const barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: {
        labels: ['Water Intake'],
        datasets: [{
          label: 'Water Intake',
          data: [<?php echo $waterIntake; ?>],
          backgroundColor: '#007bff',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: <?php echo $user['target_water_intake']; ?>
          }
        }
      }
    });
  });
  </script>
  
 
  <script>
    // JavaScript code
    window.addEventListener('DOMContentLoaded', (event) => {
    // Number of water cups taken increment
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
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $targetWaterIntake = $_POST['targetWaterIntake'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Update or insert user profile
    $query = "REPLACE INTO userprofile (name, age, gender, target_water_intake, height, weight) VALUES ('$name', '$age', '$gender', '$targetWaterIntake', '$height', '$weight')";
    mysqli_query($conn, $query);

   

    // Refresh the page to show updated user profile
    header('Location: index.php');
    exit;
  }
  ?>
<div class="container">
      <header class="main-header">
            <h1>AquaGroove<span><img src="img/drop.jpg" height="50" width="50"></h1>
        </header>
        <nav id = "navbar">
            <div class="container1">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Records</a></li>
                    <li><a href="achievements.php">Achievements</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li><button id="modeToggle">Light/Dark Mode</button></li>
                </ul>
            </div>
        </nav>

    <?php if ($user) : ?>
      <form method="POST" action="profile.php">
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
        <button type="submit" class="form-button">Save Profile</button><br><br>
        </form>
          
        
    <?php else : ?>
      <div>
        <p>Welcome, <?php echo $user['name']; ?>!</p>
        <p>Your target water intake: <?php echo $user['target_water_intake']; ?> cups</p>
        <form method="POST" action="profile.php">
        <Button onClick={drinkWater}>Drink Water</Button>
        </form>
        <p>Water Intake: <?php echo $waterIntake; ?> cups</p>
      </div>
    <?php endif; ?>
  

  <section id="progress-bar">
        <div class="title-text">
            <h4>Records</h4>
        </div>
  <div>
    <p>Welcome, <?php echo $user['name']; ?>!</p>
    <p>Your target water intake: <?php echo $user['target_water_intake']; ?> cups</p>
    <button id="drinkWaterButton" class="form-button">Drink Water</button>
    <p>Water Intake: <?php echo $waterIntake; ?> cups</p>
    <div class="progress-bar">
      <div class="progress" style="width: <?php echo $progress; ?>%"></div>
    </div>
    <!--where to display the bar graph-->
    <canvas id="barChart"></canvas>
  </div>

  </section>
  </div>
<!-- Javascript for Light/Dark mode activation and deactivation -->
<script src="dark.js"></script>
</body>
</html>