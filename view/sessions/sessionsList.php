<?php
//file: view/sessions/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$sessions = $view->getVariable("sessions");
$view->setVariable("title", i18n("GesGym - Sessions List"));
?>
<div class="container">
	<h1><?=i18n("Sessions List")?></h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<th><?=i18n("ID")?></th>
			<th><?=i18n("Coments")?></th>
			<th><?=i18n("Start Date")?></th>
			<th><?=i18n("End Date")?></th>
			<th><?=i18n("User")?></th>
			<th><?=i18n("Table")?></th>
			<th><?=i18n("Actions")?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($sessions as $session): ?>
			<tr>
				<td><?=$session->getSessionId()?></td>
				<td><?=$session->getComents()?></td>
				<td><?=$session->getFechaInicio()?></td>
				<td><?=$session->getFechaFin()?></td>
				<td><?=$session->getUserId()?></td>
				<td><?=$session->getTableId()?></td>
				<td>
					<a class="btn btn-sm btn-success" href="index.php?controller=comments&amp;action=add&amp;idtable=<?=$session->getTableid()?>&amp;idsession=<?=$session->getSessionId()?>"><?= i18n("Comment") ?></a>
					<a class="btn btn-sm btn-primary" href="index.php?controller=comments&amp;action=index&amp;id=<?=$session->getSessionId()?>"><?= i18n("View Comments") ?></a>
					<form action="index.php?controller=sessions&amp;action=close" method="POST" id="close_session_<?= $session->getSessionId(); ?>" style="display: inline">
						<input type="hidden" name="id" value="<?= $session->getSessionId() ?>">
						<input type="hidden" name="tableId" value="<?= $session->getTableId() ?>">
						<input type="hidden" name="usernameId" value="<?= $session->getUserId() ?>">
						<a class="btn btn-sm btn-danger" href="#" onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('close_session_<?= $session->getSessionId() ?>').submit()}"><?= i18n("Close") ?></a>
					</form>
				</td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>
</div>
</div>
