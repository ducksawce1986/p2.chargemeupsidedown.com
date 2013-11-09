<?php

class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }



/*-----------------------------
    Signup
-----------------------------*/

    public function signup() {
        
    # Setup View
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up Landing";
        
    # Render View
        echo $this->template;
    }



/*------------------------------
    Signup Processing
------------------------------*/

    public function p_signup() {
        
    # Sanitize Data Against SQL Injection Attacks
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

    # Insert Time Stamp For Creation / Modification Of User Posts
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
        
    # Password Encryption
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);    

    # Create Token From Email And Random String

        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

    # Insert User Into Database
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);
        
        $to[] = Array("name" => $_POST['first_name'], "email" => $_POST['email']);
                                
            # Build Array Of Email Submissions On Site
                $from = Array("name" => APP_NAME, "email" => APP_EMAIL);

            # Subject Line
                $subject = "Welcome to Charge Me UP!";

            # Body
                $body = "Welcome to Charge Me UP! You have free reign to do what you want now!
                ";

            # Build Pairs of Names / Emails For CC And BCC Purposes
                $cc  = "";
                $bcc = "";

            # Send Email
                $email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

    # Send User To Special Signup Success Page
        $this->template->content = View::instance('v_users_success');
        $this->template->title   = "Hey Hey!!";
        echo $this->template;
    }



/*----------------------------------------
    Logout
----------------------------------------*/

    public function login($error = NULL) {
    # Setup View
        $this->template->content = View::instance('v_users_login');
        
    # Pass data to the view
        $this->template->content->error = $error;
        $this->template->title   = "Login Page";

    # Render template
        echo $this->template;
    }



/*-----------------------------
    Login Processing
-----------------------------*/

    public function p_login() {
    
    # Sanitize User Data Against SQL Injection Attack
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
    
    # Hash User Submitted Password Against That In Database
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
    
    # Search Database For Email and Password / Create Token
        $q = "SELECT token 
                FROM users 
                WHERE email = '".$_POST['email']."' 
                AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

    # If No Match In Databse, Login
        if(!$token) {

        # Route User Back To Login Page
            Router::redirect("/users/login/error");

    # If Login Succeeded
        } else {

        # New Cookie Made
            setcookie("token", $token, strtotime('+1 year'), '/');

        # Send User To Their Profile Page
            Router::redirect("/users/profile");
        }
    }



/*----------------------------
    Logout
----------------------------*/


    public function logout() {

    # Generate Token For Next Login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
        
    # Create Array For New Token
        $data = Array("token" => $new_token);

    # Update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    # Place Duration Limit Of Cookie Effectiveness
        setcookie("token", "", strtotime('-1 year'), '/');

    # Route User To Main Index
        Router::redirect("/");
    }



/*----------------------------------------------
    Profile Creation
----------------------------------------------*/

    public function profile($user_name = NULL) {

        if(!$this->user) {

        # If Not User, Route Them To Login Page
            Router::redirect('/users/login');
        }
    # Set Up View  
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = $this->user->first_name." ".$this->user->last_name;

    # Make Array Of Client Files To Place In Document Head
        $client_files_head = Array(
            '/css/widgets.css',
            '/css/profile.css'
            );

    # Generate Links From Array
        $this->template->client_files_head = Utils::load_client_files($client_files_head); 

    # Make Array of Client Files To Place In Document Body
        $client_files_body = Array(
            '/js/widgets.min.js',
            '/js/profile.min.js'
            );

    # Generate Links From Array
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 
        
    # Buile Query To Insert Users' Posts On Their Profile Page
        $q = 'SELECT 
                posts.content, 
                posts.created,
                posts.user_id,  
                posts.post_id
            FROM posts
            WHERE posts.user_id ='.$this->user->user_id . ' 
            ORDER BY posts.created DESC' ;

        $posts = DB::instance(DB_NAME)->select_rows($q);
    # Pass Data To View
        $this->template->content->posts = $posts;

    # Pass Info To User Fragment
        $this->template->content->user_name = $user_name;
        
    # Render View
        echo $this->template;
    }



/*------------------------------------
    Add Profile Photo
------------------------------------*/

    public function profile_update() {
        
    # If User Has File To Upload
        if ($_FILES['avatar']['error'] == 0) {
        
        # Upload Photo
            $image = Upload::upload($_FILES, "/uploads/avatars/", array("JPG", "JPEG", "jpg", "jpeg", "gif", "GIF", "png", "PNG"), $this->user->user_id);

            if($image == 'Invalid file type.') {
            
            # Error Return
                Router::redirect("/users/profile/error"); 
            }
            else {
            
            # Upload Processing
                $data = Array("image" => $image);
                DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);

            # Image Resizing
                $imgObj = new Image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $image);
                $imgObj->resize(100,100, "crop");
                $imgObj->save_image($_SERVER["DOCUMENT_ROOT"] . '/uploads/avatars/' . $image); 
            }
        }

        else{
        
        # Error Return
            Router::redirect("/users/profile/error");  
        }

    # Route To User's Profile Page
        router::redirect('/users/profile'); 
    }  



    /*------------------------
        Avatar Creation
    ------------------------*/

    public function upload() {

    # Setup View
        $this->template->content = View::instance('v_users_upload');
        $this->template->title   = "Your Profile Page";

    # Render Template
        echo $this->template;
   }



   /*--------------------------
        Avatar Processing
   --------------------------*/

   public function p_upload() {

    # Save Image And Update Row In Database
        $image = Upload::upload($_FILES, "/uploads/profile/", array("jpg", "JPG", "jpeg", "JPEG","gif", "GIF","png", "PNG"), $this->user->user_id);

        $imageFileName = dirname(__FILE__).'/../uploads/profile/'.$image;

        $data=array("image"=>$image);
        $dbInstance = DB::instance(DB_NAME);
        $rows = $dbInstance->update("users", $data, "WHERE user_id = ".$this->user->user_id);

    # Send User To Their Profile Page
        Router::redirect("/users/profile");
    }

} # eoc