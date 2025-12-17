<?php
require_once __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}
require_login();
$user = current_user($pdo);
if (!$user || !$user['is_verified']) {
    die('Your account must be verified before posting comments.');
}
$article_id = (int)($_POST['article_id'] ?? 0);
$comment = trim($_POST['comment'] ?? '');
if ($article_id <= 0 || $comment === '') {
    die('Invalid submission');
}
$ins = $pdo->prepare('INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)');
$ins->execute([$article_id, $user['id'], $comment]);
header('Location: article.php?id=' . $article_id);
exit;
<?php
require_once __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php'); exit;
}
require_login();
$user = current_user($pdo);
if (!$user || !$user['is_verified']) {
    die('Your account must be verified before posting comments.');
}
$article_id = (int)($_POST['article_id'] ?? 0);
$comment = trim($_POST['comment'] ?? '');
if ($article_id <= 0 || $comment === '') {
    die('Invalid submission');
}
$ins = $pdo->prepare('INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)');
$ins->execute([$article_id, $user['id'], $comment]);
header('Location: article.php?id=' . $article_id);
exit;
