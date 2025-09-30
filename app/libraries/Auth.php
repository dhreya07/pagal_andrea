<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Library: Auth
 * 
 * Automatically generated via CLI.
 */
class Auth {
  protected $_lava;

    public function __construct()
    {
        // Library initialized
        $this->_lava = lava_instance();
        $this->_lava->call->database();
        $this->_lava->call->library('session');
    }
    /*
     * Register a new user
     *
     * @param string $username
     * @param string $password
     * @param string $role
     * @return bool
     */
    public function register($username, $email, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $this->_lava->db->table('students')->insert([
            'username' => $username,
            'email'    => $email,
            'password' => $hash,
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /*
     * Login user
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        $user = $this->_lava->db->table('users')
                         ->where('username', $username)
                         ->get();

        if ($user && password_verify($password, $user['password'])) {
            $this->_lava->session->set_userdata([
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            return true;
        }

        return false;
    }

    /*
     * Check if user is logged in
     *
     * @return bool
     */
    public function is_logged_in()
    {
        return (bool) $this->_lava->session->userdata('logged_in');
    }

    /*
     * Check user role
     *
     * @param string $role
     * @return bool
     */
    public function has_role($role)
    {
        return $this->_lava->session->userdata('role') === $role;
    }

    /*
     * Get user data from session
     *
     * @return array
     */
    public function userdata()
    {
        return $this->_lava->session->userdata();
    }

    /*
     * Logout user
     *
     * @return void
     */
    public function logout()
    {
        $this->_lava->session->unset_userdata(['id','username','email','role','logged_in']);
    }
}