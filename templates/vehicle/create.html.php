<?php
/** @var \App\Model\Vehicle $vehicle */
/** @var \App\Service\Router $router */

$title = 'Create Vehicle';
$bodyClass = "edit";
ob_start();
?>

    <h1>Create New Vehicle</h1>

    <form method="POST">
        <div class="form-group">
            <label for="make">Model</label>
            <input type="text" id="make" name="vehicle[make]" value="<?= $vehicle ? $vehicle->getMake() : '' ?>">
        </div>

        <div class="form-group">
            <label for="type">Typ</label>
            <input type="text" id="type" name="vehicle[type]" value="<?= $vehicle ? $vehicle->getType() : '' ?>">
        </div>

        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
    </form>

    <a href="<?= $router->generatePath('vehicle-index') ?>">Back to list</a>

<?php

$main = ob_get_clean();

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
