<?php
class users_controller extends base_controller {

/*----------------------------------------------
----------------------------------------------*/

    public function __construct() {

        # Base controller construct called
        parent::__construct();
    } 

    /*-----------------------------
    Form display for user sign up
    -----------------------------*/


    public function signup() {

        # Set up the view
        $this->template->content = View::instance('v_users_signup');

        # Render the view
        echo $this->template;
    }

    public function p_signup() {

        $_POST['created'] = Time::now();
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        echo "<pre>";
        print_r($_POST);
        echo "<pre>";

        DB::instance(DB_NAME)->insert_row('users', $_POST);

        # Send them to the login page
        Router::redirect('/users/login');
    }

    public function login() {
        $this->template->content = View::instance('v_users_login');
        echo $this->template;
    }

    public function p_login() {

        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q =
            'SELECT token
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';

            //echo $q;

        $token = DB::instance(DB_NAME)->select_field($q);

        # Success
        if(token) {
            setcookie('token', $token, strtotime('+1 year'), '/');
            echo "You are logged in!";
        }
        # Fail
        else {
            echo "Login failed!";
        }

    }

    public function logout() {
        
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array('token' => $new_token);

        DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);

        setcookie('token', '', strtotime('-1 year'), '/');

        Router::redirect('/');

    }



    public function profile($user_name = NULL) {

        if(!$this->user) {

            //Router::redirect('/');
            die('Members only. <a href="/users/login">Login</a>');
        }

        # Set up the View
        $this->template->content = View::instance('v_users_profile');
        
        # Set page title
        $this->template->title = "Profile";

        # Load client files
        $client_files_head = Array(
            '/css/profile.css',
            '/css/master.css'
            );

        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        $client_files_body = Array(
            '/js/profile.js'
            );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Pass the data to the View
        $this->template->content->user_name = $user_name;

        # Display the View
        echo $this->template;

        //$view = View::instance('v_users_profile');
        //$view->user_name = $user_name;
        //echo $view;

    }

} # end of the class