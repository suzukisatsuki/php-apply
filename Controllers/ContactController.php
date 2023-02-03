<?php
require_once(ROOT_PATH .'Models/Contact.php');
class ContactController {
    private $request;   // リクエストパラメータ(GET,POST)
    private $Player;    // Playerモデル

    public function __construct() {
        // リクエストパラメータの取得
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;
        session_start();
    }

    public function contact()
    {
        if ($this->request['post']) {
            $error_messages = $this->validate($this->request['post']);
            if (!empty($error_messages)) {
                return $error_messages;
            }
            session_start();
            if (!empty($this->request['post']['id'])) {
                $_SESSION['id'] = htmlspecialchars($this->request['post']['id'], ENT_QUOTES | ENT_HTML5);
            }

            $_SESSION['name'] = htmlspecialchars($this->request['post']['name'], ENT_QUOTES | ENT_HTML5);
            $_SESSION['kana'] = htmlspecialchars($this->request['post']['kana'], ENT_QUOTES | ENT_HTML5);
            $_SESSION['tel'] = htmlspecialchars($this->request['post']['tel'], ENT_QUOTES | ENT_HTML5);
            $_SESSION['email'] = htmlspecialchars($this->request['post']['email'], ENT_QUOTES | ENT_HTML5);
            $_SESSION['body'] = htmlspecialchars($this->request['post']['body'], ENT_QUOTES | ENT_HTML5);
            header('Location:confirm.php');
            exit();
        }
    }

    private function validate($data)
    {
        $error_messages = [];

        if (empty($data['name'])) {
            $error_messages['name'] = '氏名は必須入力です。';
        } elseif (mb_strlen($data['name']) > 10) {
            $error_messages['name'] = '10文字以内で入力してください。';
        }
        if (empty($data['kana'])) {
            $error_messages['kana'] = 'フリガナは必須入力です';
        } elseif (mb_strlen($data['kana']) > 10) {
            $error_messages['kana'] = '10文字以内で入力してください。';
        }
        if (empty($data['tel'])) {
            $error_messages['tel'] = '電話番号は必須入力です。';
        } elseif (!preg_match('/^0[0-9]{9,10}\z/', $data['tel'])) {
            $error_messages['tel'] = '電話番号が正しくありません。';
        }
        if (empty($data['email'])) {
            $error_messages['email'] = 'メールアドレスは必須入力です。';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error_messages['email'] = 'メールアドレスが正しくありません。';
        }
        if (empty($data['body'])) {
            $error_messages['body'] = 'お問合せ内容は必須入力です。';
        }
        return $error_messages;
    }

    public function updateOrCreate() {
        $contact = new Contact();

        if (isset($_SESSION['id'])) {
            $contact->updateContact($_SESSION['id'], $_SESSION['name'], $_SESSION['kana'], $_SESSION['tel'], $_SESSION['email'], $_SESSION['body']);
        } else {
            $contact->addContact($_SESSION['name'], $_SESSION['kana'], $_SESSION['tel'], $_SESSION['email'], $_SESSION['body']);
        }
    }

    public function getContacts() {
        $contact = new Contact();
        return $contact->getContacts();
    }

    public function editContact($id) {
        $contact = new Contact();
        $tmp = $contact->findContact($id);
        return $tmp;
    }

    public function deleteContact($id) {
        $contact = new Contact();
        $contact->deleteContact($id);
    }

}
