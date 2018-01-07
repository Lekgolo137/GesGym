<?php
//file: view/activities/addResource.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity= $view->getVariable("actividad");
$resources = $view->getVariable("resources");
$view->setVariable("title", i18n("GesGym - Resources"));
?>
  <h1><?=i18n("Resources List")?></h1>
  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th><?=i18n("Name")?></th>
            <th><?=i18n("Capacity")?></th>
            <th><?=i18n("Actions")?></th>
          </tr>
        </thead>
        <tbody>
  <?php foreach ($resources as $resource): ?>
          <tr>
            <td><?=$resource->getNombre()?></td>
            <td><?=$resource->getAforo()?></td>
            <td>
              <a class="btn btn-sm btn-success" href="index.php?controller=activities&amp;action=recurIntegre&amp;id=<?=$activity?>&amp;resource=<?=$resource->getId()?>"><?=i18n("Add")?></a>
              </form>
            </td>
          </tr>
  <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/resourcesList.css"/>
