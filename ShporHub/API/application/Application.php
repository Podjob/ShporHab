<?php
require_once('db/DB.php');
require_once('users/Users.php');
require_once('profile/Profile.php');
require_once('subjects/Subjects.php');

class Application
{
    function __construct()
    {
        $db = new DB();
        $this->users = new Users($db);
        $this->profile = new Profile($db);
        $this->subjects =  new Subjects($db);
    }

    public function login($params) {
        if ($params['login'] && 
            $params['hash'] && 
            $params['rand']
        ) {
            return $this->users->login(
                $params['login'], 
                $params['hash'], 
                $params['rand']
            );
        }
    }

    public function logout($params) {
        $user = $this->users->getUser($params['token']);
        if ($user) {
            return $this->users->logout($user->id);
        }
    }

    public function registration($params)
    { 
        return $this->users->registration($params);
    }

    public function getProfile($params) {
        $user = $this->users->getUser($params['token']);
        if ($user) {
            return $this->profile->getProfile($user->id);
        }
    }

    public function updateProfile($params)
    {
        return $this->profile->updateProfile($params);
    }

    public function getLessons()
    {
        return $this->subjects->getLessons();
    }

    public function getShpora($params)
    {
        return $this->subjects->getShpora($params);
    }

    public function uploadShpora($params)
    {
        return $this->subjects->uploadShpora($params);
    }

}