<?php if($user): ?> 
    <h1><?=$user->first_name?>'s Profile</h1><br>

    <div id="infobox_avatar">
<!-- Display user's avatar if uploaded -->
    <img class="avatar" src="/uploads/avatars/<?= $user->image ?>" alt="<?=$user->first_name . ' ' . $user->last_name ?>">
<!-- Display Form For Uploading -->
        <?php if ($user->image  == 'placeholder.jpg'): ?>
            <div id="avatar_update_form">
                <p>Would you like to upload your own photo?</p> 
            <!-- Uploading Photo -->
                <form role="form" method='POST' enctype="multipart/form-data" action='/users/profile_update/'>
                    <div>
                        <input type="file" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-custom">Update Your Profile Image</button>
                </form> 
            </div>
        <?php endif; ?>
    </div>


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
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <h1>No user specified</h1>
<?php endif; ?> 