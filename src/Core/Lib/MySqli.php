<?php


namespace Core\Lib;


class MySqli
{

    public function __construct(){}

    public function fetchAllFromDb($app, $user){
        $sql = "SELECT * FROM todos WHERE user_id = '${user['id']}'";
        return $app['db']->fetchAll($sql);
    }

    public function fetchByIdFromDb($app, $id){
        $sql = "SELECT * FROM todos WHERE id = '$id'";
        return $app['db']->fetchAssoc($sql);
    }

    public function insert($app, $user_id,$description){
        $sql = "INSERT INTO todos (user_id, description) VALUES ('$user_id', '$description')";
        return $app['db']->executeUpdate($sql);

    }

    public function markCompleted($app, $id){
        $sql = "UPDATE todos SET completed = 1 WHERE id ={$id}";
        return $app['db']->executeUpdate($sql);
    }

    public function deleteById($app, $id ){
        $sql = "DELETE FROM todos WHERE id = '$id'";
        return $app['db']->executeUpdate($sql);
    }

}