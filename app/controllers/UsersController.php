<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->library('auth');

        // Redirect non-logged-in users
        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }

        // Only admin can access this controller
        $role = session('role') ?? 'user';
        if ($role !== 'admin') {
            redirect('auth/dashboard');
        }
    }

    public function index()
    {
        $page = (int) ($this->io->get('page') ?? 1);
        $q = trim($this->io->get('q') ?? '');
        $records_per_page = 5;

        $all = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->call->library('pagination');
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
            site_url('/users') . '?q=' . urlencode($q)
        );

        $data['page'] = $this->pagination->paginate();
        $this->call->view('users/index', $data);
    }

    public function create()
    {
        if ($this->io->method() == 'post') {
            $data = [
                'first_name' => $this->io->post('first_name'),
                'last_name'  => $this->io->post('last_name'),
                'email'      => $this->io->post('email')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/users');
            } else {
                $data['error'] = 'Error creating user.';
                $this->call->view('users/create', $data);
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $user = $this->UsersModel->find($id);
        if (!$user) {
            redirect('/users'); // user not found
            return;
        }

        if ($this->io->method() == 'post') {
            $data = [
                'first_name' => $this->io->post('first_name'),
                'last_name'  => $this->io->post('last_name'),
                'email'      => $this->io->post('email')
            ];

            if ($this->UsersModel->update($id, $data)) {
                redirect('/users');
            } else {
                $data['error'] = 'Error updating user.';
                $data['user'] = $user;
                $this->call->view('users/update', $data);
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        if ($this->UsersModel->delete($id)) {
            redirect('/users');
        } else {
            echo 'Error deleting user.';
        }
    }
}
?>