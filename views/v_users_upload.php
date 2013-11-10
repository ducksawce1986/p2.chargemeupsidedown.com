<form role="form" method='POST' enctype="multipart/form-data" action='/users/profile_update/'>
                <img src="/uploads/avatars/<?= $user->image ?>" alt="<?=$user->first_name . ' ' . $user->last_name ?>">                    
                    <div class="form-group">
                            <label for="exampleInputFile">Your Profile Image</label>
                            <input type="file" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-custom">Update Your Profile Image</button>
        </form>
        <br>

<p>You've been a member of Charge Me UP since <?= date('F j, Y', $user->created) ?> </p>