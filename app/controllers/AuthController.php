<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function register()
    {
        $this->call->library('auth');
        $data = []; // ✅ Always define $data

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $role = $this->io->post('role') ?? 'user';

            if ($this->auth->register($username, $password, $role)) {
                redirect('auth/login');
            } else {
                $data['error'] = 'Registration failed!';
            }
        }

        $this->call->view('auth/register', $data);
    }

    public function login()
    {
        $this->call->library('auth');
        $data = []; // ✅ Always define $data

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($this->auth->login($username, $password)) {
                $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

                // Redirect based on role
                if ($role === 'admin') {
                    redirect('/users'); // full access
                } else {
                    redirect('auth/dashboard'); // user dashboard
                }
            } else {
                $data['error'] = 'Login failed!';
            }
        }

        $this->call->view('auth/login', $data);
    }

    public function dashboard()
    {
        $this->call->library('auth');

        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }

        $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';

        // Admins go to /users
        if ($role === 'admin') {
            redirect('/users');
        }

        // --- USER DASHBOARD LOGIC ---
        $this->call->model('UsersModel');
        $this->call->library('pagination');

        $page = (int) ($this->io->get('page') ?? 1);
        $q = trim($this->io->get('q') ?? '');

        $records_per_page = 5;
        $all = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Pagination setup
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('default');
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('auth/dashboard') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('auth/dashboard', $data);
    }

    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
?>
