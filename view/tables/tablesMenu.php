<?php
//file: view/tables/tablesMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Manage Tables"));
$currentusertype = $view->getVariable("currentusertype");
?>
<div id="menu" class="container">
	<div class="row">
	
			<?php if($currentusertype == "entrenador"){ ?>
				<div class="col-sm-6">
					<a href="index.php?controller=tables&amp;action=add">
						<span class="glyphicon glyphicon-list-alt"></span>
						<br><?=i18n("New Table")?>
					</a>
				</div>

				<div class="col-sm-6">
					<a href="index.php?controller=tables&amp;action=tablesList">
						<span class="glyphicon glyphicon-list"></span>
						<br><?=i18n("Tables List")?>
					</a>
				</div>
			<?php } ?>

			<?php if($currentusertype == "deportista"){ ?>
				<div class="col-sm-12">
					<a href="index.php?controller=tables&amp;action=tablesListPublic">
						<span class="glyphicon glyphicon-list"></span>
						<br><?=i18n("Tables List")?>
					</a>
				</div>
			<?php } ?>

		</div>
	</div>

<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/tablesMenuStyle.css">
