<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    // categories
    private $categories = [];

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
        // load the admin helper too
        $this->load->helper ('admin');
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

        // now load all the categories, just one database hit
        $data ['categories'] = $this->adminmodel->getAllCategories ();
        $this->categories = $data ['categories'];

        // build the breadcrumbs, so that it doesn't have to be called again and again
        foreach ($data ['categories'] as $key => $category)
        {
            $data ['categories'] [$key] ['breadcrumb'] = $this->buildBreadCrumb ($category);
        }

        // load the view
        $this->load->view('admin', $data);
    }

    /**
     * @name getCategory
     * @author Mazhar Ahmed
     *
     * returns the category
     *
     * @param $id
     * @return array
     */
    private function getCategory ($id)
    {
        foreach ($this->categories as $category)
        {
            if ($category ['id'] == $id)
            {
                return $category;
            }
        }
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
        $parent = $this->getCategory ($category ['parent']);
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
                $this->adminmodel->updatePage ($this->input->post ('id'), [
                    'title' => $this->input->post ('title'),
                    'body' => $this->input->post ('body'),
                    'category' => $this->input->post ('category')
                ]);
                $data ['page_msg'] = 'Successfully edited the page';
            } else {
                // insert the category
                $this->adminmodel->createPage ([
                    'title' => $this->input->post ('title'),
                    'body' => $this->input->post ('body'),
                    'category' => $this->input->post ('category')
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

        foreach ($data ['pages'] as $key => $page)
        {
            $data ['pages'] [$key] ['breadcrumb'] = $this->buildBreadCrumb (
                $this->adminmodel->getCategory($page ['category'])
            );
        }

        // load the view
        $this->load->view('page', $data);
    }

    /**
     * @name delete_page
     * @author Mazhar Ahmed
     *
     * it will delete a page
     *
     * @param bool $id
     */
    public function delete_page ($id = false)
    {
        if (!$id)
        {
            $this->session->set_flashdata ('page_err_msg', 'Nothing to delete');
            redirect ('/admin/pages');
        }

        $this->adminmodel->deletePage ($id);
        $this->session->set_flashdata (
            'page_msg',
            'Successfully deleted the page'
        );
        redirect ('/admin/pages');
    }
}
