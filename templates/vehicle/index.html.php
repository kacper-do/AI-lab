<?php

/** @var \App\Model\Vehicle $vehicle */
/** @var \App\Service\Router $router */

$title = 'Vehicle List';
$bodyClass = 'index';

ob_start(); ?>

    <h1>Vehicles List</h1>
    <a href="<?= $router->generatePath('vehicle-create') ?>">Create new</a>
    <ul>
        <?php foreach ($vehicles as $vehicle): ?>
            <li>
                <h3><?= $vehicle->getMake() ?></h3> (<?= $vehicle->getType() ?>)
                <a href="<?= $router->generatePath('vehicle-show', ['id' => $vehicle->getId()]) ?>">Details</a>
                <a href="<?= $router->generatePath('vehicle-edit', ['id' => $vehicle->getId()]) ?>">Edit</a>
                <a href="<?= $router->generatePath('vehicle-delete', ['id' => $vehicle->getId()]) ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>


<?php

$main = ob_get_clean();


require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
