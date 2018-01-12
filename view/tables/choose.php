<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$exercises = $view->getVariable("exercises");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - View Table"));
$view->setVariable("header", i18n("View Table"));
$currentusertype = $view->getVariable("currentusertype");
?>

<form class="form-signin" action="index.php?controller=tables&amp;action=linkUser" method="POST"">

	<?= i18n("Name") ?>:
	<input disabled class="form-control" type="text" name="tableNombre" value="<?= $tables->getTableNombre() ?>">

	<?= i18n("Type") ?>:
	<select disabled class="form-control" name="tableTipo">
		<option value="estandar" <?php if ($tables->getTableTipo() == "estandar") print "selected"?> > <?=i18n("Standard")?> </option>
		<option value="personalizada" <?php if ($tables->getTableTipo() == "personalizada") print "selected"?> > <?=i18n("Custom")?> </option>
	</select>

	<?= i18n("Description") ?>:
	<textarea disabled rows="5" class="form-control" type="text" name="tableDescripcion"> <?= $tables->getTableDescripcion() ?> </textarea><br/>

	<div disabled class="form-control">
		<table class="table table-bordered">
			<?php $cont=1 ?>
			<?php foreach ($exercises as $exercise): ?>
				<?php $cont++ ?>
				<?php echo ($cont%2==0 ? '<tr><td>' : '<td>') ?>
					<input disabled type="checkbox" value="<?=$exercise->getExerciseId()?>">
					<a href="index.php?controller=exercises&amp;action=viewPublic&amp;id=<?=$exercise->getExerciseId()?>"><?=$exercise->getExerName()?></a>
					<?php echo ($cont%2==0 ? '</td>' : '</tr></td>') ?>
				<?php endforeach; ?>
			</table>
		</div>

		<input class="form-control" type="hidden" name="id" value="<?= $tables->getTableid() ?>">

		<?php if($currentusertype == "entrenador"){ ?>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesList"><?=i18n("Cancel")?></a>
		<?php } if($currentusertype == "deportista"){ ?>
			<?php if(true){ ?>
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Choose table")?>">
				<a class="btn btn-lg btn-primary btn-block" href="javascript:history.back()"><?=i18n("Cancel")?></a>
			<?php } ?>
		<?php } ?>
	</form>
	<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewTableStyle.css">
