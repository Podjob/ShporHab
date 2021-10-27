<?php
class Users
{
    function __construct($db) {
        $this->db = $db;
    }

    public function login($login, $hash, $rand) {
        $user = $this->db->getUser($login);
        if ($user) {
            if ($hash === md5($user->password.$rand)) {
                $token = md5($hash.rand());
                $this->db->updateToken($user->id, $token);
                return array(
                    'name' => $user->name,
                    'token' => $token
                );
            }
        }
    }

    public function getUser($token) {
        return $this->db->getUserByToken($token);
    }

    public function logout($userId) {
        return $this->db->updateToken($userId, '');
    }

    public function registration($params) {
        return $this->db->registration($params['hash']);
    }

}


/*
    Загрузка предметов
    загрузка шпор

    Админка:
    uploadShpora (POST)

*/