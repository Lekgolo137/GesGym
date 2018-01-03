<?php
//file: view/users/sportsmansList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$users = $view->getVariable("users");
$view->setVariable("title", "GesGym - ".i18n("Your Sportsmans"));
?>
			<h1><?=i18n("Your Sportsmans")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Username")?></th>
								<th><?=i18n("Card")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user): ?>
							<tr>
								<td><?=$user->getUsername()?></td>
								<td><?php if($user->getSubtipo() == null){print i18n("None");}
										  if($user->getSubtipo() == "tdu"){print i18n("College Sports");}
										  if($user->getSubtipo() == "pef"){print i18n("Get Fit");} ?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=users&amp;action=view&amp;id=<?=$user->getId()?>"><?=i18n("View")?></a>
									<a class="btn btn-sm btn-primary" href="index.php?controller=users&amp;action=edit&amp;id=<?=$user->getId()?>"><?=i18n("Modify")?></a>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/sportsmansList.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
