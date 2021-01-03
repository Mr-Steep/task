<?php

class ViewHeader extends View
{
    private $model;
    private $title = "Задачник";
    private $controller;

    public function __construct($controller, $model)
    {
        $this->controller = $controller;
        $this->model = $model;
        $this->core();
    }

    public function core()
    {
        View::head($this->title);
        if (isset($_GET['sort'])) {
            $this->HeaderBody($_GET['sort'], $_GET['v']);
        } else {
            $this->HeaderBody();
        }
        View::footer();
    }


    public function HeaderBody($sort = null, $v = null)
    {
        $TASKS = $this->controller->Tasks($sort);
        $PAGINATION = $this->controller->Pagination($sort, $v);;
        $body = '<script type="text/javascript" src="/application/js/header.js">
</script>
<div class="div">
' . $TASKS . '
<nav aria-label="page navigation">
  <ul class="pagination">
   ' . $PAGINATION . '
  </ul>
</nav>
</div>
';
        View::body($body, $v);
    }

}


