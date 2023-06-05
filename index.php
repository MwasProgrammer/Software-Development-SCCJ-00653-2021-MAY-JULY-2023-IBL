<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" type="text/css" href="dark.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>index</title>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
        const drinkWaterButton = document.getElementById('drinkWaterButton');
        drinkWaterButton.addEventListener('click', () => {
        // Pass message through the localhost
            alert('Water intake recorded!');
      });
    });
    </script>
</head>
<body>
    <div id="box">
        <header class="main-header">
            <h1>AquaGroove<span><img src="img/drop.jpg" height="50" width="50"></h1>
        </header>
        <nav id = "navbar">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="profile.php">Records</a></li>
                    <li><a href="achievements.php">Achievements</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li><button id="modeToggle">Light/Dark Mode</button></li>
                </ul>
            </div>
        </nav>

        <section id="main-section">
            <h2>Welcome Peter,</h2>
            <p>Below is the summary of your water intake.</p>
            <div class="container">
                <div id= "box1">
                    <p>Number of cups drunk today</p>
                    <h3>24</h3>
                </div>
                <div id="box2">
                    <p>Total cups</p>
                    <h3>3200</h3>
                </div>
            
            </div>
            <br>
            <div id= "cup">
                <h4>Water intake</h4>
                <div id="box3">
                    <div class="water-cup">
                        <button id="drinkWaterButton" class="form-button"><img src="img/cup.jpg" height="250" width="250"></button>
                        <p>My intake</p>
                        <h3>24</h3>
                        
                    </div>
                </div>
            </div>
            <div></div>
        </section>
    </div>

 <!-- Javascript for Light/Dark mode activation and deactivation -->   
<script src="dark.js"></script> 

<script src="aqua.js"></script> 
</body>
</html>