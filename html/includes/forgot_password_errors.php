<?php  if (count($forgot_password_errors) > 0 ) : ?>
  <div class="forgot_password_error">
  	<?php foreach ($forgot_password_errors as $forgot_password_error) : ?>
  	  <p><?php echo $forgot_password_error ?></p>
  	<?php endforeach ?>
  	</div>
<?php  endif ?>