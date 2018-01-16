<?php
//file: view/sessions/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$sessions = $view->getVariable("sessions");
$tables = $view->getVariable("tables");
$errors = $view->getVariable("errors");
$view->setVariable("title", "GesGym - ".i18n("New Session"));
$view->setVariable("header", i18n("New Session"));
?>
			<form class="form-signin" action="index.php?controller=sessions&amp;action=add" method="POST">
				<?= i18n("Choose one of your workout routines") ?>:
				<div id="tablas" class="form-control">
					<table class="table table-bordered">
						<?php $cont=1 ?>
						<?php foreach ($tables as $table): ?>
							<?php $cont++ ?>
							<?php echo ($cont%2==0 ? '<tr><td>' : '<td>') ?>
							<input type="radio" name="tableid" value="<?=$table->getTableId()?>" required>
							<a href="index.php?controller=tables&amp;action=view&amp;id=<?=$table->getTableId()?>"><?=$table->getTableNombre()?></a>
							<?php echo ($cont%2==0 ? '</td>' : '</tr></td>') ?>
						<?php endforeach; ?>
					</table>
				</div>
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Create new session")?>">
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=mainMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addSessionStyle.css">
