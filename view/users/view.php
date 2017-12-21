<?php
//file: view/users/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$trainer = $view->getVariable("trainer");
$sessions = $view->getVariable("sessions");
$tables = $view->getVariable("tables");
$activities = $view->getVariable("activities");
$view->setVariable("title", i18n("GesGym - View User"));
$view->setVariable("header", i18n("View User"));
?>
			<div class="row">
				<div class="col-sm-<?php if($user->getTipo() == "administrador") print "12"; else print "6"; ?>">
					<?=i18n("Username")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>"/>
					<?=i18n("Password")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Password")?>" value="<?=$user->getPassword()?>"/>
					<?=i18n("Type")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Type")?>"
						value="<?php if($user->getTipo() == "deportista"){print i18n("Sportsman");}
									 if($user->getTipo() == "entrenador"){print i18n("Trainer");}
									 if($user->getTipo() == "administrador"){print i18n("Administrator");} ?>"/>
					<?=i18n("Card")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Card")?>"
						value="<?php if($user->getSubtipo() == null){print i18n("None");}
									 if($user->getSubtipo() == "tdu"){print i18n("College Sports");}
									 if($user->getSubtipo() == "pef"){print i18n("Get Fit");} ?>"/>
				</div>
<?php if($user->getTipo() != "administrador") { ?>
				<div class="col-sm-6">
					<p><?=i18n("Other User Information")?></p>
<?php if($user->getTipo() == "deportista") { ?>
					<p><b><?=i18n("Trainer")?>:</b> <?php if($trainer == null) { print i18n("None"); } else { ?><a href="index.php?controller=users&amp;action=view&amp;id=<?=$trainer->getId()?>"><?=$trainer->getUsername()?></a></p>
<?php } ?>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><?=i18n("Sessions")?></th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($sessions as $session): ?>
								<tr>
									<td><a href="index.php?controller=sessions&amp;action=view&amp;id=<?=$session->getId()?>"><?=$session->getId()?></a></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><?=i18n("Tables")?></th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($tables as $table): ?>
								<tr>
									<td><a href="index.php?controller=tables&amp;action=view&amp;id=<?=$table->getId()?>"><?=$table->getNombre()?></a></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><?=i18n("Activities")?></th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($activities as $activity): ?>
								<tr>
									<td><a href="index.php?controller=activities&amp;action=view&amp;id=<?=$activity->getId()?>"><?=$activity->getNombre()?></a></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
					</div>
<?php } ?>
<?php if($user->getTipo() == "entrenador") { ?>
					<ul>
						<li><a><?=i18n("Sportsman")?>s</a></li>
						<li><a><?=i18n("Activities")?></a></li>
					</ul>
<?php } ?>
				</div>
<?php } ?>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=usersList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewUserStyle.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
