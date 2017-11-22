<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$view->setVariable("title", i18n("GesGym - Tables List"));
?>
<div class="container">
	<h1><?=i18n("Tables List")?></h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<tr>
				<th><?= i18n("ID")?></th>
				<th><?= i18n("Type")?></th>
				<th><?= i18n("Actions")?></th>
			</tr>
			<?php foreach ($tables as $table): ?>
			<tr>
				<td><?= htmlentities($table->getTableid()) ?></td>
				<td>
					<?php if($table->getTabletipo() == "person"){print i18n("Custom");}
						  if($table->getTabletipo() == "noPerson"){print i18n("Standard");} ?>
				</td>
				<td>
					<a class="btn btn-sm btn-primary" href="index.php?controller=tables&amp;action=edit&amp;id=<?= $table->getTableid() ?>"><?= i18n("Modify") ?></a>
					<form class="form-signin"method="POST"action="index.php?controller=tables&amp;action=delete"id="delete_table_<?= $table->getTableid(); ?>"style="display: inline">
						<input type="hidden" name="id" value="<?= $table->getTableid() ?>">
						<a class="btn btn-sm btn-danger" href="#"onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('delete_table_<?= $table->getTableid() ?>').submit()}"><?= i18n("Delete") ?></a>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>