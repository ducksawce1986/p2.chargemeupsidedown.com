<?php

class users_controller extends base_controller {

/*------------------------------------------------------------------------
------------------------------------------------------------------------*/

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

    /*--------------------------
    Processing sign up form
    --------------------------*/

    public function p_signup() {

        # Mark the time
        $_POST['created'] = Time::now();

        # Hash the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Create a hashed token
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Insert the new user
        DB::instance(DB_NAME)->insert_row('users', $_POST);

        # Send them to the login page
        Router::redirect('/users/login');
    }

    /*-------------------------
    Display form for user login
    -------------------------*/

    public function login() {
        $this->template->content = View::instance('v_users_login');
        echo $this->template;
    }

    /*-------------------------
    Process login form
    -------------------------*/

    public function p_login() {

        # Has password entered by user to compare to database
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Set up query to see if there's matching email/password in DB
        $q =
            'SELECT token
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';

        echo $q;

        # If there is match, return a token
        $token = DB::instance(DB_NAME)->select_field($q);

        # Success
        if(token) {

            # Don't echo anything to page before setting this cookie
            setcookie('token', $token, strtotime('+1 year'), '/');

            # Send them to homepage
            Router::redirect('/');
        }
        
        # Fail
        else {

            # Send them back to login page
            echo "Login failed! <a href='/users/login'>Try again?!</a>";
        }
    }

    /*---------------------------------------------
    No view needed here. Logout link (users/logout)
    takes user back to homepage.
    ---------------------------------------------*/

    public function logout() {

        # Generate a new token they'll use next time they log in
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Update their row in the DB with new token
        $data = Array('token' => $new_token);

        DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);

        # Delete old token cookie by expiring it
        setcookie('token', '', strtotime('-1 year'), '/');

        # Send them back to homepage
        Router::redirect('/');
}

    /*------------------------------------------
    ------------------------------------------*/

    public function profile($user_name = NULL) {

        # Only logged in users are allowed
        if(!$this->user) {
            
            //Router::redirect('/');
            die('Members only. <a href="/users/login">Login</a>');
        }

        # Set up the View
        $this->template->content = View::instance('v_users_profile');
        $this->template->title = "Profile";
        
        # Pass the data to the view
        $this->template->content->user_name = $user_name;

        # Display the view
        echo $this->template;
    }

} # end of the class