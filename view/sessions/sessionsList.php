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
			<th><?=i18n("Start Date")?></th>
			<th><?=i18n("End Date")?></th>
			<th><?=i18n("Coments")?></th>
			<th><?=i18n("Table")?></th>
			<th><?=i18n("Actions")?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($sessions as $session): ?>
			<tr>
				<td><?=$session->getFechaInicio()?></td>
				<td><?=$session->getFechaFin()?></td>
				<td><?=$session->getComents()?></td>
				<td><a class="btn btn-sm btn-primary" href="index.php?controller=tables&action=view&id=<?= $session->getTableId() ?>"><?=i18n("View")?></a></td>
				<td>
					<?php if($session->getFechaFin() == NULL){?>
						<a class="btn btn-sm btn-danger" href="index.php?controller=sessions&action=close&id=<?= $session->getSessionId() ?>"><?= i18n("Close") ?></a>
					<?php } ?>

				</td>
			</tr>
		</tbody>
	<?php endforeach; ?>
</table>
</div>
</div>
