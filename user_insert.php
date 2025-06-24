<?php
session_start();
    
try {
    // データベース接続
    $pdo = new PDO('mysql:host=mysql321.phy.lolipop.lan;
                    dbname=LAA1553845-team1kadai1;charset=utf8',
                    'LAA1553845',
                    'Banana1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 入力データ取得
        $name = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        // 入力データ検証
        if (empty($name) || empty($password)) {
            die('全てのフィールドを入力してください。');
        }
        // パスワードのハッシュ化
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // データベースに挿入
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:u_name, :u_password)");
        $stmt->bindParam(':u_name', $name);
        $stmt->bindParam(':u_password', $hashed_password);
        $stmt->execute();

        // 挿入されたユーザーIDを取得
        $user_id = $pdo->lastInsertId();

        // セッションに保存
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_pass'] = $password;

        // ホーム画面にリダイレクト
        header('Location: index.php');
        exit();
    }
} catch (PDOException $e) {
    die('データベースエラー: ' . $e->getMessage());
}
?>
