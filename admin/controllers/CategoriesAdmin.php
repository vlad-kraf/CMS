<?php
class CategoriesAdmin extends CoreAdmin
{
    public function fetch()
    {

        $categories = new Categories();
        $all_categories = $categories->getCategories();


        $array_vars = array(
            'Categories' => $all_categories,
            'name' => 'Categories',

        );

        return $this->view->render('categories.html',$array_vars);
    }
}