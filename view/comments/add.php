<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

$comments = $view->getVariable("comments");
$errors = $view->getVariable("errors");
?>
<div class="container">
<h1><?= i18n("Create comment")?></h1>
<form class="form-signin" action="index.php?controller=comments&amp;action=add" method="POST">
	<div class="row">
		<div class="col-sm-3">
			<?= i18n("comment id") ?>: <input class="form-control" type="text" name="commentid"
			value="<?= $comments->getCommentid() ?>">
			<?= isset($errors["commentid"])?i18n($errors["commentid"]):"" ?><br>

			<?= i18n("content") ?>: <input class="form-control" type="text" name="content"
			value="<?= $comments->getContent() ?>">
			<?= isset($errors["content"])?i18n($errors["content"]):"" ?><br>

			<input type="hidden" name="username" value="<?=sprintf($currentuser)?>">
			<input type="hidden" name="sessionid" value="<?=sprintf($_REQUEST["idsession"])?>">
			<input type="hidden" name="tableid" value="<?=sprintf($_REQUEST["idtable"])?>">

			<input class="form-control" type="submit" name="submit" value="submit">
		</div>
	</form>
</div>
</div>
