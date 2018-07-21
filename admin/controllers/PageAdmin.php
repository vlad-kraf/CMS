<?php
class PageAdmin extends CoreAdmin
{
    public function fetch()
    {
        $pages = new Pages(); //подключаем модель страниц
        $request = new Request(); // покдлючаем модель Запрос
        ////////////////////////////
        ///
        $page = new stdClass();

        if($request->method() == 'POST') {
            $page->name = $request->post('name');
            $page->description = $request->post('description');
            $page->visible = $request->post('visible','integer');
            if(empty($request->post('url'))) {
                $page->url = CoreAdmin::translit($request->post('name'));
            } else {
                $page->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                //обновляем товар
                $id = $pages->updatePage($request->post('id','integer'),$page);

            } else {
                //Добавление товара
                $id = $pages->addPage($page);
            }

            $page = $pages->getPage($id);
        } elseif($request->get('id','integer')) {
            $page = $pages->getPage($request->get('id','integer'));
        }

        $array_vars = array(
            'page' => $page,
        );


        return $this->view->render('page.html',$array_vars);
    }
}