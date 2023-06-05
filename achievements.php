<!DOCTYPE html>
<html>
<head>
  <title>Water Reminder App - Achievements</title>
  <link rel="stylesheet" type="text/css" href="dark.css">
  <link rel="stylesheet" type="text/css" href="achievements.css">
</head>
<body>
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
  <h2>Achievements</h2>

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
  $userQuery = "SELECT name, target_water_intake, current_water_intake FROM userprofile WHERE id = 1";
  $userResult = $conn->query($userQuery);

  // Check if user data exists
  if ($userResult->num_rows > 0) {
      $user = $userResult->fetch_assoc();

      $name = $user['name'];
      $targetWaterIntake = $user['target_water_intake'];
      $currentWaterIntake = $user['current_water_intake'];

      // Calculate the completion %
      $completionPercentage = ($currentWaterIntake / $targetWaterIntake) * 100;
      $completionPercentage = min($completionPercentage, 100); // Cap at 100%

      // Check if the user has reached the target water intake
      $isGoalAchieved = ($currentWaterIntake >= $targetWaterIntake);
  }

  // Close the database connection
  $conn->close();
  ?>

  <h2 style="text-align: left;">Goal Progress</h2>
  <p><?php echo $name; ?>, your current water intake is <?php echo $currentWaterIntake; ?> ml.</p>
  <p>Your target water intake is <?php echo $targetWaterIntake; ?> ml.</p>

  <div class="progress-bar">
    <div class="progress" style="width: <?php echo $completionPercentage; ?>%;"></div>
  </div>
  <p>Completion: <?php echo $completionPercentage; ?>%</p>

  <?php if ($isGoalAchieved): ?>
    <div class="achievement">
      <h2>Congratulations!</h2>
      <p>You have achieved your target water intake goal!</p>
    </div>
  <?php endif; ?>

  <h2>Goals and Challenges</h2>
  <ul>
    <li>Goal 1: Drink <?php echo $targetWaterIntake; ?> ml of water per day</li>
    <li>Goal 2: Complete a 7-day water challenge</li>
    <li>Goal 3: Drink <?php echo $targetWaterIntake * 2; ?> ml of water in a day</li>
    
  </ul>

 <!--JavaScript code -->
  <script>
    // Function to display a message when the goal is achieved
    function showAchievementMessage() {
      alert("Congratulations! You have achieved your target water intake goal!");
    }

    // Function to subscribe to a challenge
    function subscribeToChallenge(challengeName) {
      // Code to subscribe the user to the challenge
      alert("You have subscribed to the " + challengeName + " challenge!");
    }

    // Event listener for the achievement message
    <?php if ($isGoalAchieved): ?>
    document.addEventListener("DOMContentLoaded", showAchievementMessage);
    <?php endif; ?>

    // Event listener for subscribing to challenges
    var challengeButtons = document.querySelectorAll(".subscribe-button");
    challengeButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        var challengeName = this.dataset.challenge;
        subscribeToChallenge(challengeName);
      });
    });
  </script>

</div>
<!-- Javascript for Light/Dark mode activation and deactivation -->
<script src="dark.js"></script>
</body>
</html>
