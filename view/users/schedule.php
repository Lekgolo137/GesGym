<?php
//file: view/users/schedule.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "GesGym - ".i18n("Schedule"));
$day = $view->getVariable("day");
$activities = $view->getVariable("activities");
$resources = $view->getVariable("resources");
?>
			<div class="container">
				<form id="dia" action="index.php?controller=users&amp;action=schedule" method="POST">
					<h2>
						<span><?=i18n("Select the day")?></span>
						<select id="day" name="day" onchange="submit()">
							<option value="lunes" <?php if ($day == "lunes") print "selected"?>>Lunes</option>
							<option value="martes" <?php if ($day == "martes") print "selected"?>>Martes</option>
							<option value="miercoles" <?php if ($day == "miercoles") print "selected"?>>Miércoles</option>
							<option value="jueves" <?php if ($day == "jueves") print "selected"?>>Jueves</option>
							<option value="viernes" <?php if ($day == "viernes") print "selected"?>>Viernes</option>
							<option value="sabado" <?php if ($day == "sabado") print "selected"?>>Sábado</option>
							<option value="domingo" <?php if ($day == "domingo") print "selected"?>>Domingo</option>
						</select>
					</h2>
				</form>
				<div id="agenda" class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Activity")?></th>
								<th><?=i18n("Time")?></th>
								<th><?=i18n("Place")?></th>
							</tr>
						</thead>
						<tbody>
<?php for ($i = 0; $i < sizeof($activities); $i++){ ?>
							<tr>
								<td><?=$activities[$i]->getNombre()?></td>
								<td><?=$activities[$i]->getHoraInicio()." - ".$activities[$i]->getHoraFin()?></td>
								<td><?=$resources[$i]->getNombre()?></td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>						
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/scheduleStyle.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/schedule.js"></script>
