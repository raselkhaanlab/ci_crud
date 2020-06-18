<?php include __DIR__."/../header.php"?>
 <div class="container">
  <?php if($this->session->flashdata('message')): ?>
 <div class="alert alert-primary mt-1" role="alert">
  <p class="text-center"><?= $this->session->flashdata('message') ?></p>
</div>
  <?php endif; ?>
    
<div class="jumbotron ">
  <div class="row">
  <div class="col-7">
  <h1 class="display-4"> Author's list</h1>
   
   <p class="lead">Here is the author list</p>
  </div>
  <div class="col-5">
    <a href="/author/add" class="btn btn-success float-right">add author</a>
  </div>
  </div>
  <hr class="my-4">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">github</th>
      <th scope="col">twitter</th>
      <th scope="col">location</th>
      <th scope="col">action</th>
      
    </tr>
  </thead>
  <tbody>
      <?php foreach($authors as $key=>$author):?>
            <tr>
            <th scope="row"><?= $key+1 ?></th>
            <td><?= $author["name"]?></td>
            <td><?= $author["email"]?></td>
            <td><?= $author["github"]?></td>
            <td><?= $author["twitter"]?></td>
            <td><?= $author["location"]?></td>
            <td>
                <div class="row">
                  <div class="col-6">
                  <a class="btn btn-success  float-right" href='/author/edit/<?=$author["id"] ?>'> edit</a> 
                  </div>
                  <div class="col-6">
                <form action='/author/delete/<?=$author["id"] ?>' method="post">
                  <button class="btn btn-danger " type="submit"> delete</button>
                </form>
                  </div>
                </div>
            </td>
            </tr>
      <?php endforeach; ?>
  </tbody>
</table>
</div>
 </div>
<?php include __DIR__."/../footer.php"?>