<?php

require_once('initPDO.php');

class User {
    public $id;
    public $login;
    public $email;

    public static function getAllUsers($pdo){
        $request = $pdo->prepare("select * from users");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function showAllUsersAsTable($pdo){
        $users = static::getAllUsers($pdo);
        $table = "<table><tr><th>id</th><th>login</th><th>email</th></tr>";
        foreach($users as $user){
            $table .= $user->toHTML();
        }
        $table .= "</table>";
        return $table;
    }

    public function toHTML(){
        return "<tr><td>".$this->id."</td><td>".$this->login."</td><td>".$this->email."</td></tr>";

    }
}

echo User::showAllUsersAsTable($pdo);


