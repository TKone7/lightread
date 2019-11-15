<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */
?>
<div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/login">
                    <div class="form-label-group"><input name="email" class="form-control" type="text" id="inputEmail" placeholder="Username or e-mail" required="" autofocus=""><label for="inputEmail">Username or e-mail</label></div>
                    <div class="form-label-group"><input name="password" class="form-control" type="password" id="inputPassword" required="" placeholder="Password"><label for="inputPassword">Password</label></div>
                    <div class="custom-control custom-checkbox mb-3"><input type="checkbox" id="customCheck1" class="custom-control-input"><label class="custom-control-label" for="customCheck1">Remember password</label></div><button class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Sign in</button></form>
            </div>
        </div>
    </div>
