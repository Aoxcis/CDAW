<?php

class User extends Model {

   protected static $table_name = 'USER';

   // load all users from Db
   public static function getList() {
      $stm = parent::exec('USER_LIST');
      $users = $stm->fetchAll();

      return array_map(function($user) {
         return $user->props;
      }, $users);
   }

   public static function getUserById($id) {
      $stm = parent::exec('USER_GET_BY_ID', array('id' => $id));
      $user = $stm->fetch();
      return $user->props;
   }

   public static function update($data) {
      $stm = parent::exec('USER_UPDATE', $data);
      return $stm->rowCount();
   }
}
