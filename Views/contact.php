<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');
$contact_controller = new ContactController();
if (!empty($_GET['EditId'])) {
    $contact = $contact_controller->editContact($_GET['EditId']);
} elseif (isset($_GET['DeleteId'])) {
    $contact_controller->deleteContact($_GET['DeleteId']);
}
$arrays = $contact_controller->getContacts();
$error_messages = $contact_controller -> contact();
if (isset($_POST['submit'])) {
    $name  = htmlspecialchars($_POST['name'], ENT_QUOTES | ENT_HTML5);
    $furigana  = htmlspecialchars($_POST['kana'], ENT_QUOTES | ENT_HTML5);
    $number = htmlspecialchars($_POST['tel'], ENT_QUOTES | ENT_HTML5);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_HTML5);
    $body = htmlspecialchars($_POST['body'], ENT_QUOTES | ENT_HTML5);
}

// if ($_POST) {
//     session_start();
//     $_SESSION['name'] = $_POST['name'];
//     $_SESSION['kana'] = $_POST['kana'];
//     header('Location:confirm.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
</head>
<body>
    <div class="wrapper">     
        <p class="error"><?php
        if (!empty($error_messages)) {
            foreach ($error_messages as $value) {
                echo $value;
                echo '<pre>';
            }
        }
        ?></P>
        <h1 class="form-title">お問い合わせ</h1>
        <form class="form" action="contact.php" method="post">
        <?php if (isset($contact[0]['id'])) {?>
            <input type="hidden" name="id" value="<?php echo $contact[0]['id']; ?>">
        <?php }?>
        <p>氏名</p>
        <input type="text" name="name" value="<?php if (isset($_POST['name'])) {echo $_POST['name'];} elseif (isset($contact[0]['name'])) {echo $contact[0]['name'];} ?>" placeholder="お名前" >
        <p>フリガナ</p>
        <input type="text" name="kana" value="<?php if (isset($_POST['kana'])) {echo $_POST['kana'];} elseif (isset($contact[0]['kana'])) {echo $contact[0]['kana'];} ?>" placeholder="フリガナ" >
        <p>電話番号</p>
        <input type="tel" name="tel" value="<?php if (isset($_POST['tel'])) {echo $_POST['tel'];} elseif (isset($contact[0]['tel'])) {echo $contact[0]['tel'];} ?>" placeholder="電話番号" >
        <p>メールアドレス</p>
        <input type="email" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} elseif (isset($contact[0]['email'])) {echo $contact[0]['email'];} ?>" placeholder="メールアドレス" >
        <p>内容</p>
        <textarea type="text" name="body" placeholder="お問い合わせ内容" rows="7" ><?php if (isset($_POST['body'])) {echo $_POST['body'];} elseif (isset($contact[0]['body'])) {echo $contact[0]['body'];} ?></textarea>
        <button  type="submit" name="submit" value="確認">確認</button>
        </form>
    

        <table>
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>フリガナ</th>
                <th>電話番号</th>
                <th>メールアドレス</th>
                <th>お問い合わせ</th>
                <th></th>
                <th></th>

            </tr>
            <?php foreach ($arrays as $array) { ?>
            <tr>
                <td><?= htmlspecialchars($array['id'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><?= htmlspecialchars($array['name'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><?= htmlspecialchars($array['kana'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><?= htmlspecialchars($array['tel'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><?= htmlspecialchars($array['email'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><?= htmlspecialchars($array['body'], ENT_QUOTES | ENT_HTML5); ?></td>
                <td><a href="contact.php?EditId=<?=$array['id']?>">編集</a></td>
                <td><a href="contact.php?DeleteId=<?=$array['id']?>" onclick="return confirm('本当に削除しますか?')">削除</a></td>
            </tr>
            <?php } ?> 
        </table>
    </div>
</body>
</html>