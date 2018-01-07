<?php
//file: view/exercise/exercisesList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercises = $view->getVariable("exercises");
$view->setVariable("title", i18n("GesGym - Exercises List"));
?>
			<h1><?=i18n("Exercises List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Name")?></th>
								<th><?=i18n("Type")?></th>
								<th><?=i18n("Description")?></th>
								<th><?=i18n("Url")?></th>								
							</tr>
						</thead>
						<tbody>
<?php foreach ($exercises as $exercise): ?>
							<tr>

								<td><?=$exercise->getExerName()?></td>
								<td><?php if($exercise->getExerTipo() == "cardio"){print i18n("Cardio");}
										  if($exercise->getExerTipo() == "musculacion"){print i18n("Muscle Training");}
										  if($exercise->getExerTipo() == "estiramiento"){print i18n("Stretching");} ?></td>
								<td><?=$exercise->getDescripcion()?></td>
								<td><?=$exercise->getUrl()?></td>
 							    <td>
									<a class="btn btn-sm btn-success" href="index.php?controller=exercises&amp;action=view&amp;id=<?=$exercise->getExerciseId()?>"><?=i18n("View")?></a>
									<a class="btn btn-sm btn-primary" href="index.php?controller=exercises&amp;action=edit&amp;id=<?=$exercise->getExerciseId()?>"><?=i18n("Modify")?></a>
									<form id="<?=$exercise->getExerciseId()?>"  method="POST" action="index.php?controller=exercises&amp;action=delete&amp;id=<?=$exercise->getExerciseId()?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$exercise->getExerciseId()?>')"><?=i18n("Delete")?></a>
									</form>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/exercisesList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
