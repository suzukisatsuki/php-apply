<?php
    $dsn = 'mysql:host=localhost;dbname=casteria;charset=utf8';
    $user = 'root';
    $password = 'root';

try {
        $dbh = new PDO($dsn, $user, $password);
        $stmt = $dbh->prepare('SELECT * FROM contacts WHERE name = :name');
        $stmt->bindValue(":name", "鈴木", PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "接続成功\n";
        var_dump($result);
} catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
};

if (isset($_POST['submit'])) {
    try {
                $sql = 'INSERT INTO contacts(name,kana,tel,email) 
                        VALUE (:name, :kana, :tel, :email, :body)';
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':name', $_POST['name']);
                $stmt->bindValue(':kana', $_POST['kana']);
                $stmt->bindValue(':tel', $_POST['tel']);
                $stmt->bindValue(':email', $_POST['email']);
                $stmt->bindValue(':body', $_POST['body']);
                $stmt->execute();
    } catch (PDOException $e) {
                echo "接続失敗: " . $e->getMessage() . "\n";
                exit();
    };
}


// if (isset($_post['submit'])) {
//     try {
//                 $sql  = 'INSERT INTO contact(id,name,kana,tel,email,body,created_at)';
//                 $sql += 'VALUES ("'.$_POST['name'].'","'.$_POST['kana'].'",'.$_POST['tell'].')';
//                 $sql += $_POST['email']."','".$_POST['body']."')';
//                 $stmt = $dbh->prepare($sql);
//                 $stmt->bindValue()
//                 $stmt->execute();
//                 header('location: http://localhost:8001/');
//                 exit();
//         } catch (PDOException $e) {
//                   echo 'データベースにアクセスできません！'.$e->getMessage();
//     }