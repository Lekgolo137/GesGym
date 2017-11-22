<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

$comments = $view->getVariable("comments");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - New Comment"));
$view->setVariable("header", i18n("New Comment"));
?>
<form class="form-signin" action="index.php?controller=comments&amp;action=add" method="POST">

			<?= i18n("comment id") ?>: <input class="form-control" type="text" name="commentid"
			value="<?= $comments->getCommentid() ?>">
			<?= isset($errors["commentid"])?i18n($errors["commentid"]):"" ?><br>

			<?= i18n("content") ?>: <input class="form-control" type="text" name="content"
			value="<?= $comments->getContent() ?>">
			<?= isset($errors["content"])?i18n($errors["content"]):"" ?><br>

			<input type="hidden" name="username" value="<?=sprintf($currentuser)?>">
			<input type="hidden" name="sessionid" value="<?=sprintf($_REQUEST["idsession"])?>">
			<input type="hidden" name="tableid" value="<?=sprintf($_REQUEST["idtable"])?>">
			<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="submit">
</form>
<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=sessions&amp;action=sessionsList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addCommentStyle.css">
