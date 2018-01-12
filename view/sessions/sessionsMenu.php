<?php
//file: view/tables/tablesMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Manage Tables"));
$currentusertype = $view->getVariable("currentusertype");
?>
<div id="menu" class="container">
	<div class="row">
			<?php if($currentusertype == "administrador"){ ?>

			<?php } ?>
			<?php if($currentusertype == "entrenador"){ ?>

			<?php } ?>

			<?php if($currentusertype == "deportista"){ ?>
				<div class="col-sm-3">
					<a href="index.php?controller=sessions&amp;action=sessionsList">
						<span class="glyphicon glyphicon-list"></span>
						<br><?=i18n("Sessions List")?>
					</a>
				</div>
        <div class="col-sm-3">
          <a href="index.php?controller=sessions&amp;action=add">
            <span class="glyphicon glyphicon-hourglass"></span>
            <br><?=i18n("Create new session")?>
          </a>
        </div>
			<?php } ?>

		</div>
	</div>

<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/tablesMenuStyle.css">
