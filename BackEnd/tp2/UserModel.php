<?php

	class UserModel {
        public $id;
        public $login;
        public $email;




		protected static function getAllUsers() {
            $url = 'http://localhost:8888/BackEnd/tp2/api.php/users';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json'
            ]);

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if($httpCode !== '200') {
                print_r($httpCode);
                exit();
            }
            return json_decode($response, true);
        }

        public static function showAllUsersAsTable(){
            $users = static::getAllUsers();
            $table = "<table><tr><th>id</th><th>login</th><th>email</th></tr>";
            foreach($users as $user){
                $table .= $user->toHTML();
            }
            $table .= "</table>";
            return $table;
        }
    
        protected function toHTML(){
            return "<tr><td>".$this->id."</td><td>".$this->login."</td><td>".$this->email."</td></tr>";
    
        }
    }
    echo UserModel::showAllUsersAsTable();