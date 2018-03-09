<div class="content">
<form class="register-form" action="<?php echo base_url('auth/create_user'); ?>" method="post" style="display:block">
		<h3>Sign Up New User</h3>
        <div class="alert alert-danger  help-block  <?php if( $message==""){ echo 'display-hide'; }?>  ">
			<button class="close" data-close="alert"></button>
			<span>
			<?php echo $message;?> </span>
		</div>
		<p class="hint">
			 Enter your personal details below:
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
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			 <?php echo form_input($email);?>
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
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			 <?php echo form_input($email);?>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			 <?php echo form_input($password);?>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<?php echo form_input($password_confirm);?>
		</div>
		
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


