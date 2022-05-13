<?php
//セッションの利用を開始
session_start();

//showCart.phpの購入ボタンからの遷移以外はメニュ―画面へリダイレクト
if(!isset($_POST['buyButton'])) {
    header('Location: ./menu.php');
    exit();
}

//セッション情報が切れていないかチェック
if(!isset($_SESSION['userInfo'])) {
    //切れてたらエラー番号16とともにエラーページへ遷移
    header('Location: ./error.php?errNum=16');
    exit();
}

//カートの中身があるかチェック
if(!isset($_SESSION['cartInfo'][0])) {
    //1つも無ければエラー番号17とともにエラーページへ遷移
    header('Location: ./error.php?errMsg=17');
    exit();
}

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

//一連のDB操作処理をまとめた関数を読み込む
require_once 'dbprocess.php';



//カートの中の書籍の価格を合計
$total = 0;
if(isset($_SESSION['cartInfo'])) {
    foreach($_SESSION['cartInfo'] as $bookData) {
        $total += $bookData['price'];
    }
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>購入品確認</title>
	</head>
    <body>
    <header>
    	<h2 align="center">書籍販売システムWeb版 Ver.2.0</h2>
    	<hr style="border: 2px solid blue;">
    	<div class="nav" style="position: absolute; top: 83px; left: 20px;">
    		<a href="./menu.php" style="margin: 0 20px 0 0;">[メニュー]</a>
    		<a href="./list.php">[書籍一覧]</a>
    	</div>
    	<h3 align="center">購入品確認</h3>
    	<div class="loginInfo" style="position: absolute; top: 55px; right: 60px;">
    		<p>名前：<?=$userInfo['user']?></p>
    		<p>権限：<?=$authority?></p>
    	</div>
    	<hr style="border: 1px solid black;">
    </header>
    <main>
    	<center>
    		<h4>下記の商品を購入しました。</h4>
    		<h4>ご利用ありがとうございました。</h4>
    		<br>
    		<table>
    			<tr>
    				<th>ISBN</th><th>TITLE</th><th>価格</th>
    			</tr>
    			<?php
            		foreach($_SESSION['cartInfo'] as $bookData) {?>
            		<tr>
            			<td><?=$bookData['isbn']?></td>
            			<td><?=$bookData['title']?></td>
            			<td><?=$bookData['price']?>円</td>
            		</tr>
        		<?php
        		}?>
    		</table>
    		<br><br>
    		<hr>
        	<table>
        		<tr>
        			<th style="width: 10vw; background-color: lightblue;">合計</th>
        			<td><?=$total?>円</td>
        		</tr>
        	</table>
    	</center>
    </main>
    </body>
</html>