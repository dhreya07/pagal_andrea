<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
         $this->call->model('UsersModel');

         // Check if user is logged in
         if (!isset($_SESSION['user'])) {
             redirect('/auth/login');
             exit;
         }

         // Get logged-in user info
         $logged_in_user = $_SESSION['user']; 
         $data['logged_in_user'] = $logged_in_user;

         // Redirect regular users to user page
         if ($logged_in_user['role'] !== 'admin') {
             redirect('/users/user-page');
             exit;
         }


        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $user['records'];
        $total_rows = $user['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav'    => 'flex justify-center mt-6 flex-wrap',
            'ul'     => 'flex flex-wrap justify-center gap-2',
            'li'     => 'list-none',
            'a'      => 'px-3 py-1 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-blue-500 hover:text-white transition',
            'active' => 'bg-blue-600 text-white font-bold border-blue-600'
        ]);



        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('users/index', $data);
    }

    function create()
    {
        if($this->io->method()==='post')
        {
           $username = $this->io->post('username');
           $email = $this->io->post('email');
           $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
           $role = $this->io->post('role');

           // Validate username uniqueness
           if (!$this->UsersModel->is_username_unique($username)) {
               $data['error'] = 'Username already exists. Please choose a different username.';
               $this->call->view('users/create', $data);
               return;
           }

           $data = [
               'username' => $username,
               'email' => $email,
               'password' => $password,
               'role' => $role,
               'created_at' => date('Y-m-d H:i:s')
           ];

           if($this->UsersModel->insert($data))
            {
              redirect('/users');
            } else 
            {
                $data['error'] = 'Error creating user';
                $this->call->view('users/create', $data);
            }
        }
         else
        {
           $this->call->view('users/create');
        }
    }

    
     public function update($id)
{
    $this->call->model('UsersModel');

    // Get logged-in user from session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $logged_in_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    // Fetch the user to be edited
    $user = $this->UsersModel->get_user_by_id($id);
    if (!$user) {
        echo "User not found.";
        return;
    }

    if ($this->io->method() === 'post') {
        $username = $this->io->post('username');
        $email = $this->io->post('email');
        $role = $this->io->post('role');

        // Validate username uniqueness
        if (!$this->UsersModel->is_username_unique($username, $id)) {
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $data['error'] = 'Username already exists. Please choose a different username.';
            $this->call->view('users/update', $data);
            return;
        }

        // Prepare data for update - no password changes allowed
        $data = [
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];

        if ($this->UsersModel->update($id, $data)) {
            redirect('/users');
        } else {
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $data['error'] = 'Failed to update user.';
            $this->call->view('users/update', $data);
        }
    } else {
        // Pass both the user being edited and the logged-in user to the view
        $data['user'] = $user;
        $data['logged_in_user'] = $logged_in_user;
        $this->call->view('users/update', $data);
    }
}

   function delete($id)
   {
    if($this->UsersModel->delete($id))
    {
        redirect('/users');
    }
    else{
        echo "Error deleting";
    }
   }
   
   public function register()
    {
        $this->call->model('UsersModel'); // load model

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);

            // Validate username uniqueness
            if (!$this->UsersModel->is_username_unique($username)) {
                $data['error'] = 'Username already exists. Please choose a different username.';
                $this->call->view('/auth/register', $data);
                return;
            }

            $data = [
                'username' => $username,
                'email'    => $this->io->post('email'),
                'password' => $password,
                'role'     => $this->io->post('role'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            } else {
                $data['error'] = 'Error creating account. Please try again.';
                $this->call->view('/auth/register', $data);
            }
        } else {
            $this->call->view('/auth/register');
        }
    }


        public function login()
        {
            $this->call->library('auth');

            $error = null; // prepare error variable

            if ($this->io->method() == 'post') {
                $username = $this->io->post('username');
                $password = $this->io->post('password');

                // Use the Auth library's login method which handles both user lookup and password verification
                if ($this->auth->login($username, $password)) {
                    // Get user data from the Auth library's session data
                    $user_data = $this->auth->userdata();
                    
                    // Set additional session data for compatibility
                    $_SESSION['user'] = $user_data;

                    if ($user_data['role'] == 'admin') {
                        redirect('/users');
                    } else {
                        redirect('/users/user-page');
                    }
                } else {
                    $error = "Incorrect username or password!";
                }
            }

            // Pass error to view
            $this->call->view('auth/login', ['error' => $error]);
        }



    public function dashboard()
    {
        $this->call->model('UsersModel');
        $data['user'] = $this->UsersModel->get_all_users(); // fetch all users

        $this->call->model('UsersModel');

        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $user['records'];
        $total_rows = $user['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/dashboard', $data);
    }


    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }

    public function user_page()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
            exit;
        }

        // Get logged-in user from session
        $logged_in_user = $_SESSION['user'];
        $data['logged_in_user'] = $logged_in_user;

        $this->call->view('users/user_page', $data);
    }

}