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
	public function index()
	{
	    $data = [];
        // check if user credential is passed
	    if ($this->input->post ())
        {
            // try to login
            if (!$this->loginmodel->login ($this->input->post ('username'), $this->input->post ('password')))
            {
                $data ['msg'] = 'Username or Password is wrong';
            }
        }

	    if ($this->loginmodel->isLogged ())
        {
            redirect ('admin');
        }

		$this->load->view('login', $data);
	}
}
