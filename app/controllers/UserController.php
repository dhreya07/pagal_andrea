class UserController extends Controller {

    public function_construct()
    {
        parent::function_construct();
    }
    public function index(): void 
    {
        $this->call->model('UsersModel');
        $data['users']=$this->UserModel->all();
        $this->call->view('users/index',$data);
    }

    function create():void
    {
        if($this->io->method()=='post')
            {
                $username = $this->io->post('username');
                $email = $this->io->post('email');

                $data=array('username' => $username, 'email' => $email);
                if($this->UserModel->insert($data))
                    {
                        redirect();
                    }else
                    {
                        echo "error";
                    }
            }
            else
                {
                    $this->call->view('users/create')
                }
    }
}

     function update($id): void
     {
       $user =$this-> usersModel -> find($id);
       if(|$user)
       {
          echo "User not found";
          return;
       }
       if($this->io->method()=='post')
        {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data=array('username' => $username, 'email => $email');

            if($this->UsersModel->update($id,$data))
                {
                    redirect();
                }
                else{
                    echo "error updating";
                }
        }
        else
            {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
     }