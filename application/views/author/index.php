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
   
   <p class="lead">Here is the total <?= $total ?> author </p>
  </div>
  <div class="col-5">
    <a href='<?=base_url() ?>author/add' class="btn btn-success float-right">add author</a>
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
      <?php if(count($authors)>0): foreach($authors as $key=>$author):?>
            <tr>
            <th scope="row"><?= $author['id'] ?></th>
            <td><?= $author["name"]?></td>
            <td><?= $author["email"]?></td>
            <td><?= $author["github"]?></td>
            <td><?= $author["twitter"]?></td>
            <td><?= $author["location"]?></td>
            <td>
                <div class="row">
                  <div class="col-6">
                  <a class="btn btn-success  float-right" href='<?=base_url() ?>edit/author/<?=$author["id"] ?>'> edit</a> 
                  </div>
                  <div class="col-6">
                <form action='<?=base_url() ?>delete/author/<?=$author["id"]?>' method="post">
                  <button class="btn btn-danger " type="submit"> delete</button>
                </form>
                  </div>
                </div>
            </td>
            </tr>
      <?php endforeach;?>
      <?php  else: ?>
         <p>No reccord found!!!!!</p>
      <?php endif;?>
  </tbody>
</table>
<?php if (isset($links)) { ?>
                <?php echo $links ?>
 <?php } ?>
</div>
 </div>
<?php include __DIR__."/../footer.php"?>
