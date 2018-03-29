<?php
class Model extends MysqliDb{
    private $conn_centron;
    
    function __construct() {
        parent::__construct(DB_HOST, DB_USER, DB_PASS, DB);
    }

    public function login($username, $password) {
        $this->where("username", $username);
        $user = $this->getOne("user");
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = 1;
            return true;
        }
        return false;
    }

    public function logout() {
        unset($_SESSION['user']);
    }
}

?>