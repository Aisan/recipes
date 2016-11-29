<?php
require_once '/Applications/MAMP/db_config.php';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try {
    if (empty($_POST['id'])) throw new Exception('Error');
    $id = (int) $_POST['id'];//POST変数からidを受け取る
    $dbh = new PDO('mysql:host=localhost;dbname=db1', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE recipes SET recipe_name = ?, category = ?, difficulty = ?, budget = ?, howto = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);//$stmtで$sqlをデータベースにセット
    $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $budget, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;//データベースとの接続を終了
    echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') . "レシピの更新が完了しました。<br>";
    echo "<a href='index.php'>トップページへ戻る</a>";
} catch (PDOException $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>