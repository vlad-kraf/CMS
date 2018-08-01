<?php
class CategoryAdmin extends CoreAdmin
{
    public function fetch()
    {
        $categories = new Categories(); //подключаем модель категорий
        $request = new Request(); // покдлючаем модель Запрос
        ////////////////////////////
        ///
        $category = new stdClass();

        if($request->method() == 'POST') {
            $category->title = $request->post('title');
            $category->content = $request->post('content');
            $category->visible = $request->post('visible','integer');
            if(empty($request->post('url'))) {
                $category->url = CoreAdmin::translit($request->post('title'));
            } else {
                $category->url = $request->post('url');
            }

            if($request->post('id','integer')) {
                //обновляем категорию
                $id = $categories->updateCategory($request->post('id','integer'),$category);

            } else {
                //Добавление категории
                $id = $categories->addCategory($category);
            }

            $category = $categories->getCategory($id);
        } elseif($request->get('id','integer')) {
            $category = $categories->getCategory($request->get('id','integer'));
        }

        $array_vars = array(
            'category' => $category,
        );


        return $this->view->render('category.html',$array_vars);
    }
}