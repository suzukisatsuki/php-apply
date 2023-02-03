<?php
session_start();
if (empty($_SESSION)) {
  header('Location: contact.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
</head>
<body>
<h1 class="form-title">お問い合わせ</h1>
        <form class="form" action="complete.php" method="post">
        <?php if (isset($contact[0]['id'])) {?>
            <input type="hidden" name="id" value="<?php echo $contact[0]['id']; ?>">
        <?php }?>
        <p>氏名</p>
        <input type="text" disable name="name" value="<?php echo $_SESSION['name']; ?>" placeholder="お名前" >
        <p>フリガナ</p>
        <input type="text" disable name="kana" value="<?php echo $_SESSION['kana']; ?>" placeholder="フリガナ" >
        <p>電話番号</p>
        <input type="tel" disable name="tel" value="<?php echo $_SESSION['tel']; ?>" placeholder="電話番号" >
        <p>メールアドレス</p>
        <input type="email" disable name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="メールアドレス" >
        <p>内容</p>
        <textarea type="text" disable name="body" placeholder="お問い合わせ内容" rows="7" ><?php echo $_SESSION['body']; ?></textarea>
        <div>
          <button type="button" onclick="history.back()">戻る</button><button type="submit" name="submit">送信</button>
        </div>
      </form>
</body>
</html>