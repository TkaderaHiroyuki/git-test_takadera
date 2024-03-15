<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ表示</title>
    <style>
        .list {
            font-size: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="list">
        <p>問い合わせ一覧</p>
    </div>

    <?php
    // データベース接続情報
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "git_test";

    try {
        // PDOオブジェクトを作成してデータベースに接続
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // PDOのエラーモードを例外に設定
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // データを取得するためのクエリ
        $sql = "SELECT id, name, address, comment FROM comments";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // 結果があるか確認
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>名前</th><th>住所</th><th>コメント</th></tr>";
            
            // データを出力
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["address"]. "</td><td>" . $row["comment"]. "</td></tr>";
            }
            
            echo "</table>";
        } else {
            echo "データがありません";
        }
    } catch(PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }

    // 接続を閉じる
    $conn = null;
    ?>
</body>
</html>
