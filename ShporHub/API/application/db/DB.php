<?php
class DB {
    function __construct() {
        $host = 'localhost';
        $port = '3306';
        $name= 'shporhub';
        $user = 'root';
        $pass = '';
        try {
            $this->db = new PDO(
                'mysql:'.
                'host='.$host.';'.
                'port='.$port.';'.
                'dbname='.$name,
                $user,
                $pass
            );
        } catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }
    }

    function __destruct() {
        $this->db = null;
    }

    public function getUser($login) {
        $query = 'SELECT * 
            FROM users 
            WHERE login="'.$login.'"';
        return $this->db->query($query)
            ->fetchObject();
    }

    public function getUserByToken($token) {
        $query = 'SELECT * 
            FROM users 
            WHERE token="'.$token.'"';
        return $this->db->query($query)
            ->fetchObject();
    }

    public function getUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->db->query($query);
        $result = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $result[] = $row;
        }
        return $result;
    }

    public function updateToken($id, $token) {
        $query = 'UPDATE users 
            SET token="'.$token.'" 
            WHERE id='.$id;
        $this->db->query($query);
        return true;
    }

    /*
    function registration($params)
    {
        $hash = $params['hash'];
        $result = mysqli_query($this->connection, "INSERT INTO users (hash, course, direction) VALUES ('$hash', 1 ,'iivt')");
        return array (
            'access' => true
        );
    }

    function login($hash,$rand)
    {
        $result = mysqli_query($this->connection,"SELECT * FROM users");
        while ($record  = mysqli_fetch_assoc($result)){
            $token = md5($record['hash'].$rand);
            if ($token == $hash) {
                return array(
                    'name' => 'admin',
                    'token' => $token
                );
            }
        }
    }*/
}
