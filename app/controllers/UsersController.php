<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: User_Controller
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }
    
    //pakita
    public function index()
    {
        // Current page
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        // Search query
        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        
        $all = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Pagination 
        
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
            site_url() . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/index', $data);
    }
    //pasok
    function create()
    {
        if($this->io->method() == 'post'){
            $fname = $this->io->post('first_name');
            $lname = $this->io->post('last_name');
            $email = $this->io->post('email');
            $data = array(
                'last_name'=> $lname,
                'first_name'=> $fname,
                'email'=> $email
            );
            if($this->UsersModel->insert($data))
            {
                redirect();
            }else{
                echo'Error';
            }
        }else{
        $this->call->view('users/create');}
    }
    //edit
    function update($id)
    {
        $data ['user'] = $this->UsersModel->find($id);
        if($this->io->method() == 'post'){
            $lname = $this->io->post('last_name');
            $fname = $this->io->post('first_name');
            $email = $this->io->post('email');
            $data = array(
                
                'last_name'=> $lname,
                'first_name'=> $fname,
                'email'=> $email
            );
            if($this->UsersModel->update($id,$data))
            {
                redirect();
            }else{
                redirect();
            }
        }
        $this->call->view('/users/update',$data);
    }
    //tanggal
    function delete($id)
    {
        if($this->UsersModel->delete($id))
        {
            redirect();
        }else{
            echo'Error';
        }
    } 
    //semi tanggal
    function soft_delete($id)
    {
        if($this->UsersModel->soft_delete($id))
        {
            redirect();
        }else{
            echo'Error';
        }
    }
    //ibalik
    function restore()
{
    $page = 1;
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = $this->io->get('page');
    }

    $q = '';
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $q = trim($this->io->get('q'));
    }

    $records_per_page = 5;

    // Call a new model function for restore listing
    $all = $this->UsersModel->restore_page($q, $records_per_page, $page);
    $data['users'] = $all['records'];
    $total_rows = $all['total_rows'];

    $this->pagination->set_options([
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ]);
    $this->pagination->set_theme('custom'); // or 'tailwind'
    $this->pagination->initialize($total_rows, $records_per_page, $page, 'user/restore?q='.$q);
    $data['page'] = $this->pagination->paginate();

    $this->call->view('restore', $data);
}

    function retrieve($id)
    {
        if($this->UsersModel->restore($id))
        {
            redirect();
        }else{
            echo'Error';
        }
    }
}
