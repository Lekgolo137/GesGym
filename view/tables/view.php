<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$exercises = $view->getVariable("exercises");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - View Table"));
$view->setVariable("header", i18n("View Table"));
?>


<?= i18n("Name") ?>:
<input disabled class="form-control" type="text" name="tableNombre" value="<?= $tables->getTableNombre() ?>">

<?= i18n("Type") ?>:
<select disabled class="form-control" name="tableTipo">
	<option value="estandar" <?php if ($tables->getTableTipo() == "estandar") print "selected"?> > <?=i18n("Standard")?> </option>
	<option value="personalizada" <?php if ($tables->getTableTipo() == "personalizada") print "selected"?> > <?=i18n("Custom")?> </option>
</select>

<?= i18n("Description") ?>:
<input disabled class="form-control" type="text" name="tableDescripcion" value="<?= $tables->getTableDescripcion() ?>"><br/>

<div class="form-control">
	<table class="table table-bordered">
		<?php $cont=1 ?>
		<?php foreach ($exercises as $exercise): ?>
			<?php $cont++ ?>
			<?php echo ($cont%2==0 ? '<tr><td>' : '<td>') ?>
				<input disabled type="checkbox" value="<?=$exercise->getExerciseId()?>"><?=$exercise->getExerName()?>
				<?php echo ($cont%2==0 ? '</td>' : '</tr></td>') ?>
			<?php endforeach; ?>
		</table>
	</div>
	
	<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesList"><?=i18n("Cancel")?></a>
	<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewTableStyle.css">
