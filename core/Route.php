<?php
class Route
{
    public static function run()
    {
        $models_dir = 'models/';
        $controllers_dir = 'controllers/';

        $uri = parse_url($_SERVER['REQUEST_URI']);

        $parts = explode('/',$uri['path']);


        /*Служебные ссылки*/
        $uri_array = array(
            '' => 'Main', //главная страница
            'catalog' => 'Catalog', //каталог
            'product' => 'Product', //страница товара
            'cart' => 'Cart', //корзина
            'order' => 'Order', //оформленный заказ
            'contact' => 'Contact', //страница контактов
        );

        if(!empty($parts)) {
            if (isset($uri_array[$parts[1]])) {
                //Это служебная ссылка
                if (file_exists($controllers_dir . $uri_array[$parts[1]] . '.php')) {
                    require $controllers_dir . $uri_array[$parts[1]] . '.php'; //controllers/Main.php
                    $controller = new $uri_array[$parts[1]](); // new Main();

                    if (method_exists($controller, 'fetch')) {
                        $controller->fetch();
                    } else {
                        Route::error404();
                    }
                }
            } else {
                if (file_exists($controllers_dir . 'Page.php')) {
                    require $controllers_dir . 'Page.php';
                    $controller = new Page();;
                    if (method_exists($controller, 'fetch')) {
                        print $controller->fetch();
                    } else {
                        Route::error404();
                    }
                }
            }

        }
    }

    public static function error404()
    {
        //здесь будет 404
    }
}