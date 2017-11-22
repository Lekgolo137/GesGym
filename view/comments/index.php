<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$comments = $view->getVariable("comments");

?>
<div class="container">
<h1><?=i18n("Comments")?></h1>

<table class="table table-striped">
  <tr>
    <th><?= i18n("commentid")?></th><th><?= i18n("content")?></th><th><?= i18n("username")?></th>
    <th><?= i18n("sessionid")?></th><th><?= i18n("tableid")?></th><th><?= i18n("Actions")?></th>
  </tr>

  <?php foreach ($comments as $comment): ?>
    <tr>
      <td>
        <?= $comment->getCommentid()?>
      </td>
      <td>
        <?= $comment->getContent() ?>
      </td>
      <td>
        <?= $comment->getUsername() ?>
      </td>
      <td>
        <?= $comment->getSessionid() ?>
      </td>
      <td>
        <?= $comment->getTableid() ?>
      </td>
      <td>
        <?php
        // 'Delete Button': show it as a link, but do POST in order to preserve
        // the good semantic of HTTP
        ?>
        <form class="form-signin"
        method="POST"
        action="index.php?controller=comments&amp;action=delete"
        id="delete_comment_<?= $comment->getCommentid(); ?>"
        style="display: inline"
        >

        <input type="hidden" name="id" value="<?= $comment->getCommentid() ?>">

        <a href="#"
        onclick="
        if (confirm('<?= i18n("are you sure?")?>')) {
          document.getElementById('delete_comment_<?= $comment->getCommentid() ?>').submit()
        }"
        ><?= i18n("Delete") ?></a>

      </form>

      &nbsp;
    </td>
  </tr>
<?php endforeach; ?>
</table>

<a href="index.php?controller=comments&amp;action=add&amp;idtable=<?=$comment->getTableid()?>&amp;idsession=<?=$comment->getSessionid()?>"><?= i18n("Create comment") ?></a>
</div>
