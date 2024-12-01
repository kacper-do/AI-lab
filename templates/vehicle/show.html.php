<?php

/** @var \App\Model\Vehicle $vehicle */
/** @var \App\Service\Router $router */

$title = "{$vehicle->getMake()} ({$vehicle->getType()})";
$bodyClass = 'show';

ob_start(); ?>

<h1>Vehicle Details</h1>

<div class="vehicle-details">
    <p>
        <strong style="font-weight: bold; font-size: 1.2rem;">Model:</strong>
        <span><?= $vehicle->getMake() ?></span>
    </p>
    <p>
        <strong style="font-weight: normal; font-size: 0.8rem; color: #6d6d6d;">Typ:</strong>
        <span><?= $vehicle->getType() ?></span>
    </p>

    <a href="<?= $router->generatePath('vehicle-index') ?>">Back to list</a>
</div>

<?php

$main = ob_get_clean();


require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>
