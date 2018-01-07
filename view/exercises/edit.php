<?php
//file: view/exercises/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$exercise = $view->getVariable("exercise");
$view->setVariable("title", i18n("GesGym - Modify Exercise"));
$view->setVariable("header", i18n("Modify Exercise"));
?>
			<form class="form-signin" action="index.php?controller=exercises&amp;action=edit&amp;id=<?=$exercise->getExerciseId()?>" method="POST">
				<?=i18n("ID")?>:
				<input disabled type="text" name="id" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$exercise->getExerciseId()?>" required>
				<?=i18n("Name")?>:
				<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$exercise->getExerName()?>" required>
				<?=i18n("Type")?>:
				<select name="tipo">
					<option value="cardio" <?php if ($exercise->getExerTipo() == "cardio") print "selected"?>><?=i18n("Cardio")?></option>
					<option value="musculacion" <?php if ($exercise->getExerTipo() == "musculacion") print "selected"?>><?=i18n("Muscle Training")?></option>
					<option value="estiramiento" <?php if ($exercise->getExerTipo() == "estiramiento") print "selected"?>><?=i18n("Stretching")?></option>
				</select>
				<?=i18n("Description")?>:
				<input type="text" name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$exercise->getDescripcion()?>" required>
				<?=i18n("URL")?>:
				<input type="text" name="url" class="form-control" placeholder="<?=i18n("URL")?>" value="<?=$exercise->getUrl()?>" required>

				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=exercises&amp;action=exercisesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editExerciseStyle.css">
