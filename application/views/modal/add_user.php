
<!-- Modal -->
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="small">First name</label>
                    <input type="text" name="fname" class="form-control" value="<?=!empty($user['fname']) ? $user['fname'] : '' ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="small">Last name</label>
                    <input type="text" name="lname" class="form-control" value="<?=!empty($user['lname']) ? $user['lname'] : '' ?>" required> 
                </div>            
            </div>    
            <div class="form-group m-0">
                <label class="small">Email</label>
                <input type="email" name="email" class="form-control" value="<?=!empty($user['email']) ? $user['email'] : ''?>" required> 
            </div>              
            <div class="form-group m-0">
                <label class="small">Contact No.</label>
                <input type="text" name="contactno" class="form-control" value="<?=!empty($user['contactno']) ? $user['contactno'] : ''?>"> 
            </div>  
            <hr/>
            <div class="form-group m-0">
                <label class="small">Role</label>
                <select name="role" class="form-control" required>
                    <?php
                        foreach($roles as $role) {
                        ?>
                        <option value="<?=$role['id']?>" <?=!empty($user['role'])  && $user['role'] == $role['id'] ? 'selected' : ''?>><?=$role['description']?></option>
                        <?php
                        }
                    ?>
                </select>
            </div> 
            <div class="row">
                <div class="form-group m-0 col-md-6">
                    <label class="small">Username</label>
                    <input type="text" name="username" class="form-control" value="<?=!empty($user['username']) ? $user['username'] : ''?>" required> 
                </div>   
                <div class="form-group m-0 col-md-6">
                    <label class="small">Password</label>
                    <input type="password" name="password" class="form-control" value="<?=!empty($user['password']) ? str_replace($user['salt'], '', $user['password']) : ''?>" required> 
                </div>     
            </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Save changes"/>
      </div>
      </form>
    </div>
  </div>
</div>
