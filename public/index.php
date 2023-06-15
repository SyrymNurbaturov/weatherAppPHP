<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();



if (isset($_GET['submit'])) {
    $location = $_GET['city'];
    $user_api = getenv('API_KEY');
    $complete_api_link = "https://api.openweathermap.org/data/2.5/weather?q=$location&appid=$user_api";

    if (empty($location) || empty($user_api)) {
        $api_data = '{}';
    } else {
        $api_link = @file_get_contents($complete_api_link);
        $api_data = json_decode($api_link);
    }

    if (!empty($api_data) && is_object($api_data) && property_exists($api_data, 'main') && property_exists($api_data, 'sys')) {
        $temperature = isset($api_data->main->temp) ? $api_data->main->temp - 273.15 : null;
        $place = isset($api_data->name) && isset($api_data->sys->country) ? $api_data->name . ' ' . $api_data->sys->country : null;
    } else {
        // API response format is not as expected
        $temperature = null;
        $place = null;
    }
} else {
    echo "You are not logged in";
    header("Location: ../public/login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header("Location: ../public/login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../style/index.scss">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<header>
    <div class="btn-right">
    <button><a href="?logout" class="logout-link">Logout</a></button>
    </div>
</header>
<body>
<div class="container">
    <h1 class="begin">Search Weather</h1>
    <form method="GET">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        <div class="btn-sizing"><button type="submit" name="submit" class="btn btn-success">Submit now</button></div>
    </form>
    <?php
    if (empty($api_data)) {
        echo "<div class='weatherInfo'><p class='description'>Invalid input. Please enter a valid location.</p></div>";
    } else {
        echo "<div class='weatherInfo'><p class='description'>Temperature: " . round($temperature, 4) . "°C</p></div>";
        echo "<div class='weatherInfo'><p class='description'>Location: " . $place . "</p></div>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>





