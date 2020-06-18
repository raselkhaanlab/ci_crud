<?php include __DIR__."/../header.php"?>
 <div class="container">
<div class="jumbotron">
  <h1 class="display-4">Add author</h1>
  <p class="lead">Here is the author adding</p>
  <hr class="my-4">
  <form method="post" action="/author/post_add">
  <input type="hidden" name="id" >
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">name</label>
    <div class="col-sm-10">
      <input type="text"  name="name" class="form-control" id="name" value=<?= !empty($old)?$old['name']:"" ?> >
       <span class="text-danger"><?= isset($errors) &&isset($errors['name'])?$errors['name']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">email</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" id="email" value=<?= !empty($old)?$old['email']:"" ?>> 
      <span class="text-danger"><?= isset($errors)&&isset($errors['email'])?$errors['email']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="github" class="col-sm-2 col-form-label">github</label>
    <div class="col-sm-10">
      <input type="text" name="github" class="form-control" id="github" value=<?= !empty($old)?$old['github']:"" ?>>
      <span class="text-danger"><?= isset($errors)&&isset($errors['github'])?$errors['github']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="twitter" class="col-sm-2 col-form-label">twitter</label>
    <div class="col-sm-10">
      <input type="text" name="twitter" class="form-control" id="twitter" value=<?= !empty($old)?$old['twitter']:"" ?>>
      <span class="text-danger"><?= isset($errors)&&isset($errors['twitter'])?$errors['twitter']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <label for="location" class="col-sm-2 col-form-label">location</label>
    <div class="col-sm-10">
      <input type="text" name="location" class="form-control" id="location" value=<?= !empty($author)?$author['location']:"" ?>>
      <span class="text-danger"><?= isset($errors)&&isset($errors['location'])?$errors['location']:""?></span>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
  <div class="col-sm-10 text-center">
      <button class="btn btn-block btn-success">Add author</button>
    </div>
  </div>
</form>
</div>
 </div>
<?php include __DIR__."/../footer.php"?>