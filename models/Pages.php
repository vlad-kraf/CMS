<?php
class Pages extends Database
{
    public function addPage($page)
    {
        if(empty($page)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column;
            $values[] = "'".$val."'";
        }

        $colum_sql = implode(',',$columns);
        $val_sql = implode(',',$values);

        $query = "INSERT INTO pages ($colum_sql) VALUES ($val_sql)";
        $this->query($query);
        return $this->resId();
    }

    public function getPage($id,$type = 'id')
    {
        if(empty($id)) {
            return false;
        }
        $query = "SELECT id, title, content, url, visible FROM pages WHERE $type = '$id' LIMIT 1";
      //  var_dump($query);
        $this->query($query);
        return $this->result();
    }


    public function getPages()
    {

        $query = "SELECT id, title, content, url, visible FROM pages";
        $this->query($query);
        return $this->results();
    }

    public function updatePage($id, $page)
    {
        if(empty($id)) {
            return false;
        }
        foreach ($page as $column => $val) {
            $columns[] = $column."="."'".$val."'";
        }
        $colum_sql = implode(',',$columns);
        $query = "UPDATE pages SET $colum_sql WHERE id=$id";
        $this->query($query);
        return $id;
    }

}