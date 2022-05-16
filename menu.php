<?php
//セッションの開始
session_start();

//セッションに登録されているユーザー情報を取得
$userInfo = $_SESSION['userInfo'];

if(!isset($userInfo)) { //セッションに登録されているユーザー情報が無い場合実行
    //ログイン画面に遷移
    header('Location: ./login.php');
    exit();
} else {
    //ユーザー情報
    switch ($userInfo['authority']) {
        case '1':
            $authority = '一般ユーザ';
            break;
        case '2':
            $authority  = '管理者';
    }
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>メニュー画面</title>
	</head>
    <body>
    <header>
    	<h2 align="center">書籍販売システムWeb版 Ver.2.0</h2>
    	<hr style="border: 2px solid blue;">
    	<h3 align="center">MENU</h3>
    	<div class="loginInfo" style="position: absolute; top: 55px; right: 60px;">
    		<p>名前：<?=$userInfo['user']?></p>
    		<p>権限：<?=$authority?></p>
    	</div>
    	<hr style="border: 1px solid black;">
    </header>
    <main>
		<center>
			<br><br>
			<p><a href="./list.php">【書籍一覧】</a></p>
			<p><a href="./insert.php">【書籍登録】</a></p>
			<br><br>
			<p><a href="./showCart.php">【カート状況確認】</a></p>
			<p><a href="./insertIniData.php">【初期データ登録（データがない場合のみ）】</a></p>
			<br>
			<p><a href="./orderStatus.php">【購入状況確認】</a></p>
			<br><br>
			<p><a href="./logout.php">【ログアウト】</a></p>
		</center>
    </main>
    <footer>
    	<br><br><br>
    	<hr style="border: 1px solid blue;">
    	<p>Copyright (C) 20YY All Rights Reserved.</p>
    </footer>
    </body>
</html>