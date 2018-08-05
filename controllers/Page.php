<?php
class Page extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $uri = parse_url($_SERVER['REQUEST_URI']);

        $parts = explode('/',$uri['path']);
        $page = '';


        if(isset($parts[1])) {
            $page = (object) $pages->getPage($parts[1],'url');

        }
        //$object = (object) $page;
       // print_r($object->url);

        $array_vars = array(
            'title' => $page->url,
            'content' => $page->content,

        );
       //  print_r($array_vars);


  //     $page = $pages->getPage($parts[1],'url');
        $page = (object) $pages->getPage($parts[1],'url');



        if(isset($page->url)) {
            print_r($array_vars);
            return $this->view->render('page.html',$array_vars);

        } else {
            header("http/1.0 404 not found");
            return $this->view->render('page404.html',$array_vars);
        }
    }
}