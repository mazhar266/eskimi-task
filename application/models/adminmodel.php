<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class AdminModel
 * @name Admin
 * @author Mazhar Ahmed
 *
 * this model will handle admin logic
 */
class AdminModel extends CI_Model {
    // user types
    private $types = [];

    /**
     * constructor
     */
    public function __construct ()
    {
        parent::__construct ();
    }

    /**
     * @name hasChildren
     * @author Mazhar Ahmed
     *
     * this function returns true if a category has children
     *
     * @param $id
     * @return bool
     */
    public function hasChildren ($id)
    {
        if ($id < 1)
        {
            return false;
        }

        $this->db->where ('parent', $id);
        $this->db->from ('categories');
        if ($this->db->count_all_results ())
        {
            return true;
        }

        return false;
    }

    /**
     * @name deleteCategory
     * @author Mazhar Ahmed
     *
     * deletes a category by id
     *
     * @param $id
     * @return bool
     */
    public function deleteCategory ($id)
    {
        if ($id < 1)
        {
            return false;
        }

        $this->db->where ('id', $id);
        $this->db->delete ('categories');
        return true;
    }

    /**
     * @name createCategory
     * @author Mazhar Ahmed
     *
     * creates a category and returns the row
     *
     * @param $data
     * @return bool / data
     */
    public function createCategory ($data)
    {
        if (empty ($data))
        {
            return false;
        }

        if ($data ['parent'] == 0)
        {
            $data ['parent'] = NULL;
        }

        $this->db->insert ('categories', $data);
        $data ['id'] = $this->db->insert_id ();
        return $data;
    }

    /**
     * @name updateCategory
     * @author Mazhar Ahmed
     *
     * updates a category by given data using the id
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateCategory ($id, $data)
    {
        if ($id < 1)
        {
            return false;
        }

        if (empty ($data))
        {
            return false;
        }

        if ($data ['parent'] == 0)
        {
            $data ['parent'] = NULL;
        }

        $this->db->set ($data);
        $this->db->where ('id', $id);
        $this->db->update ('categories');
        return true;
    }

    /**
     * @name getAllCategories
     * @author Mazhar Ahmed
     *
     * returns all the active categories
     *
     * @return array
     */
    public function getAllCategories ()
    {
        $this->db->where ('status', 1);
        $res = $this->db->get ('categories');
        $data = [];
        if ($res->num_rows ())
        {
            foreach ($res->result_array () as $row)
            {
                $data [] = $row;
            }
        }

        return $data;
    }

    /**
     * @name getChildren
     * @author Mazhar Ahmed
     *
     * returns the immediate children of category by id
     *
     * @param null $id
     * @return array|bool
     */
    public function getChildren ($id = null)
    {
        if ($id < 0)
        {
            return false;
        }

        if ($id == 0)
        {
            $id = null;
        }

        $this->db->where ('parent', $id);
        $res = $this->db->get ('categories');
        $data = [];
        if ($res->num_rows ())
        {
            foreach ($res->result_array () as $row)
            {
                $data [] = $row;
            }
        }

        return $data;
    }

    /**
     * @name getCategory
     * @author Mazhar Ahmed
     *
     * returns the category by specific id
     *
     * @param $id
     * @return bool | array
     */
    public function getCategory ($id)
    {
        if ($id < 1)
        {
            return false;
        }

        $this->db->where ('id', $id);
        $res = $this->db->get ('categories');
        if ($res->num_rows ())
        {
            return $res->row_array ();
        }

        return false;
    }
}
