<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('loginmodel');
    }

    /**
     * @name index
     * @author Mazhar Ahmed
     *
     * this is the login form viewer
     */
	public function index ()
	{
	    $data = [];
        // check if user credential is passed
	    if ($this->input->post ())
        {
            // try to login
            if (!$this->loginmodel->login ($this->input->post ('username'), $this->input->post ('password')))
            {
                // error message if login did not succeed
                $data ['msg'] = 'Username or Password is wrong';
            } else {
                // redirect on login success
                redirect ('admin');
            }
        }

        // check if already logged in
	    if ($this->loginmodel->isLogged ())
        {
            // redirect to the admin
            redirect ('admin');
        }

        // load the login view
		$this->load->view('login', $data);
	}

    /**
     * @name logout
     * @author Mazhar Ahmed
     *
     * logs out an user
     */
	public function logout ()
    {
        $this->loginmodel->logout ();
        redirect ('/');
    }
}
