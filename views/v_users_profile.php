<html>

    <?php if($user): ?> 
        
        <h1><?=$user->first_name?>'s Profile</h1>

    <p>You've been a member of Charge Me UP since <?= date('F j, Y', $user->created) ?> </p><br>

    <p>Your comments</p>

    <!-- User's Posts Appearing Below -->
    <div id="infobox_posts">
        
        <?php foreach($posts as $post): ?>
        
            <article>
            
            <!-- Time Display -->
                <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
            
                    <?=Time::display($post['created'])?>
            
                </time>
            
                <!-- Post Display -->
                <div id="posts">
                
                    <p><?=$post['content']?></p>            
                
                </div>
            
                <!-- Delete Option -->
                <?php if($post['user_id'] == $user->user_id): ?>
                
                    <div id="delete_option">          
                
                        <a href='/posts/confirm_delete/<?=$post['post_id']?>'>Delete</a>
                
                    </div>
                
                <?php endif; ?><br>
            
            </article>
        
        <?php endforeach; ?>
    
    </div>

    <?php else: ?>
    
        <h1>No user specified</h1>

    <?php endif; ?> 

    <br><a href='/'><img src="http://www.elamjung.com/image/from%20the%20stage%20%20Katmanu,%20Nepal.jpg" alt="Stage Left"></a>

</html>