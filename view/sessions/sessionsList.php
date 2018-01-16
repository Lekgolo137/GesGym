<?php
//file: view/sessions/index.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$sessions = $view->getVariable("sessions");
$view->setVariable("title", i18n("GesGym - Sessions List"));
$tables = $view->getVariable("tables");
?>
			<div class="container">
				<h1><?=i18n("Sessions List")?></h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<th><?=i18n("Start Date")?></th>
							<th><?=i18n("End Date")?></th>
							<th><?=i18n("Coments")?></th>
							<th><?=i18n("Table")?></th>
							<th><?=i18n("Actions")?></th>
						</thead>
						<tbody>
<?php foreach ($sessions as $session): ?>
							<tr>
								<td><?=$session->getFechaInicio()?></td>
								<td><?=$session->getFechaFin()?></td>
								<td><?=$session->getComents()?></td>
<?php foreach ($tables as $table): ?>
<?php if ($table->getTableId() == $session->getTableId()): ?>
								<td><a href="index.php?controller=tables&action=view&id=<?=$session->getTableId()?>"><?=$table->getTableNombre()?></a></td>
<?php endif; ?>
<?php endforeach; ?>
								<td>
<?php if($session->getFechaFin() == NULL){?>
									<a class="btn btn-sm btn-danger" href="index.php?controller=sessions&action=close&id=<?= $session->getSessionId() ?>"><?= i18n("Close") ?></a>
<?php } ?>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>