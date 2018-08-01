<?php
class Categories extends Database
{
    /*public function __construct()
    {
        parent::__construct();
    }*/

    public function addCategory($category)
    {
        if(empty($category)) {
            return false;
        }
        foreach ($category as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO categories ($colum_sql) VALUES ($val_sql)";
        //echo $query;
        $this->query($query);
        return $this->resId();
    }

    public function getCategory($id)
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id,title, content, url, visible FROM categories WHERE id = $id LIMIT 1";
        $this->query($query);
        return $this->result();
    }
    public function getCategories()
    {

        $query = "SELECT id,title, content, url, visible FROM categories";
        $this->query($query);
        return $this->results();
    }

    public function updateCategory($id, $category)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($category as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE categories SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }

}