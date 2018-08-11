<?php
class Products extends Database
{
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function addProduct($product)
    {
        if(empty($product)) {
            return false;
        }
        foreach ($product as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO products ($colum_sql) VALUES ($val_sql)";
        //var_dump($query);
        $this->query($query);
        return $this->resId();
    }

    public function getProduct($id)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id,title, content, url, visible FROM products WHERE id = $id LIMIT 1";
        $this->query($query);
        return $this->result();
    }

    public function getProducts($filter = array())
    {
        $visible_filter = '';
        if (!empty($filter['visible'])) {
            $visible_filter = 'AND visible = 1';
        }   

        $query = "SELECT id,title, content, url, visible FROM products where 1 $visible_filter";
        $this->query($query);
        return $this->results();
    }

    public function updateProduct($id, $product)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($product as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE products SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }

}