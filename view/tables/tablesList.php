<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$tablesProp = $view->getVariable("tablesProp");
$view->setVariable("title", i18n("GesGym - Tables List"));
$currentusertype = $view->getVariable("currentusertype");
?>
<div class="container">
	<h1><?=i18n("Tables List")?></h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th><?= i18n("Name")?></th>
				<th><?= i18n("Type")?></th>
				<th><?= i18n("Description")?></th>
				<th><?= i18n("Actions")?></th>
			</tr>
			<?php foreach ($tables as $table){?>
				<tr>
					<td><?= htmlentities($table->getTableNombre()) ?></td>
					<td>
						<?php if($table->getTabletipo() == "personalizada"){print i18n("Custom");}
						if($table->getTabletipo() == "estandar"){print i18n("Standard");} ?>
					</td>
					<td><?= htmlentities($table->getTableDescripcion()) ?></td>
					<td>
						<a class="btn btn-sm btn-success" href="index.php?controller=tables&amp;action=view&amp;id=<?= $table->getTableid() ?>"><?=i18n("View")?></a>
						<?php if($currentusertype == "deportista"){ ?>
								<a
								<?php foreach ($tablesProp as $tableProp){ ?>
									<?php if($table->getTableid() == $tableProp->getTableid()){?>
										style="display: none;"
									<?php } }  ?>
								class="btn btn-sm btn-primary" href="index.php?controller=tables&amp;action=choose&amp;id=<?= $table->getTableid() ?>"><?= i18n("Choose") ?></a>

						<?php } ?>
						<?php if($currentusertype == "entrenador"){ ?>
							<a class="btn btn-sm btn-primary" href="index.php?controller=tables&amp;action=edit&amp;id=<?= $table->getTableid() ?>"><?= i18n("Modify") ?></a>

							<form class="form-signin"method="POST"action="index.php?controller=tables&amp;action=delete"id="delete_table_<?= $table->getTableid(); ?>"style="display: inline">
								<input type="hidden" name="id" value="<?= $table->getTableid() ?>">
								<a class="btn btn-sm btn-danger" href="#"onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('delete_table_<?= $table->getTableid() ?>').submit()}"><?= i18n("Delete") ?></a>
							</form>
						<?php } ?>
					</td>
				</tr>
			<?php }?>
		</table>
	</div>
</div>
