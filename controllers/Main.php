<?php
class Main extends Core
{
    public function fetch()
    {
        $categories = new Pages();
        $pages = $categories->getPages();

        $array_vars = array(
            'name' => 'hello',
            'pages' => $pages
        );
    
        echo $this->view->render('main.html',$array_vars);

    }
}