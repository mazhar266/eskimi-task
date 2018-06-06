<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class LoginModel
 * @name Login
 * @author Mazhar Ahmed
 *
 * this model will handle the authentication
 */
class LoginModel extends CI_Model {
    // user types
    private $types = [];

    /**
     * Login constructor.
     */
    public function __construct ()
    {
        parent::__construct ();
    }

    /**
     * @name login
     * @author Mazhar Ahmed
     *
     * logs in an user
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public function login ($username, $password)
    {
        $salt = sha1(md5($password)).'k32duem01vZsQ2lB8g0s';
        $where = "(username='$username') and password='$salt' and status=1";
        $this->db->where ($where);
        $users = $this->db->get ('users');
        // ignore if returned more than one or no rows
        if ($users->num_rows() == 1)
        {
            $row = $users->row_array ();
            $this->session->set_userdata ('user', $row);
            return $row;
        }

        return false;
    }

    /**
     * @name isLogged
     * @author Syed Mazhar Ahmed
     *
     * returns if anyone is logged in
     *
     * @return bool or user_id
     */
    public function isLogged ()
    {
        if ($this->session->userdata ('user') ['id'])
        {
            return $this->session->userdata ('user');
        }

        return false;
    }

    /**
     * @name logout
     * @author Mazhar Ahmed
     *
     * logs out the user
     *
     * @return bool
     */
    public function logout ()
    {
        $this->session->unset_userdata ('user');
        return true;
    }
}
