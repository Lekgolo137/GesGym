<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$tablesProp = $view->getVariable("tablesProp");
$titulo = $view->getVariable("titulo");
$view->setVariable("title", "GesGym - ".$titulo);
$currentusertype = $view->getVariable("currentusertype");
$action = $view->getVariable("action");
?>
<div class="container">
	<h1><?=$titulo?></h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th><?= i18n("Name")?></th>
				<th><?= i18n("Type")?></th>
				<th><?= i18n("Actions")?></th>
			</thead>
			<tbody>
				<?php foreach ($tables as $table){ ?>
					<tr>
						<td><?= htmlentities($table->getTableNombre()) ?></td>
						<td><?php if($table->getTabletipo() == "personalizada"){print i18n("Custom");}else{print i18n("Standard");} ?></td>
						<td>
							<a class="btn btn-sm btn-success" href="index.php?controller=tables&amp;action=view&amp;id=<?= $table->getTableid() ?>"><?=i18n("View")?></a>
							<?php if($currentusertype == "entrenador"){ ?>
								<a class="btn btn-sm btn-primary" href="index.php?controller=tables&amp;action=edit&amp;id=<?= $table->getTableid() ?>"><?= i18n("Modify") ?></a>
								<form class="form-signin"method="POST"action="index.php?controller=tables&amp;action=delete"id="delete_table_<?= $table->getTableid(); ?>"style="display: inline">
									<input type="hidden" name="id" value="<?= $table->getTableid() ?>">
									<a class="btn btn-sm btn-danger" href="#"onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('delete_table_<?= $table->getTableid() ?>').submit()}"><?= i18n("Delete") ?></a>
								</form>
							<?php } ?>
							<?php if($action == "prop"){ ?>
								<a class="btn btn-sm btn-danger" href="index.php?controller=tables&amp;action=unlinkUser&amp;id=<?= $table->getTableid() ?>"><?= i18n("Unlink") ?></a>
							<?php } ?>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
