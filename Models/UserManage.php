<?php
require_once(ROOT_PATH .'Models/Db.php');

class contactLogic extends Db {
    public function __construct($dbh = null)
    {
        parent::__construct($dbh);
    }

    public function addContact($name, $kana, $tel, $email, $body)
    {
        $sql = 'INSERT INTO contacts( name, kana, tel, email, body) 
        VALUES("'.$name.'","'.$kana.'","'.$tel.'","'.$email.'","'.$body.'")';
        $stmt = $this->get_db_handler() -> prepare($sql);
        $stmt -> execute();
    }
    public function updateContact($id, $name, $kana, $tel, $email, $body)
    {
        $sql = 'UPDATE contacts set name = "'.$name.'", kana = "'.$kana.'", tel = "'.$tel.'", 
        email = "'.$email.'",body = "'.$body.'" WHERE id = "'.$id.'"';
        $stmt = $this->get_db_handler() -> prepare($sql);
        $stmt -> execute();
    }
    public function deleteContact($id)
    {
        $sql = 'DELETE FROM contacts WHERE id = "'.$id.'"';
        $stmt = $this->get_db_handler() -> prepare($sql);
        $stmt -> execute();
    }

    public function selectContact($id = 0)
    {
        $sql = 'SELECT * FROM contacts ';
        if (!empty($id)) {
            $sql.= 'where id='.$id.' limit 1';
        }
        $stmt = $this->get_db_handler()->prepare($sql);
        $res = $stmt->execute();
        if ($res) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($data);
            return $data;
        }
    }
}
?>