
<div class="content">
<form class="forget-form" action="<?php echo base_url(); ?>auth/forgot_password" method="post" style="display:block !important">
		<h3>Forget Password ?</h3>
		<div class="alert alert-danger  <?php if( $message==""){ echo 'display-hide'; }?> ">
			<button class="close" data-close="alert"></button>
			<span>
			<?php echo $message;?> </span>
		</div>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			
            <?php echo form_input($identity);?>
            <span class="help-block"></span>
		</div>
		<div class="form-actions">
			<a type="button" id="back-btn" class="btn btn-default" href="<?php echo base_url(); ?>auth/login">Login</a>
			<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
		</div>
	</form>
    </div>

