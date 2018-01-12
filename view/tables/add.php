<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("tables");
$exercises = $view->getVariable("exercises");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - New Table"));
$view->setVariable("header", i18n("New Table"));
?>

<form class="form-signin" action="index.php?controller=tables&amp;action=add" method="POST">

	<?= isset($errors["tableNombre"])?i18n($errors["tableNombre"]):"" ?>
	<input class="form-control" type="text" name="tableNombre" placeholder="<?=i18n("Name")?>" value="<?= $post->getTableNombre() ?>">

	<?= isset($errors["tableTipo"])?i18n($errors["tableTipo"]):"" ?>
	<select class="form-control" name="tableTipo">
		<option value="estandar"><?=i18n("Standard")?></option>
		<option value="personalizada"><?=i18n("Custom")?></option>
	</select>
	<br/>

	<?= isset($errors["tableDescripcion"])?i18n($errors["tableDescripcion"]):"" ?>
	<textarea rows="5" class="form-control" name="tableDescripcion" placeholder="<?=i18n("Description")?>" value="<?= $post->getTableDescripcion() ?>"></textarea>
	<br/>



	<div class="form-control"><table class="table table-bordered">
		<?php $cont=1 ?>
		<?php foreach ($exercises as $exercise): ?>
			<?php $cont++ ?>
			<?php echo ($cont%2==0 ? '<tr><td>' : '<td>') ?>
				<input type="checkbox" name="exers[]" value="<?=$exercise->getExerciseId()?>">
				<a href="index.php?controller=exercises&amp;action=viewPublic&amp;id=<?=$exercise->getExerciseId()?>"><?=$exercise->getExerName()?></a>
				<?php echo ($cont%2==0 ? '</td>' : '</tr></td>') ?>

			<?php endforeach; ?>

		</table>
	</div>

	<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Create new table")?>">
</form>
<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addTableStyle.css">
