<?php
session_start();
    $pdo = new PDO('mysql:host=mysql321.phy.lolipop.lan;
                    dbname=LAA1553845-team1kadai1;charset=utf8',
                    'LAA1553845',
                    'Banana1234');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //データ取得
        $name = $_POST['username'];
        $pass = $_POST['password'];

        //データベースから値を取得
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //入力した情報とデータベースの情報が一致するか
        if ($user && password_verify($pass,$user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_pass'] = $user['password'];
            $_SESSION['user_name'] = $user['username'];

        // ホーム画面にリダイレクト
        header('Location: index.php');
        exit();
        } else {
            //エラーメッセージ
            $_SESSION['error_msg'] = "メールアドレスまたはパスワードが正しくありません。";
            header('Location: login.php');
            exit();
        }     
    }      
?>
