<?php

class View
{
    static function init($NameView, $controller, $model)
    {
        require_once __DIR__ . "./../view/$NameView.php";
        return new $NameView($controller, $model);
    }
    
    const modalbody = '
    <div class="mb-3">
    <label for="inputUser" class="form-label">Введите имя пользователя</label>
    <input type="text" required class="form-control" id="inputUser">
  </div>
  
   <div class="mb-3">
    <label for="inputEmail1" class="form-label"> Введите email</label>
    <input type="email" required class="form-control" id="inputEmail1" aria-describedby="emailHelp">
  </div>
 
 <div class="mb-3">
  <label for="textarea1" class="form-label">Задача</label>
  <textarea class="form-control"  required id="textarea1" rows="3"></textarea>
</div>
 
 ';


    static function body($BODY, $v)
    {
        $arrow_down = 'hidden';
        $arrow_up = 'hidden';
        switch ($v){
            case "ASC":
                $arrow_up = '';
                break;
            case "DESC":
                $arrow_down= '';
        }



        echo '<body>
<nav id= "12navbar" class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Задачник</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li id= "li1" class="nav-item">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Создать
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать Задачу</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ' . View::modalbody . '
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        <button id="save_task" type="submit" class="btn btn-primary">Сохранить</button>
      </div>
      
    </div>
  </div>
</div>
        </li>
        <li id= "li2" class="nav-item">
               <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Сортировать
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="?v=ASC&sort=user&page=1" id="sort-user">имени пользователя</a></li>
    <li><a class="dropdown-item" href="?v=ASC&sort=mail&page=1" id="sort-mail">email</a></li>
    <li><a class="dropdown-item" href="?v=ASC&sort=status&page=1" id="sort-status">статусу</a></li>
  </ul>
</div>   
                 </li id ="li5" class="nav-item">    
                 
                 <li>
                 
<div class="sort_data">
    <div class="arrow_down" ' . $arrow_down . '>
    <button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
        </svg>
                <span class="visually-hidden">Button</span>
              </button>
    
        
    </div>
    <div class="arrow_up" ' . $arrow_up . '>
       <button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
</svg>
                <span class="visually-hidden">Button</span>
              </button>
    </div>       
</div> 
</li> 
        <li id ="li3" class="nav-item"> 
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
 Вход для admin
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Вход для администратора</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3 row">
    <label for="staticLogin" class="col-sm-2 col-form-label">login</label>
    <div class="col-sm-10">
      <input type="text" class="form-control-plaintext" id="staticLogin" value="admin">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword">
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button id="login_admin" type="button" class="btn btn-primary">Войти</button>
      </div>
    </div>
  </div>
</div>
 </li>
 
  <li id= "li4" class="nav-item" hidden>
 <button id="exit_admin24" type="button" class="btn btn-outline-light">Выйти</button>
 <label for=""> Режим Администратора</label>
</li>
 
      </ul>
    </div>
  </div>
</nav>
' . $BODY . '

</body>';
    }

    static function footer()
    {
        echo
        '</html>';
//        echo "<script>history.pushState(null, null, '/');</script>";
    }


    static function head($title)
    {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <link href="/application/js/header.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title>' . $title . '</title>
    
</head>';
    }


}