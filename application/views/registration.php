<?php include "header.php"?>
<div class="form-v4">
<div class="page-content">
		<div class="form-v4-content">
      <?php echo validation_errors("<span class='text-white'>","</span>") ?>
			<div class="form-left">
				<h2>INFOMATION</h2>
				<p class="text-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et molestie ac feugiat sed. Diam volutpat commodo.</p>
				<p class="text-2"><span>Eu ultrices:</span> Vitae auctor eu augue ut. Malesuada nunc vel risus commodo viverra. Praesent elementum facilisis leo vel.</p>
				<div class="form-left-last">
          <a href='<?=base_url() ?>login' class="btn btn-primary">Have An Account</a>
				</div>
			</div>
			<form class="form-detail" action='<?=base_url() ?>registration' method="post" id="myform">
				<h2>REGISTER FORM</h2>
				<div class="form-group">
					<div class="form-row">
						<label for="name"> Name</label>
            <input type="text" name="name" id="name" class="input-text" value=<?= !empty($old)?$old['name']:"" ?>>
            <span class="text-danger"><?= isset($errors) && isset($errors['name'])? $errors['name']:"" ?></span>
					</div>
					
				</div>
				<div class="form-row">
					<label for="your_email">Your Email</label>
          <input type="text" name="email" id="your_email" class="input-text" value=<?= !empty($old)?$old['email']:"" ?>>
          <span class="text-danger"><?= isset($errors) && isset($errors['email'])? $errors['email']:"" ?></span>
				</div>
				<div class="form-row">
					<label for="your_number">Your Number</label>
          <input type="text" name="number" id="your_number" class="input-text" value=<?= !empty($old)?$old['number']:"" ?>>
          <span class="text-danger"><?= isset($errors) && isset($errors['number'])? $errors['number']:"" ?></span>
				</div>
				<div class="form-group">
					<div class="form-row">
						<label for="password">Password</label>
            <input type="password" name="password" id="password" class="input-text" value=<?= !empty($old)?$old['password']:"" ?>>
            <span class="text-danger"><?= isset($errors) && isset($errors['password'])? $errors['password']:"" ?></span>
					</div>
				</div>
				<div class="form-checkbox">
					<label class="container"><p>I agree to the <a href="#" class="text">Terms and Conditions</a></p>
					  	<input type="checkbox">
					  	<span class="checkmark"></span>
					</label>
				</div>
				<div class="form-row-last">
					<input type="submit" class="register">
				</div>
			</form>
		</div>
	</div>
</div>
<?php include "footer.php"?>