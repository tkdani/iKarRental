<?php
// Read the JSON file
$carsJson = file_get_contents('cars.json');

// Decode the JSON data into a PHP array
$cars = json_decode($carsJson, true);

// Get the car ID from the query string
$carId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Find the car by ID
$car = null;
foreach ($cars as $c) {
    if ($c['id'] === $carId) {
        $car = $c;
        break;
    }
}

if (!$car) {
    echo "Az autó nem található.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $car['brand'] . ' ' . $car['model']; ?> - iKarRental</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="leftHeader">
            <a class="homeBtn" href="index.php">iKarRental</a>
        </div>
        <div class="rightHeader">
            <a id="loginBtn" href="#">Bejelentkezés</a>
            <div class="registerBtn">
                <a class="register" href="#">Regisztráció</a>
            </div>
        </div>
    </header>
    <div class="carDesc">
        <span id="carName"><?php echo $car['brand'] . '<b> ' . $car['model']; ?></b></span>
        <div class="carDetail">
            <img src="<?php echo $car['image']; ?>" alt="<?php echo $car['brand'] . ' ' . $car['model']; ?>">
            <div class="flexCol">
                <div class="carDescription">
                    <div class="topLeft">
                        <span>Üzemanyag: <?php echo $car['fuel_type']; ?></span><br>
                        <span>Váltó: <?php echo $car['transmission']; ?></span>
                    </div>
                    <div class="topRight">
                        <span>Gyártási év: <?php echo $car['year']; ?></span><br>
                        <span>Férőhely: <?php echo $car['passengers']; ?></span>
                    </div>
                    <div class="bottom">
                        <span><?php echo $car['daily_price_huf']; ?> Ft<span id="nap">/nap</span></span>
                    </div>
                </div>
                <div class="flexBtn">
                    <button id="rentDateBtn" class="rentDateBtn rentBtn">Dátum kiválasztása</button>
                    <button class="rentBtn rentBtn">Lefoglalom</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>