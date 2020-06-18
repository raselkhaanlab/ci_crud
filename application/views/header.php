<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title??"title" ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<?php if(isset($_SESSION['user'])): ?>
        <div class="container">
        <form action="/logout" method="post">
            <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
            <button class="btn btn-danger float-right" type="submit">logout</button>
            </div>
            </div>
        </form>
        </div>
<?php endif; ?>
    
