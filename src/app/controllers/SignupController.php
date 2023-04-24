<?php

use Phalcon\Mvc\Controller;


class SignupController extends Controller
{

    public function IndexAction()
    {
        // defalut action


    }

    public function registerAction()
    {
        $user = new Users();

        $esacaper = new Myescaper();

        $input = array(

            'name' => $esacaper->sanitize($this->request->getPost('name')),
            'email' => $esacaper->sanitize($this->request->getPost('email')),
            'password' => $esacaper->sanitize($this->request->getPost('password'))

        );

        $user->assign(
            $input,
            [
                'name',
                'email',
                'password',

            ]
        );
        
        if ($input['name'] == "" || $input['email'] == "" || $input['password'] == "") {
         
            $this->logger
                ->excludeAdapters['login'];
                $this->logger->info(implode("Not Register<br>", $user->getMessages()));


        }
        $success = $user->save();
        $this->session->set('name', $user->name);
        $this->session->set('email', $user->email);
        $this->session->set('password', $user->password);


        if (isset($_POST['remember'])) {
            $this->cookies->set('email', $this->session->get('email'), time() + 15 * 86400);
            $this->cookies->set('pass', $this->session->get('password'), time() + 15 * 86400);
        } else {
            $this->cookies->set('email', $this->session->get('email'), time() - 15 * 86400);
            $this->cookies->set('pass', $this->session->get('password'), time() - 15 * 86400);
        }

        $this->view->success = $success;
        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
        
    }
}
