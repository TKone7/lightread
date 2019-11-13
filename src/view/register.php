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

                <h3 class="profile-title">No account yet? Create one today.</h3>
                <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/register">
                    <div class="form-label-group"><input name="username" class="form-control" type="text" id="inputUsername" placeholder="Username" autofocus="" required=""><label for="inputUsername">Username</label></div>
                    <div class="form-label-group"><input name="email" class="form-control" type="email" id="inputEmailReg" for="inputEmailReg" placeholder="Email address"><label for="inputEmailReg">Email address</label></div>
                    <div class="form-label-group"><input name="password" class="form-control" type="password" id="inputPasswordReg" for="inputPasswordReg" required="" placeholder="Password"><label for="inputPasswordReg">Password</label></div>
                    <div class="form-label-group"><input name="passwordrepeat" class="form-control" type="password" id="inputPasswordRepeatReg" for="inputPasswordReg" placeholder="Repeat password" required=""><label for="inputPasswordRepeatReg">Repeat password</label></div><button class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Register</button></form>
            </div>
        </div>
    </div>
