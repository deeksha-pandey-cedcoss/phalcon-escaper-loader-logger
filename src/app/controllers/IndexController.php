<?php

use Phalcon\Mvc\Controller;
// defalut controller view
class IndexController extends Controller
{
    public function indexAction()
    {
        // version name and host name of configuration
        echo "Version -   ".$this->container->get('config')->app->version;
        echo "<br>";
        echo "Name :  ". $this->config->db->host;
        die;
        
    }
}
