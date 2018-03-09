<div class="content">

<?php echo form_open(uri_string());?>
		<h3>Edit User</h3>
        <div class="alert alert-danger help-block  <?php if( $message==""){ echo 'display-hide'; }?>  ">
			<button class="close" data-close="alert"></button>
			<span>
			<?php echo $message;?> </span>
		</div>
		<p class="hint">
			 Please enter the user's information below.:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">First Name</label>
             <?php echo form_input($first_name);?>
		</div>  
        <div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Last Name</label>
             <?php echo form_input($last_name);?>
		</div>
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Company</label>
			 <?php echo form_input($company);?>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Phone</label>
			 <?php echo form_input($phone);?>
		</div>
		<p class="hint">
			 Enter your account details below:
		</p>
		
		
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			 <?php echo form_input($password);?>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<?php echo form_input($password_confirm);?>
		</div>
        
       

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>
		
		<div class="form-actions">
		<?php 
		if ($this->ion_auth->logged_in())
		{
			?>
            <a href="<?php echo base_url(); ?>" type="button" id="register-back-btn" class="btn btn-default">Back</a>
            <?php
		}
		else
		{
			?>
            <a href="<?php echo base_url('auth/login'); ?>" type="button" id="register-back-btn" class="btn btn-default">Login</a>
            <?php
		}
		?>
			<button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Create User</button>
		</div>
	</form>
    </div>



