<?php
class Contact extends Core
{

    public $data_contacts;

    public function fetch()
    {
        $this->data_contacts = new Contacts();
      
        print $this->view->render('contact.html', $this->data_contacts->getData());
    
    }
}