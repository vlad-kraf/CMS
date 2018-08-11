<?php
class Main extends Core
{
    public function fetch()
    {
        $categories = new Pages();
        $pages = $categories->getPages();

        $main_products = new Products();
        $filter = [
            'visible' => 1,
        ];
        $products = $main_products->getProducts($filter);

        $array_vars = array(
            'name' => 'hello',
            'pages' => $pages,
            'products' => $products,
        );
        echo $this->view->render('main.html',$array_vars);

    }

}
