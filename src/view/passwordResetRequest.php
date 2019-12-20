<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 20.12.19
 * Time: 21:13
 */
isset($this->failed)?$failed=$this->failed:$failed=false;

?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <?php if($failed): ?>
                <div class="alert alert-danger">
                    We could not find this user.
                </div>
            <?php endif; ?>
            <?php if($success): ?>
                <div class="alert alert-info">
                    We sent you an email.
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/password/request">
                <div class="form-label-group"><input name="email" class="form-control" type="text" id="inputEmail" placeholder="Username or e-mail" required="" autofocus=""><label for="inputEmail">Username or e-mail</label></div>
                <button class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Reset</button> <br>
            </form>
        </div>
    </div>
</div>
