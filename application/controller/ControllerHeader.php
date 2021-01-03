<?php

class ControllerHeader
{
    private $model;
    private $activeAdmin;

    public function __construct($model)
    {
        $this->model = $model;
        $this->activeAdmin = $this->model->ActiveAdmin();
    }


    public function Tasks($sort = null): string
    {
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
        } else {
            $page = 1;
        }
        //DESC //ASC
        $v = $_GET['v'];
        switch ($sort) {
            case null:
                $data = $this->model->get($page);
                break;
            default:
                if ($v) {
                    $data = $this->model->sort($page, $sort, $v);
                } else {
                    $data = $this->model->sort($page, $sort, 'ASC');
                }

                break;
        }
        $tasks = "";
        foreach ($data as $item) {
            $name = $item['user'];
            $mail = $item['mail'];
            $task = $item['taskdata'];
            $status = $item['status'];
            $use_admin = $item['useadmin'];
            $id = $item['id'];
            $Class = 'alert alert-info';
            $CHEK = '';
            switch ($status) {
                case true:
                case 'true':
                    $CHEK = 'checked';
                    break;
            }
            switch ($use_admin) {
                case true:
                case 'true':
                    $Class = 'alert alert-warning';
                    break;
            }
//            $task = mb_strimwidth($task, 0, 90, "...");

            switch ($this->activeAdmin) {
                case true:
                case 'true':
                    $TASK = "<div class='task-bottom'><textarea class='data_task_text' id='$id'>$task</textarea></div>";
                    break;
                default:
                    $TASK = "<div class='task-bottom'>$task</div>";
                    break;
            }

            $DDIV = "
            <div class='row justify-content-between'>
    <div class='col-10'>
        <div id='task24' data-id='$id' class='$Class' role='alert'>
                <div class='row'>

                    <div class='col-4'>$name</div>
                    <div class='col-6 '>$mail<br></div>
                    <div class='col-12'><br></div>
                    <div class='col-9'>$TASK</div>

                </div>
        </div>
    </div>
    
    
    
    
    <div class='col-2'>
        <div id = 'performance' class='form-check form-switch'>
            <input class='form-check-input' data-id='$id' type='checkbox' id='performanceChecked' $CHEK>
        </div>
    </div>
  </div>
            ";


            $DIV = "
<div id='task24' data-id='$id' class='$Class' role='alert'>
    <div class='task-top'>
        <div class='task-top_name'>$name </div>
        <div class='task-top_mail'> $mail</div>
    </div>
    $TASK


</div>
";
            $tasks .= $DDIV;
        }
        return $tasks;
    }

    public function Pagination($sort = null, $v = null): string
    {
        $PagesCount = $this->model->quantity_task();
        $PageCount = ceil($PagesCount / 3);
        $pagination = '';
        switch ($sort) {
            case null:
                for ($i = 1; $i <= $PageCount; $i++) {
                    $pagination .= "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                break;
            default:
                $v = $v == null ? 'ASC' : $v;
                for ($i = 1; $i <= $PageCount; $i++) {
                    $pagination .= "<li class='page-item'><a class='page-link' href='?v=$v&sort=$sort&page=$i'>$i</a></li>";
                }
        }

        return $pagination;
    }


}

