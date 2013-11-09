<?php

class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        if(!$this->user) {
            Router::redirect("/users/login");
        }
    }





/*-------------------------
    Post Add
-------------------------*/

    public function add() {

    # Setup View
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "Speak Your Mind";

    # Render Template
        echo $this->template;
    }





/*---------------------------
    Post Add Processing
---------------------------*/

    public function p_add() {

    # Associate This Post With This User
        $_POST['user_id']  = $this->user->user_id;

    # Time Stamp of Post Creation and Modification
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        DB::instance(DB_NAME)->insert('posts', $_POST);

    # Route User Back To Their Profile Page
        Router::redirect('/users/profile'); 
    }





/*--------------------------------------------
    Post Delete 
--------------------------------------------*/

    public function confirm_delete($post_id) {
        
    # Set Up View
        $this->template->content = View::instance('v_posts_delete');
        $this->template->title   = "Confirm delete?";
        $this->template->content->post_id = $post_id;

    # Render template
        echo $this->template;
    }





/*--------------------------------------
    Delete Post Processing
--------------------------------------*/

    public function p_delete($post_id) {

        $data = "WHERE post_id = ".$post_id; 
        DB::instance(DB_NAME)->delete('posts',$data);

    # Route User To Their Profile Page
        Router::redirect('/users/profile'); 
    }





/*---------------------------
    Index
---------------------------*/

    public function index() {
    
    # Set Up View
        $this->template->content = View::instance('v_posts_index');
        $this->template->title   = "Your Posts";
        
    # Build Query
        $q = 'SELECT
                posts.content,
                posts.created,
                posts.post_id,
                posts.user_id AS post_user_id,
                users_users.user_id AS follower_id,
                users.user_id,
                users.first_name,
                users.last_name
              FROM posts 
              INNER JOIN users_users
              ON posts.user_id = users_users.user_id_followed
              INNER JOIN users
              ON posts.user_id = users.user_id
              WHERE users_users.user_id = '.$this->user->user_id . ' 
              ORDER BY posts.created DESC' ;
        
    # Run Query
        $posts = DB::instance(DB_NAME)->select_rows($q);
        
    # Pass Data To View
        $this->template->content->posts = $posts;
        
    # Render View
        echo $this->template;
    }





/*---------------------------
    Users
---------------------------*/

    public function users() {

    # Set Up View
        $this->template->content = View::instance("v_posts_users");
        $this->template->title   = "Users To Follow";

    # Build Query To Find Users Other Than Self
        $q = "SELECT *
            FROM users
            WHERE user_id !=".$this->user->user_id;

    # Execute Query To Find Users, And Store In $Users
        $users = DB::instance(DB_NAME)->select_rows($q);

    # Build Query To Find Who User Follows
        $q = "SELECT * 
            FROM users_users
            WHERE user_id = ".$this->user->user_id;

        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    #Pass Data To View
        $this->template->content->users       = $users;
        $this->template->content->connections = $connections;

    # Render View
        echo $this->template;
    }





/*---------------------------------------------
    Follow
---------------------------------------------*/

    public function follow($user_id_followed) {

    # Prepare Data For Insertion
        $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
            );

    # Insert
        DB::instance(DB_NAME)->insert('users_users', $data);

    # Redirect User 
        Router::redirect("/posts/users");
    }

/*-----------------------------------------------
    Unfollow
-----------------------------------------------*/

    public function unfollow($user_id_followed) {

    # Delete Connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

    #Redirect User
        Router::redirect("/posts/users");
    }





/*------------------------------------------------
        Like
------------------------------------------------*/
    
    public function like ($post_id, $currentUser){
                
            # Update Database Table With "Likes"
                $like = Array("`like`" => "Y"); 
                DB::instance(DB_NAME)->update("posts", $like, "WHERE post_id =".$post_id);
                
            # Update Posts Table With Likes
                $user = Array("who_likes" => $currentUser);
                DB::instance(DB_NAME)->update("posts", $user, "WHERE post_id =".$post_id);
                
            # Route User
                Router::redirect("/users/profile/");
        }





/*----------------------------------
    Edit
----------------------------------*/

    public function edit($edited)  {
        # Set Up View
            $this->template->content = View::instance('v_posts_edit');
                    
        # Build Query
            $q = "SELECT *
                FROM posts 
                WHERE user_id = ".$this->user->user_id. " AND 
                post_id = ".$edited;

        # Execute Query And Store In Variable
            $_POST["editable"] = DB::instance(DB_NAME)->select_row($q);

        # Pass Data To View
            $this->template->content->post = $_POST['editable'];
            
        # Render Template
            echo $this->template;           
    }
    
/*--------------------------------
    Edit Processing
--------------------------------*/    
    public function p_edit($id)  {
    
        # Set Up View
            $this->template->content = View::instance('v_posts_p_edit');
                   
            $_POST['modified'] = Time::now();
            
            # Associate Post With This User
                $_POST['user_id']  = $this->user->user_id;  
                
            # Protect Against XXS
                $_POST["content"] = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');        
                $_POST["content"] = strip_tags($_POST["content"]);
         
            # Set Up Where Condition To Update Post    
                $where_condition = 'WHERE post_id = '.$id;   
                $updated_post = DB::instance(DB_NAME)->update('posts', $_POST, $where_condition);

            # Route User To Their Profile Page
               Router::redirect('/users/profile');
    }

} # eoc