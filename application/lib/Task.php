<?php

class Task
{
    /**
     * @var false|mysqli
     */
    private $link;


    public function __construct()
    {
        $host = 'localhost'; // адрес сервера
        $database = 'mrsteep'; // имя базы данных
        $user = 'mrroot'; // имя пользователя
        $password = 'Wasa123'; // пароль
        $this->link = mysqli_connect($host, $user, $password, $database);
    }


    public function newTask(string $user_name, string $mail, string $task): bool
    {
        $query = "INSERT INTO `todo`(`user`, `mail`, `taskdata`, `status`, `useadmin`) 
                    VALUES ('$user_name', '$mail', '$task', false, false)";
        $result = mysqli_query($this->link, $query);
        $this->close();
        return $result;
    }

    public function quantity_task(): int
    {

        $query = "SELECT COUNT(*) as count FROM todo";
        $result = mysqli_query($this->link, $query);
        $count = mysqli_fetch_assoc($result);
        return intval($count['count']);
    }

    public function getActiveAdmin(): bool
    {
        $query = "SELECT `active` FROM `users` WHERE `username`= 'admin' AND `password` = '123'";
        $result = mysqli_query($this->link, $query);
        $res = mysqli_fetch_assoc($result)['active'];
        return $res == 1;
    }

    public function sort(int $page, string $Sort, string $v): array
    {
        $from = ($page - 1) * 3;
        $query = "SELECT * FROM `todo` ORDER BY $Sort $v LIMIT $from, 3";
        $result = mysqli_query($this->link, $query);
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
        return $data;

    }

    public function update_admin_active(string $bool)
    {
        $query = "UPDATE users SET active = $bool WHERE id = 1";
        return $result = mysqli_query($this->link, $query);
    }


    public function get(int $page): array
    {
        $from = ($page - 1) * 3;
        $query = "SELECT * FROM `todo` WHERE id > 0 LIMIT $from, 3";
        $result = mysqli_query($this->link, $query);
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row) ;
        return $data;
    }

    public function update_performance(int $id, string $NewData)
    {
        $sql = "UPDATE todo SET status = $NewData WHERE id = $id";
        return $result = mysqli_query($this->link, $sql);
    }

    public function use_admin(int $id)
    {
        $query = "UPDATE todo SET useadmin = true WHERE id = $id";
        return $result = mysqli_query($this->link, $query);
    }

    public function task_update(int $id, string $NewData)
    {
        $query = "UPDATE todo SET taskdata = '$NewData' WHERE id = $id";
        return $result = mysqli_query($this->link, $query);

    }


    private function close()
    {
        mysqli_close($this->link);
    }


}