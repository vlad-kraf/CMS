<?php
class ProductAdmin extends CoreAdmin
{
    public function fetch()
    {
        $products = new Products(); //подключаем модель Товарры
        $request = new Request(); // покдлючаем модель Запрос
        ////////////////////////////
        ///
        $product = new stdClass();

        if($request->method() == 'POST') {
            $product->title = $request->post('title');
            $product->content = $request->post('content');
            $product->visible = $request->post('visible','integer');
            if(empty($request->post('url'))) {
                $product->url = CoreAdmin::translit($request->post('title'));
            } else {
                $product->url = $request->post('url');
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
                $files = reset($_FILES);

                $filename = $files['name'];
                    $path = $files['tmp_name'];

                $base = pathinfo($filename, PATHINFO_FILENAME);
                $ext = pathinfo($filename,PATHINFO_EXTENSION);


                $md5 = md5(rand(100,100500));
                $len = strlen($md5);
                $tm = '';
                for ($x = 0; $x < $len; $x+=4) {
                    $tm .= $md5[$x+rand(1,4)];
                }
                $name = $base.'_'.$tm.'.'.$ext;
                unset($tm);

                $res = move_uploaded_file($path,'\uploads'.$name);


                if($res) {
                    $product->filename = $name;
                    print_r ($files);
                    print_r ($product);
                } else {
                     Echo 'upload_error';
                }

            }



            if($request->post('id','integer')) {
                //обновляем товар
                $id = $products->updateProduct($request->post('id','integer'),$product);

            } else {
                //Добавление товара
                $id = $products->addProduct($product);
            }

            $product = $products->getProduct($id);
        } elseif($request->get('id','integer')) {
            $product = $products->getProduct($request->get('id','integer'));
        }

        $array_vars = array(
            'product' => $product,
        );


        return $this->view->render('product.html',$array_vars);
    }
}