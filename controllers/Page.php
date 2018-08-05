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

        $array_vars = array(
            'page' => $page,
        );

        if(isset($page->url)) {
            return $this->view->render('page.html',$array_vars);

        } else {
            header("http/1.0 404 not found");
            return $this->view->render('page404.html',$array_vars);
        }
    }
}