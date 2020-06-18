<?php require_once "header.php" ?>
<div class="login">
    <h1>Login</h1>
    <span class="text-success"><?= isset($success)? $success:"" ?></span>
    <form method="post" action="/login/post">
        <input type="text" name="email" placeholder="email" required="required" />
         <span class="text-danger"><?= isset($errors) && isset($errors['email'])? $errors['email']:"" ?></span>
        <input type="password" name="password" placeholder="Password" required="required" />
        <span class="text-danger"><?= isset($errors) && isset($errors['password'])? $errors['password']:"" ?></span>
        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
        <a class="float-right text-success" href="/registration">Haven't account yet?</a>
    </form>
</div>
<?php require_once "footer.php" ?>