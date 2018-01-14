<?php
//file: view/exercises/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$exer = $view->getVariable("exer");
$view->setVariable("title", i18n("GesGym - New Exercise"));
$view->setVariable("header", i18n("New Exercise"));
?>
			<form class="form-signin" action="index.php?controller=exercises&amp;action=add" method="POST">   
<!--				<div><?=isset($errors["exerciseId"])?i18n($errors["exerciseId"]):""?></div>           -->
				<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$exer->getExerName()?>" required autofocus>
				<div class="form-control"><?=i18n("Type")?>:
					<select name="tipo">
						<option value="cardio" <?php if ($exer->getExerTipo() == "cardio") print "selected"?>><?=i18n("Cardio")?></option>
						<option value="musculacion" <?php if ($exer->getExerTipo() == "musculacion") print "selected"?>><?=i18n("Muscle Training")?></option>
						<option value="estiramiento" <?php if ($exer->getExerTipo() == "estiramiento") print "selected"?>><?=i18n("Stretching")?></option>
					</select>
				</div>
				<textarea type="text" name="descripcion" rows="5" class="form-control" placeholder="<?=i18n("Description")?>"><?=$exer->getDescripcion()?></textarea>
				<input type="text" name="url" class="form-control" placeholder="<?=i18n("URL")?>" value="<?=$exer->getUrl()?>">
				<span><?=i18n("* The URL must be a valid youtube video identifier code.")?></span>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new exercise")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=exercises&amp;action=exercisesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addExerciseStyle.css">
