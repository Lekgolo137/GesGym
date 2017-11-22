<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");

?>
<div class="container">
<h1><?=i18n("tables")?></h1>

<table class="table table-striped">
	<tr>
				<th><?= i18n("Table id")?></th><th><?= i18n("Table type")?></th><th><?= i18n("Actions")?></th>
	</tr>

	<?php foreach ($tables as $table): ?>
		<tr>
			<td>
				<?= htmlentities($table->getTableid()) ?>
			</td>
			<td>
				<?= $table->getTabletipo() ?>
			</td>
			<td>
				<?php
				// 'Delete Button': show it as a link, but do POST in order to preserve
				// the good semantic of HTTP
				?>
				<form class="form-signin"
				method="POST"
				action="index.php?controller=tables&amp;action=delete"
				id="delete_table_<?= $table->getTableid(); ?>"
				style="display: inline"
				>

				<input type="hidden" name="id" value="<?= $table->getTableid() ?>">

				<a href="#"
				onclick="
				if (confirm('<?= i18n("are you sure?")?>')) {
					document.getElementById('delete_table_<?= $table->getTableid() ?>').submit()
				}"
				><?= i18n("Delete") ?></a>

			</form>

			&nbsp;

			<?php
			// 'Edit Button'
			?>
			<a href="index.php?controller=tables&amp;action=edit&amp;id=<?= $table->getTableid() ?>"><?= i18n("Edit") ?></a>
	</td>
</tr>
<?php endforeach; ?>

</table>
	<a href="index.php?controller=tables&amp;action=add"><?= i18n("Create table") ?></a>
</div>
