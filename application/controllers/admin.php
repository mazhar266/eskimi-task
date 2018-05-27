<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        // load the login model
        $this->load->model ('loginmodel');
        // check if logged in
        if (!$this->loginmodel->isLogged ())
        {
            // on error go to login page
            redirect ('/');
        }

        // if login is success, load the admin model
        $this->load->model ('adminmodel');
    }

    /**
     * @name index
     * @author Mazhar Ahmed
     *
     * this is the categories page
     */
    public function index()
    {
        // check if any data is posted
        if ($this->input->post ())
        {
            // check if the id posted
            if ($this->input->post ('id'))
            {
                // update the category
                $this->adminmodel->updateCategory ($this->input->post ('id'), [
                    'name' => $this->input->post ('name'),
                    'parent' => $this->input->post ('parent')
                ]);
            } else {
                // insert the category
                $this->adminmodel->createCategory ([
                    'name' => $this->input->post ('name'),
                    'parent' => $this->input->post ('parent')
                ]);
            }
        }

        // now load all the categories
        $data ['categories'] = $this->adminmodel->getAllCategories ();

        // now build the tree the easy way
        $roots = $this->adminmodel->getChildren ();
        foreach ($roots as $item)
        {

        }

        $this->load->view('admin', $data);
    }
}
