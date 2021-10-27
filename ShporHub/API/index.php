<?php
    header('Access-Control-Allow-Origin: *');
    header("Content-type: application/json; charset=utf-8");
    
    error_reporting(1);
    require_once('application/Application.php');
    
    function router($params){
        $method = $params['method'];
        if($method){
            $app = new Application();
            switch($method){
                case 'login': return $app->login($params);
                case 'logout': return $app->logout($params);
                case 'registration': return $app->registration($params);
                case 'getProfile': return $app->getProfile($params);
                case 'updateProfile': return $app->updateProfile($params);
                case 'getLessons': return $app->getLessons();
                case 'getShpora': return $app->getShpora($params);
                case 'uploadShpora': return $app->uploadShpora($params);
            }
            return false;
        }
    }

    function answer($data){
        if($data){
            return array(
                'result' => 'ok',
                'data' => $data
            );
        } else {
            return array('result' => 'error');
        }
    }
    
    echo json_encode(answer(router(array_merge($_GET,$_POST))));

