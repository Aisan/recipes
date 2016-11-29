<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>レシピの一覧</title>
</head>
<body>
<h2>レシピの一覧</h2>
<a href="form.html">レシピの新規登録</a>
<?php
require_once '/Applications/MAMP/db_config.php';
try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM recipes";//SQL文の準備
    $stmt = $dbh->query($sql);//SQL文の実行
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//SQL文の結果の取り出し
    
    echo "<table>";
    echo "<tr>";
    echo "<th>料理名</th><th>予算</th><th>難易度</th>";
    echo "</tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['recipe_name'],ENT_QUOTES,'UTF-8')."</td>";
        echo "<td>".htmlspecialchars($row['budget'],ENT_QUOTES,'UTF-8')."</td>";
        echo "<td>".htmlspecialchars($row['difficulty'],ENT_QUOTES,'UTF-8')."</td>";
        echo "<td>";
        echo "<a href=detail.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>";
        echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>";
        echo "|<a href=delete.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    $dbh = null;
} catch (PDOException $e) {
    echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>
    
</body>
</html>