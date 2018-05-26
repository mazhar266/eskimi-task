<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('loginmodel');
        if (!$this->loginmodel->isLogged ())
        {
            redirect ('/');
        }
    }

    /**
     * @name index
     * @author Mazhar Ahmed
     *
     * this is the admin page
     */
    public function index()
    {
        $this->load->view('admin');
    }
}
