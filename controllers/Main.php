<?php
class Main extends Core
{
    public function fetch()
    {


        $array_vars = array(
            'name' => 'hello',
        );
        //echo $this->view->render('main.html',$array_vars);
        return $this->view->render('main.html',$array_vars);

    }
}