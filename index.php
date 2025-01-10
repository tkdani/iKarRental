<?php
$carsJson = file_get_contents('cars.json');

$cars = json_decode($carsJson, true);

$carType = isset($_POST['carType']) ? $_POST['carType'] : '';
$passengers = isset($_POST['passengers']) ? (int)$_POST['passengers'] : 0;
$minPrice = isset($_POST['minPrice']) ? (int)$_POST['minPrice'] : 0;
$maxPrice = isset($_POST['maxPrice']) ? (int)$_POST['maxPrice'] : 0;

$isFilterApplied = $carType !== '' || $passengers !== 0 || $minPrice !== 0 || $maxPrice !== 0;

$filteredCars = $isFilterApplied ? array_filter($cars, function ($car) use ($carType, $passengers, $minPrice, $maxPrice) {
    return ($car['transmission'] === $carType || $carType === '')
        && ($car['passengers'] === $passengers || $passengers === 0)
        && ($car['daily_price_huf'] >= $minPrice || $minPrice === 0)
        && ($car['daily_price_huf'] <= $maxPrice || $maxPrice === 0);
}) : $cars;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iKarRental</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="leftHeader">
            <a class="homeBtn" href="#index.php">iKarRental</a>
        </div>
        <div class="rightHeader">
            <a id="loginBtn" href="#">Bejelentkezés</a>
            <div class="registerBtn">
                <a class="register" href="#">Regisztráció</a>
            </div>
        </div>
    </header>
    <div class="welcomeText">
        <h1>
            Kölcsönözz autókat<br> könnyedén!
        </h1>
        <div class="registerBtn">
            <a class="register" href="#">Regisztráció</a>
        </div>
    </div>
    <form method="POST" class="formContainer">
        <div class="formContent">
            <button class="passengersBtn" id="decreaseBtn" type="button">-</button>
            <input id="passengers" type="text" value="0" name="passengers">
            <button class="passengersBtn" id="increaseBtn" type="button">+</button>
            <span>férőhely</span>

            <input type="text" id="startDate" placeholder="2024. 10. 04">
            <span>-tól</span>
            <input type="text" id="endDate" placeholder="2024. 10. 04">
            <span>-ig</span><br>

            <select id="carType" name="carType">
                <option value="" selected disabled>Váltó típusa</option>
                <option value="Manual">Manuális</option>
                <option value="Automatic">Automata</option>
            </select>

            <input id="minPrice" type="text" placeholder="14 000" name="minPrice">
            <span>-</span>
            <input id="maxPrice" type="text" placeholder="21 000" name="maxPrice">
            <span>Ft</span>
        </div>
        <div class="sortBtn">
            <button type="submit" class="registerBtn">Szűrés</button>
        </div>
    </form>
    <div class="content">
        <?php if (!empty($filteredCars)): ?>
            <?php foreach ($filteredCars as $car): ?>
                <div class="carContainer">

                    <div class="carImgContainer">
                        <a href="car.php?id=<?php echo $car['id']; ?>">
                            <img class="carImg" src="<?php echo $car['image']; ?>">
                        </a>
                        <span><?php echo $car['daily_price_huf'] . ' Ft' ?></span>
                    </div>
                    <div class="carInfo">
                        <div>
                            <a href="car.php?id=<?php echo $car['id']; ?>">
                                <p class="carBrand"><?php echo $car['brand'] ?> <b><?php echo $car['model']; ?></b></p>
                            </a>
                            <p class="carPassengers"><?php echo $car['passengers'] . ' férőhely - ' . $car['transmission']; ?></p>
                        </div>
                        <div class="registerBtn carBtn">
                            <a class="register" href="#">Foglalás</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nincsenek elérhető autók.</p>
        <?php endif; ?>
    </div>

</body>

</html>