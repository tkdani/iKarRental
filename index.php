<?php
// Read the JSON file
$carsJson = file_get_contents('cars.json');

// Decode the JSON data into a PHP array
$cars = json_decode($carsJson, true);
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
    <div class="formContainer">
        <div class="formContent">
            <button id="decreaseBtn">-</button>
            <input id="numberBtn" type="text" value="0">
            <button id="increaseBtn">+</button>
            <span>férőhely</span>

            <input type="text" id="startDate" placeholder="2024. 10. 04">
            <span>-tól</span>
            <input type="text" id="endDate" placeholder="2024. 10. 04">
            <span>-ig</span><br>

            <select id="carType">
                <option value="" selected disabled>Váltó típusa</option>
                <option value="manual">Manuális</option>
                <option value="automata">Automata</option>
            </select>

            <input id="minPrice" type="text" placeholder="14 000">
            <span>-</span>
            <input id="maxPrice" type="text" placeholder="21 000">
            <span>Ft</span>
        </div>
        <div class="sortBtn">
            <div class="registerBtn">
                <a class="register" href="#">Szűrés</a>
            </div>
        </div>
    </div>
    <div class="content">
        <?php if (!empty($cars)): ?>
            <?php foreach ($cars as $car): ?>
                <div class="carContainer">
                    <div class="carImgContainer">
                        <img class="carImg" src="<?php echo htmlspecialchars($car['image']); ?>">
                        <span><?php echo $car['daily_price_huf'] . ' Ft' ?></span>
                    </div>
                    <div class="carInfo">
                        <div>
                            <p class="carBrand"><?php echo $car['brand'] ?> <b><?php echo $car['model']; ?></b></p>
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