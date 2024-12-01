<?php
/** @var $vehicle ?\App\Model\Vehicle */
?>

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