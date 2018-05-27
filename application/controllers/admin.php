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
        // messages
        $data ['cat_err_msg'] = $this->session->flashdata ('cat_err_msg');
        $data ['cat_msg'] = $this->session->flashdata ('cat_msg');

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
                $data ['cat_msg'] = 'Successfully edited the category';
            } else {
                // insert the category
                $this->adminmodel->createCategory ([
                    'name' => $this->input->post ('name'),
                    'parent' => $this->input->post ('parent')
                ]);
                $data ['cat_msg'] = 'Successfully created new category';
            }
        }

        // now load all the categories
        $data ['categories'] = $this->adminmodel->getAllCategories ();

        // build the breadcrumbs
        foreach ($data ['categories'] as $key => $category)
        {
            $data ['categories'] [$key] ['breadcrumb'] = $this->buildBreadCrumb ($category);
        }

        // now build the tree the easy way
        // first get the roots
        $roots = $this->adminmodel->getChildren ();
        foreach ($roots as $key => $item)
        {
            // build tree on the root elements
            $roots [$key] ['children'] = $this->buildTree ($item);
        }

        // pass the data to the view file
        $data ['tree'] = $roots;
        // load the view
        $this->load->view('admin', $data);
    }

    /**
     * @name buildTree
     * @author Mazhar Ahmed
     *
     * builds the tree on given root
     *
     * @param $category
     * @return bool
     */
    private function buildTree ($category)
    {
        // first find the children
        $children = $this->adminmodel->getChildren ($category ['id']);

        // on empty return false
        if (empty ($children))
        {
            return false;
        }

        // recursion for building the tree
        foreach ($children as $key => $child)
        {
            $children [$key] ['children'] = $this->buildTree ($child);
        }

        // return the tree on the element
        return $children;
    }

    /**
     * @name buildBreadCrumb
     * @author Mazhar Ahmed
     *
     * returns the breadcrumb of a category
     *
     * @param $category
     * @return string
     */
    private function buildBreadCrumb ($category)
    {
        // on empty return the name
        if (empty ($category ['parent']))
        {
            return $category ['name'];
        }

        // find the parent
        $parent = $this->adminmodel->getCategory ($category ['parent']);
        // call the recursion
        return $this->buildBreadCrumb ($parent) . ' > ' . $category ['name'];
    }

    public function delete_category ($id = false)
    {
        if (!$id)
        {
            $this->session->set_flashdata ('cat_err_msg', 'Nothing to delete');
            redirect ('/admin');
        }

        if ($this->adminmodel->hasChildren ($id))
        {
            $this->session->set_flashdata (
                'cat_err_msg',
                'Can not delete a category with children. Delete the children first'
            );
            redirect ('/admin');
        }

        $this->adminmodel->deleteCategory ($id);
        $this->session->set_flashdata (
            'cat_msg',
            'Successfully deleted the category'
        );
        redirect ('/admin');
    }

    /**
     * @name pages
     * @author Mazhar Ahmed
     *
     * this is the pages page
     */
    public function pages()
    {
        // messages
        $data ['page_err_msg'] = $this->session->flashdata ('page_err_msg');
        $data ['page_msg'] = $this->session->flashdata ('page_msg');

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
                $data ['page_msg'] = 'Successfully edited the page';
            } else {
                // insert the category
                $this->adminmodel->createCategory ([
                    'name' => $this->input->post ('name'),
                    'parent' => $this->input->post ('parent')
                ]);
                $data ['page_msg'] = 'Successfully created new page';
            }
        }

        // now load all the categories
        $data ['categories'] = $this->adminmodel->getAllCategories ();

        // build the breadcrumbs
        foreach ($data ['categories'] as $key => $category)
        {
            $data ['categories'] [$key] ['breadcrumb'] = $this->buildBreadCrumb ($category);
        }

        $data ['pages'] = $this->adminmodel->getAllPages ();

        // load the view
        $this->load->view('page', $data);
    }
}
