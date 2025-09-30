<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    public function index()
    {
        // All users can view the student list
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

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
            site_url('/users') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }


    function create(){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        if ($this->io->method() == 'post') {
            $firstname= $this->io->post('first_name');
            $lastname= $this->io->post('last_name');
            $email= $this->io->post('email');

            $data = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email
            );

            if ($this->UsersModel->insert($data)) {
                redirect(site_url('/users'));
            } else {
                echo 'Error creating student.';
            }
        } else {
            $this->call->view('users/create');
        }
    }

    function update($id){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        $user = $this->UsersModel->find($id);
        if(!$user) {
            echo "Student not found.";
            return;
        }

        if ($this->io->method() == 'post') {
            $firstname= $this->io->post('first_name');
            $lastname= $this->io->post('last_name');
            $email= $this->io->post('email');

            $data = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email
            );

            if ($this->UsersModel->update($id, $data)) {
                redirect(site_url('/users'));
            } else {
                echo 'Error updating student.';
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }
    
    function delete($id){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        if($this->UsersModel->delete($id)){
            redirect(site_url('/users'));
        } else {
            echo 'Error deleting student.';
        }
    }
}
