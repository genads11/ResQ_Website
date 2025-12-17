<?php
require_once __DIR__ . '/config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php'); exit;
}
$stmt = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->execute([$id]);
$article = $stmt->fetch();
if (!$article) {
    header('Location: index.php'); exit;
}

$comments = $pdo->prepare('SELECT c.*, u.name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.article_id = ? ORDER BY c.created_at DESC');
$comments->execute([$id]);
$comments = $comments->fetchAll();

?>
<!doctype html>
<html><head><meta charset="utf-8"><title><?=htmlspecialchars($article['title'])?></title>
<link rel="stylesheet" href="styles.css"></head>
<body>
  <main style="max-width:900px;margin:18px auto;padding:12px">
    <a href="index.php">← Back</a>
    <h1><?=htmlspecialchars($article['title'])?></h1>
    <?php if (!empty($article['image'])): ?><img src="<?=htmlspecialchars($article['image'])?>" alt="" style="max-width:100%;height:auto"><?php endif; ?>
    <div class="article-content"><?= nl2br(htmlspecialchars($article['content'])) ?></div>

    <section id="comments">
      <h2>Comments</h2>
      <?php if (is_logged_in()): $u = current_user($pdo); if (!$u['is_verified']): ?>
        <p>Your account isn't verified yet. You cannot post comments until approved by an admin.</p>
      <?php else: ?>
        <form method="post" action="submit_comment.php">
          <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
          <textarea name="comment" rows="4" required></textarea><br>
          <button type="submit">Post comment</button>
        </form>
      <?php endif; else: ?>
        <p><a href="login.php">Login</a> or <a href="register.php">register</a> to post comments.</p>
      <?php endif; ?>

      <?php if (empty($comments)): ?>
        <p>No comments yet.</p>
      <?php else: foreach ($comments as $c): ?>
        <div style="border-top:1px solid #eee;padding:8px 0">
          <strong><?=htmlspecialchars($c['name'])?></strong> <small><?= $c['created_at'] ?></small>
          <div><?= nl2br(htmlspecialchars($c['comment'])) ?></div>
        </div>
      <?php endforeach; endif; ?>
    </section>
  </main>
</body></html>
<?php
require_once __DIR__ . '/config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php'); exit;
}
$stmt = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->execute([$id]);
$article = $stmt->fetch();
if (!$article) {
    header('Location: index.php'); exit;
}

$comments = $pdo->prepare('SELECT c.*, u.name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.article_id = ? ORDER BY c.created_at DESC');
$comments->execute([$id]);
$comments = $comments->fetchAll();

?>
<!doctype html>
<html><head><meta charset="utf-8"><title><?=htmlspecialchars($article['title'])?></title>
<link rel="stylesheet" href="styles.css"></head>
<body>
  <main style="max-width:900px;margin:18px auto;padding:12px">
    <a href="index.php">← Back</a>
    <h1><?=htmlspecialchars($article['title'])?></h1>
    <?php if (!empty($article['image'])): ?><img src="<?=htmlspecialchars($article['image'])?>" alt="" style="max-width:100%;height:auto"><?php endif; ?>
    <div class="article-content"><?= nl2br(htmlspecialchars($article['content'])) ?></div>

    <section id="comments">
      <h2>Comments</h2>
      <?php if (is_logged_in()): $u = current_user($pdo); if (!$u['is_verified']): ?>
        <p>Your account isn't verified yet. You cannot post comments until approved by an admin.</p>
      <?php else: ?>
        <form method="post" action="submit_comment.php">
          <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
          <textarea name="comment" rows="4" required></textarea><br>
          <button type="submit">Post comment</button>
        </form>
      <?php endif; else: ?>
        <p><a href="login.php">Login</a> or <a href="register.php">register</a> to post comments.</p>
      <?php endif; ?>

      <?php if (empty($comments)): ?>
        <p>No comments yet.</p>
      <?php else: foreach ($comments as $c): ?>
        <div style="border-top:1px solid #eee;padding:8px 0">
          <strong><?=htmlspecialchars($c['name'])?></strong> <small><?= $c['created_at'] ?></small>
          <div><?= nl2br(htmlspecialchars($c['comment'])) ?></div>
        </div>
      <?php endforeach; endif; ?>
    </section>
  </main>
</body></html>
