<?php

require_once('initPDO.php');

class User {
    protected $props;

    public function __construct($props = array()) { $this->props = $props; }

    public function __get($name) { return $this->props[$name]; }

    public function __set($name, $value) { $this->props[$name] = $value; }




    protected static function query($sql, $pdo){
        $st = $pdo->query($sql) or die("sql query error ! request : " . $sql);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        return $st->fetchAll();
        }

    public static function getAllUsers($pdo){
        $users = static::query("select * from users", $pdo);
        return $users;
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


