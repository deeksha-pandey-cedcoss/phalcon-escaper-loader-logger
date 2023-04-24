<?php

use Phalcon\Mvc\Controller;

// login controller
class LoginController extends Controller
{
    public function indexAction()
    {
        // default login view
    }
    // login action page
    public function loginAction()
    {
        if ($this->request->isPost()) {
            $password = $this->request->getPost("password");
            $email = $this->request->getPost("email");
        }
        if ($this->cookies->has("email")) {
            $mail = $this->cookies->get("email");
            $pass = $this->cookies->get("pass");
            
        }
        $success = Users::findFirst(array("email = ?0,password = ?1, bind" => array($email,$password)));
        if ($success) {
            $this->view->message = "LOGIN SUCCESSFULLY";
            $this->response->redirect('dashboard/');
        } else {
            $this->logger
            ->excludeAdapters['signup'];
            $this->logger->info("Authentication Failed");
            $this->view->message = "Not Login succesfully ";

        }

    }
}
