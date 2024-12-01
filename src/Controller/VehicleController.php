<?php

namespace App\Controller;

use App\Model\Vehicle;
use App\Service\Router;

class VehicleController
{
    public function __construct()
    {

        session_start();
        if (!isset($_SESSION['vehicles'])) {
            $_SESSION['vehicles'] = [
                new Vehicle(1, 'Toyota', 'SUV'),
                new Vehicle(2, 'Tesla', 'Electric'),
                new Vehicle(3, 'Ford', 'Pickup'),
            ];
        }
    }

    public function indexAction(Router $router, \App\Service\Templating $templating)
    {
        $vehicles = $_SESSION['vehicles'];
        return $templating->render('vehicle/index.html.php', [
            'vehicles' => $vehicles,
            'router' => $router,
        ]);
    }

    public function showAction(Router $router, int $id)
    {
        $vehicle = $this->findVehicleById($id);
        if (!$vehicle) {
            throw new \Exception("Vehicle not found");
        }
        require __DIR__ . '/../../templates/Vehicle/show.html.php';
    }

    public function createAction(Router $router)
    {
        $vehicle = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $make = $_POST['vehicle']['make'];
            $type = $_POST['vehicle']['type'];


            $id = count($_SESSION['vehicles']) + 1;
            $vehicle = new Vehicle($id, $make, $type);


            $_SESSION['vehicles'][] = $vehicle;


            $router->redirect($router->generatePath('vehicle-index'));
        }


        require __DIR__ . '/../../templates/Vehicle/create.html.php';
    }

    public function editAction(Router $router, int $id)
    {
        $vehicle = $this->findVehicleById($id);
        if (!$vehicle) {
            throw new \Exception("Vehicle not found");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vehicle->setMake($_POST['vehicle']['make']);
            $vehicle->setType($_POST['vehicle']['type']);


            $_SESSION['vehicles'] = $this->updateVehicleInSession($vehicle);


            $router->redirect($router->generatePath('vehicle-index'));
        }

        require __DIR__ . '/../../templates/Vehicle/edit.html.php';
    }

    public function deleteAction(int $id, Router $router)
    {

        $_SESSION['vehicles'] = array_filter($_SESSION['vehicles'], fn($v) => $v->getId() !== $id);


        $router->redirect($router->generatePath('vehicle-index'));
    }

    private function findVehicleById(int $id): ?Vehicle
    {
        foreach ($_SESSION['vehicles'] as $vehicle) {
            if ($vehicle->getId() === $id) {
                return $vehicle;
            }
        }
        return null;
    }

    private function updateVehicleInSession(Vehicle $updatedVehicle): array
    {
        return array_map(function ($vehicle) use ($updatedVehicle) {
            if ($vehicle->getId() === $updatedVehicle->getId()) {
                return $updatedVehicle;
            }
            return $vehicle;
        }, $_SESSION['vehicles']);
    }
}
