<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Git・PHP・SQL　テスト課題</title>
    <style>
        /* CSS スタイルをここに追加 */
        body {
            font-family: Arial, sans-serif;
            background: url(img/7fish.jpg) center/cover no-repeat;
            text-align: center; /* 全体を中央寄せにする */
        }
        .main__kv {
            display: flex;
            align-items: center;
            justify-content: center; /* 要素を中央寄せにする */
            margin-top: 50px; /* 上部の余白を追加 */
        }
        .main__kv img {
            margin-right: 20px;
            width: 300px; /* 画像の幅を適切に調整してください */
        }
        .main__kv p {
            font-size: 24px; /* 文字サイズを大きめに */
            line-height: 1.5;
        }
        form {
            margin-top: 50px; /* フォームの上部の余白を追加 */
        }
        form label {
            font-size: 20px; /* ラベルの文字サイズを大きめに */
        }
        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: 80%; /* 入力フォームを大きくする */
            padding: 10px; /* 入力フォームの余白を追加 */
            font-size: 18px; /* 入力フォームの文字サイズを大きめに */
            margin-bottom: 10px; /* 入力フォームの下部の余白を追加 */
        }
        form input[type="submit"] {
            padding: 10px 20px; /* 送信ボタンの余白を調整 */
            font-size: 18px; /* 送信ボタンの文字サイズを大きめに */
        }
        .frame{
    width: 30vh;
}
.Profile{
    display: flex;
    padding: 30px;
margin-bottom: 50px;
}
.text_container{


    padding-left: 10%;
    padding-right: 10%;
    margin-left: 5%;
    padding-bottom: 10%;
    border-radius: 50px;
    font-size: 25px;
    line-height: 50px;
}
.Name{
    text-align: center;
    font-weight: bold;
}
    </style>

    <script>
        function submitForm() {
        // 名前と住所が入力されているかを確認
        var name = document.getElementById("name").value;
        var address = document.getElementById("address").value;

        if (name === "" || address === "") {
            // 名前または住所が未入力の場合、アラートを表示してフォーム送信をキャンセル
            alert("名前と住所は必須項目です。入力してください。");
            return false;
        }            

            // 送信成功時にアラートを表示
            alert("送信されました");

            // 送信成功時に別のページにリダイレクト
            window.location.href = 'git.php';
        }
    </script>

</head>

<body>
    <main class="main">
        <section class="main__kv">
            <img src="img/maturi1.JPG" alt="自己紹介画像"> <!-- 画像パスを適切なものに置き換えてください -->
            <p>名前:  高寺宏幸<br>
            1998年7月生まれ。25歳　寅年🐯蟹座♋️<br>
            生まれ育ちは大阪南部でだんじり祭りに参加しています！<br>
            6歳から14歳までサッカーをしていました。<br>
            趣味は、釣り・スノボ・サーフィン・キャンプ・バイク・車！<br></p>
        </section>
        <section class="Profile">
       <div class="img_container">
           <img class="frame" src="./img/Jidori.jpg" alt="">
       </div>
       <div class="text_container">
           <p class="Name">ジソウスイッチ6期生 サブ講師 宮下 志大</p>
           どうも！最近第三の目が開眼しそうな宮下です！ <br>
           趣味は競馬で、好きな馬はエフフォーリア、ドウデュースです！<br>
           オススメのレースはやっぱり<a href="https://youtu.be/iFHXutgs0MQ?si=pr8YOCs7PQkzqcMF">2021年 天皇賞秋</a>と<a href="https://youtu.be/B51PM7I54Us?si=ABXkAQTtWrAsBWGf">2022年 日本ダービー</a>ですね！<br>
           ちょっとでも競馬に興味があったら気軽に連絡ください！<br>
           一緒に競馬場に行きましょう！
       </div>

   </section> 
    </main>
    <form action="git.php" method="post" onsubmit="return submitForm()">
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" required><br>
    
        <label for="subject">宛先:</label>
        <select  name="subject" id="subject">
            <option value=""></option>
            <option value="高寺">高寺</option>
            <option value="宮下">宮下</option>
        </select>   
        <br>

        <label for="address">住所:</label>
        <input type="text" name="address" id="address" required><br>
    
        <label for="mail">メールアドレス:</label>
        <input type="email" name="mail" id="mail" required><br>
    
        <label for="comment">コメント:</label>
        <textarea name="comment" id="comment" rows="4" required></textarea><br>
    
        <input type="submit" value="送信">
    </form>
</body>

</html>


<?php
// データベース接続情報
$servername = "localhost";
$username = "root";
$password = "";
$database = "git-test";

try {
    // PDOオブジェクトを作成してデータベースに接続
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // PDOのエラーモードを例外に設定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームから送信されたデータの取得
    $name = isset($_POST['name']) ? $_POST['name'] : ''; // フォームで入力された名前
    $subject = isset($_POST['subject']) ? $_POST['subject'] : ''; 
    $address = isset($_POST['address']) ? $_POST['address'] : ''; // フォームで入力された住所
    $comment = isset($_POST['comment']) ? $_POST['comment'] : ''; // フォームで入力されたコメント

    // プリペアドステートメントの作成
    $stmt = $conn->prepare("INSERT INTO comments (name, address,subject, comment) VALUES (:name, :address,:subject, :comment)");

    // パラメータをバインド
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':comment', $comment);

    // ステートメントの実行
    if ($stmt->execute()) {
        // 最後に挿入された行のIDを取得
        $last_inserted_id = $conn->lastInsertId();
        echo "データが正常に挿入されました。";
    } else {
        echo "データの挿入中にエラーが発生しました。";
    }
} catch(PDOException $e) {
    echo "接続エラー: " . $e->getMessage();
}

// 接続を閉じる
$conn = null;
?>
<br>
<a href="./git2.php">コメント欄へ</a>