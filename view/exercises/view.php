<?php
//file: view/exercises/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", i18n("GesGym - View Exercise"));
$view->setVariable("header", i18n("View Exercise"));
?>
			<?=i18n("ID")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$exercise->getExerciseId()?>">
			<?=i18n("Name")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$exercise->getExerName()?>">
			<?=i18n("Type")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Type")?>" value="<?php if($exercise->getExerTipo() == "cardio"){print i18n("Cardio");}
																										  if($exercise->getExerTipo() == "musculacion"){print i18n("Muscle Training");}
																										  if($exercise->getExerTipo() == "estiramiento"){print i18n("Stretching");} ?>">
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=exercises&amp;action=exercisesList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewExerciseStyle.css">
