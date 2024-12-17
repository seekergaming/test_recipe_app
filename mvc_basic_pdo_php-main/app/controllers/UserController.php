<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
         // Fetch all users from the database
         $users = $this->user->all();

         // Pass the data to the 'users/index' view
         $this->view('users/index', compact('users'));
    }

    public function create()
    {
        $this->view('users/create');
    }

    public function store()
    {
        $this->user->create($_POST);
        header('Location: /');
    }

    public function edit($id)
    {
        // Fetch the user data using the ID
        $user = $this->user->find($id);

        // Pass the user data to the 'users/edit' view
        $this->view('users/edit', compact('user'));
    }

    public function update($id)
    {
        $this->user->update($id, $_POST);
        header('Location: /');
    }

    public function delete($id)
    {
        $this->user->delete($id);
        header('Location: /');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->user->checkLogin($_POST);
    
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: /');
            } else {
                $error = "Invalid email or password.";
                $this->view('users/login', compact('error'));
            }
        } else {
            $this->view('users/login');
        }
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
    }
    
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->register($_POST);
            header('Location: /login');
        } else {
            $this->view('users/register');
        }
    }

    public function loanApplicationForm(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_merge($_POST, $_FILES);
            $this->user->loan($data);
            header('Location: /');
        }else
        $this->view('users/loan');
    }
    
}
