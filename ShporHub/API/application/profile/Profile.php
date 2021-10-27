<?php
    class Profile
    {
        function __construct($db)
        {
            
        }
    
        public function getProfile()
        {
            return array(
                'course' => 3,
                'direction' => 'iivt'
            );
        }
    
        public function updateProfile($params)
        {
            print_r($params['course']);
            print_r($params['direction']);
            return true;
        }
    
    }