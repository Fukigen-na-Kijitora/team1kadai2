<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoリスト</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 1.8em;
        }
        .username {
            font-weight: bold;
        }
        a {
            color: purple;
            text-decoration: none;
        }
        .section {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .input-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        input[type="text"],
        select,
        input[type="date"] {
            padding: 5px;
            width: 180px;
        }
        button {
            padding: 5px 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        .actions a {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>ToDoリスト</h1>
    <div>
        <span class="username">今村ティナ さん</span>
        <a href="logout.php">ログアウト</a>
    </div>
</header>

<div class="section">
    <h2>タスク追加</h2>
    <form method="post" action="add_task.php">
        <div class="input-row">
            <input type="text" name="task" placeholder="タスク内容" required>
            <input type="date" name="due_date" required>
            <select name="priority">
                <option value="低">優先度（低）</option>
                <option value="中">中</option>
                <option value="高">高</option>
            </select>
            <button type="submit">追加</button>
        </div>
    </form>
</div>

<div class="section">
    <h2>フィルタ / 検索</h2>
    <form method="get" action="todo_list.php">
        <div class="input-row">
            <input type="text" name="keyword" placeholder="キーワード">
            <select name="status">
                <option value="">すべて</option>
                <option value="未完了">未完了</option>
                <option value="完了">完了</option>
            </select>
            <select name="priority_filter">
                <option value="">優先度</option>
                <option value="低">低</option>
                <option value="中">中</option>
                <option value="高">高</option>
            </select>
            <button type="submit">検索</button>
        </div>
    </form>
</div>

<div class="section">
    <table>
        <thead>
            <tr>
                <th>状態</th>
                <th>タスク</th>
                <th>期限</th>
                <th>優先度</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox" checked disabled></td>
                <td>Git課題の資料</td>
                <td>2025-06-10</td>
                <td>高</td>
                <td class="actions">
                    <a href="#">編集</a>
                    <a href="#">削除</a>
                </td>
            </tr>
            <!-- 以下、タスクが繰り返し表示される想定 -->
        </tbody>
    </table>
</div>
<?php
session_start();
require_once 'db.php';

// ログイン確認（未ログインならリダイレクト）
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoリスト</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 1.8em;
        }
        .username {
            font-weight: bold;
        }
        a {
            color: purple;
            text-decoration: none;
            margin-left: 10px;
        }
        .section {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .input-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        input[type="text"],
        select,
        input[type="date"] {
            padding: 5px;
            width: 180px;
        }
        button {
            padding: 5px 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        .actions a {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>ToDoリスト</h1>
    <div>
        <span class="username"><?php echo htmlspecialchars($username); ?> さん</span>
        <a href="logout.php">ログアウト</a>
    </div>
</header>

<!-- 以下、ToDo追加フォーム、検索、一覧など（前のコードと同じ） -->
<!-- ...（中略）... -->

</body>
</html>
