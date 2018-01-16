<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$exercises = $view->getVariable("exercises");
$exercisesCheck = $view->getVariable("exercisesCheck");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Modify Table"));
$view->setVariable("header", i18n("Modify Table"));
?>

<form class="form-signin" action="index.php?controller=tables&amp;action=edit" method="POST">

	<?= i18n("Name") ?>: <?= isset($errors["tableNombre"])?i18n($errors["tableNombre"]):"" ?>
	<input class="form-control" type="text" name="tableNombre" placeholder="<?=i18n("Name")?>" value="<?= $tables->getTableNombre() ?>">


	<?= i18n("Type") ?>: <?= isset($errors["tableTipo"])?i18n($errors["tableTipo"]):"" ?>
	<select class="form-control" name="tableTipo" disabled >
		<option value="estandar" <?php if ($tables->getTableTipo() == "estandar") print "selected"?> > <?=i18n("Standard")?> </option>
		<option value="personalizada" <?php if ($tables->getTableTipo() == "personalizada") print "selected"?> > <?=i18n("Custom")?> </option>
	</select>

	<?= i18n("Description") ?>: <?= isset($errors["tableDescripcion"])?i18n($errors["tableDescripcion"]):"" ?>
	<textarea rows="5" class="form-control" type="text" name="tableDescripcion"><?=$tables->getTableDescripcion()?></textarea>

	<div id="ejercicios" class="form-control"><table class="table table-bordered">
		<?php $cont=1 ?>
		<?php foreach ($exercises as $exercise): ?>
			<?php $cont++ ?>
					<?php echo ($cont%2==0 ? '<tr><td>' : '<td>') ?>
						<input
						<?php foreach ($exercisesCheck as $exerciseCheck): ?>
							<?php if($exercise->getExerciseId()==$exerciseCheck->getExerciseId()){?>
								checked
						<?php } endforeach; ?>
						type="checkbox" name="exers[]" value="<?=$exercise->getExerciseId()?>"> <?=$exercise->getExerName()?>
						<?php echo ($cont%2==0 ? '</td>' : '</tr></td>') ?>

				<?php endforeach; ?>

			</table></div>


	<input class="form-control" type="hidden" name="id" value="<?= $tables->getTableid() ?>">

	<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?= i18n("Save changes") ?>">
</form>
<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editTableStyle.css">
