<?php
//file: view/sessions/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$sessions = $view->getVariable("sessions");
$view->setVariable("title", i18n("GesGym - Sessions List"));
?>
			<h1><?=i18n("Sessions List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?=i18n("ID")?></th>
								<th><?=i18n("User")?></th>
								<th><?=i18n("Table")?></th>
								<th><?=i18n("Start Date")?></th>
								<th><?=i18n("End Date")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($sessions as $session): ?>
							<tr>
								<td><?=$session->getSessionid()?></td>
								<td><?=$session->getUsername()?></td>
								<td><?=$session->getTableid()?></td>
								<td><?=$session->getFechaInicio()?></td>
								<td><?=$session->getFechaFin()?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=comments&amp;action=index&amp;id=<?=$session->getSessionid()?>"><?= i18n("Comment") ?></a>
									<form action="index.php?controller=sessions&amp;action=close" method="POST" id="close_session_<?= $session->getSessionid(); ?>" style="display: inline">
										<input type="hidden" name="id" value="<?= $session->getSessionid() ?>">
										<input type="hidden" name="tableId" value="<?= $session->getTableid() ?>">
										<input type="hidden" name="usernameId" value="<?= $session->getUsername() ?>">
										<a class="btn btn-sm btn-primary" href="#" onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('close_session_<?= $session->getSessionid() ?>').submit()}"><?= i18n("Close") ?></a>
									</form>
								</td>
							</tr>
						</tbody>
<?php endforeach; ?>
					</table>
				</div>	
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/sessionsList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
