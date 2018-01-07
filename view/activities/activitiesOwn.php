<?php
//file: view/activities/activitiesOwn.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activities= $view->getVariable("activities");
$view->setVariable("title", i18n("GesGym - My Activities"));
?>

<h1><?=i18n("Activities List")?></h1>
<div class="container">
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th><?=i18n("ID")?></th>
          <th><?=i18n("Name")?></th>
          <th><?=i18n("Days")?></th>
          <th><?=i18n("Beginning")?></th>
          <th><?=i18n("Ending")?></th>
          <th><?=i18n("Places")?></th>
          <th><?=i18n("Trainer")?></th>
        </tr>
      </thead>
<?php foreach ($activities as $activity): ?>
      <tbody>
        <tr>
          <td><?=$activity->getId()?></td>
          <td><?=$activity->getNombre()?></td>
          <td><?=$activity->getDia()?></td>
          <td><?=$activity->getHoraInicio()?></td>
          <td><?=$activity->getHoraFin()?></td>
          <td><?=$activity->getPlazas()?></td>
          <td><?=$activity->getEntrenador()?></td>
        </tr>
      </tbody>
<?php endforeach; ?>
    </table>
  </div>
</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/activitiesList.css">
