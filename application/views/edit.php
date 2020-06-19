<?php include __DIR__."/header.php" ?>
<div class="container">
<div class="jumbotron ">
  <h1 class="display-4">Edit Account</h1>
  <p class="lead">Here is the account edit form</p>
  <hr class="my-4">
  <form method="post"action='<?=base_url() ?>edit/me/post'>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">name</label>
    <div class="col-sm-10">
      <input type="text" value='<?= $my_info["name"]?>' name="name">
      <span class="text-danger"><?= isset($errors) &&isset($errors['name'])?$errors['name']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">email</label>
    <div class="col-sm-10">
      <input type="text" name="email" id="email" value=<?= $my_info['email'] ?>> 
      <span class="text-danger"><?= isset($errors) &&isset($errors['email'])?$errors['email']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="number" class="col-sm-2 col-form-label">number</label>
    <div class="col-sm-10">
      <input type="text" name="number" id="number" value=<?= $my_info['number'] ?>>
      <span class="text-danger"><?= isset($errors) &&isset($errors['number'])?$errors['number']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">password</label>
    <div class="col-sm-10">
      <input type="text" name="password" id="password" value=<?= $my_info['password'] ?>>
      <span class="text-danger"><?= isset($errors) &&isset($errors['password'])?$errors['password']:""?></span>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-2"></div>
  <div class="col-sm-10 text-center">
      <button class="btn btn-block btn-success">edit</button>
    </div>
  </div>
</form>
</div>
 </div>
<?php include __DIR__."/footer.php" ?>
