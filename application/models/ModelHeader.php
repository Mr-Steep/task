<?php
require_once __DIR__ . '/../lib/Task.php';


class ModelHeader
{

    private $DBTask;

    public function __construct()
    {
        $this->DBTask = new Task();
    }

    function quantity_task()
    {
        return $this->DBTask->quantity_task();
    }


    function get(int $page): array
    {
        return $this->DBTask->get($page);
    }


    function CreateTask(string $user_name, string $mail, string $task): bool
    {
        return $this->DBTask->newTask($user_name, $mail, $task);
    }

    function sort(int $page, string $Sort, string $v): array
    {
        return $this->DBTask->sort($page, $Sort, $v);
    }

    function ActiveAdmin(): bool
    {
        return $this->DBTask->getActiveAdmin();
    }

    function updateAdminActive(string $bool)
    {
        return $this->DBTask->update_admin_active($bool);
    }

    function UpdatePerformance(int $id, string $NewData)
    {
        return $this->DBTask->update_performance($id, $NewData);
    }

    function use_admin(int $id)
    {
        return $this->DBTask->use_admin($id);
    }

    function task_update(int $id, string $NewData)
    {
        return $this->DBTask->task_update($id, $NewData);
    }

}