<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-6 offset-md-3 well">
    <h3 class="text-center">Login</h3>
    <form action="<?=PROJECT_ROOT?>register/login" class="form" method="POST">
        <div class="bg-danger"><?=$this->displayErrors?></div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" />
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" value="on">
            <label class="form-check-label" for="rembmer_me">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="text-right">
            <a class="text-primary" href="<?=PROJECT_ROOT?>/register/register">If not registered click here?</a>
        </div>
    </form>

</div>
<?php $this->end(); ?>