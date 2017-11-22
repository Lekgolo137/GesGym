<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$sessions = $view->getVariable("sessions");

?>
<div class="container">
<h1><?=i18n("sessions")?></h1>

<table class="table table-striped">
	<tr>
				<th><?= i18n("session id")?></th><th><?= i18n("username")?></th><th><?= i18n("tableid")?></th><th><?= i18n("fechaInicio")?></th><th><?= i18n("fechaFin")?></th><th><?= i18n("Actions")?></th>
	</tr>

	<?php foreach ($sessions as $session): ?>
		<tr>
			<td>
				<?= $session->getSessionid() ?>
			</td>
      <td>
        <?= $session->getUsername() ?>
      </td>
      <td>
				<?= $session->getTableid() ?>
			</td>
      <td>
        <?= $session->getFechaInicio() ?>
      </td>
      <td>
        <?= $session->getFechaFin() ?>
      </td>
			<td>
				<?php
				// 'Delete Button': show it as a link, but do POST in order to preserve
				// the good semantic of HTTP
				?>
				<form class="form-signin"
				action="index.php?controller=sessions&amp;action=close"
				method="POST"
				id="close_session_<?= $session->getSessionid(); ?>"
				style="display: inline"
				>

				<input type="hidden" name="id" value="<?= $session->getSessionid() ?>">
				<input type="hidden" name="tableId" value="<?= $session->getTableid() ?>">
				<input type="hidden" name="usernameId" value="<?= $session->getUsername() ?>">

				<a href="#"
				onclick="
				if (confirm('<?= i18n("are you sure?")?>')) {
					document.getElementById('close_session_<?= $session->getSessionid() ?>').submit()
				}"
				><?= i18n("Close") ?></a>
			<a href="index.php?controller=comments&amp;action=index&amp;id=<?=$session->getSessionid()?>"><?= i18n("Comment") ?></a>
			</form>
	</td>
</tr>
<?php endforeach; ?>

</table>
	<a href="index.php?controller=sessions&amp;action=add"><?= i18n("Create session") ?></a>
</div>
