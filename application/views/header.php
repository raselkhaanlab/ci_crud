<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title??"title" ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href='<?= base_url()?>/public/css/style.css'>
</head>
<body>
<?php if(isset($_SESSION['user'])): ?>
        <div class="container">
            <div class="float-left">
            <h5 class=" text-success "> Account name: <?= $this->session->userdata('user')['name']?></h5>
            <h6 class=" text-success "> Email: <?= $this->session->userdata('user')['email']?></h6>
            <h6 class=" text-success "> Number: <?= $this->session->userdata('user')['number']?></h6>
            </div>
        <form action='<?=base_url() ?>/logout' method="post" id="logout-form">
            <a class="float-right mx-3" href='<?=base_url() ?>author'>home</a>   
            <a class="float-right mx-3" href='<?=base_url() ?>edit/me'>Account edit</a>   
            <a  class="float-right" href="" id="logout"> logout</a>
        </form>
        </div>
<?php endif; ?>
    
