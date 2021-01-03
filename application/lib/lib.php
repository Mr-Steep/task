<?php
require_once __DIR__ . '/../models/ModelHeader.php';

$POST = $_POST;
if ($POST) {
    $flag = $POST['flag'];
    $controller = new ModelHeader();
    switch ($flag) {
        case 'CreateTask':
            $name = $POST['UserName'];
            $mail = $POST['UserMail'];
            $task = $POST['UserTask'];
            $res = $controller->CreateTask($name, $mail, $task);
            echo json_encode($res);
            break;
        case 'sort':
            $sort = $POST['sort'];
            $v = $POST['v'];
            $res = $controller->sort(1, $sort, $v);
            echo json_encode($res);
            break;

        case 'online':
            $res = $controller->ActiveAdmin();
            echo json_encode($res);
            break;

        case 'admin':
            $log = $POST['login'];
            $pass = $POST['pass'];
            if ($log == 'admin' && $pass == 123) {
                $controller->updateAdminActive('true');
                echo json_encode(true);

            } else {
                echo json_encode(false);
            }
            break;

        case 'exit_admin':
            $res = $controller->updateAdminActive('false');
            echo json_encode($res);
            break;

        case 'update_performance':
            $BOOL = $POST['new'];
            $id = intval($POST['id']);
            $res = $controller->UpdatePerformance($id, $BOOL);
            echo json_encode($res);
            break;

        case 'use_admin':
            $id = intval($POST['id']);
            $res = $controller->use_admin($id);
            echo json_encode($res);
            break;

        case 'task_update':
            $id = intval($POST['id']);
            $NewData = $POST['new_data'];
            $res = $controller->task_update($id, $NewData);
            $controller->use_admin($id);
            echo json_encode($res);
            break;
    }
}

