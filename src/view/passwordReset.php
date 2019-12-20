<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 20.12.19
 * Time: 21:57
 */

use validator\UserRegisterValidator;
use view\TemplateView;

isset($this->validator) ? $validator = $this->validator : $validator = new UserRegisterValidator();

?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <?php if(!$validator->isValid()): ?>
                <div class="alert alert-warning">
                    <?php echo $validator->isPasswordPolicyError() ? $validator->getPasswordPolicyError() . '<br>': '' ?>
                </div>
            <?php endif; ?>
            <?php if($invalidtoken): ?>
                <div class="alert alert-warning">
                    The password reset request is invalid or expired!
                </div>
            <?php endif; ?>


            <form method="post" action="<?php echo $GLOBALS["ROOT_URL"]; ?>/password/reset">
                <input type="hidden" name="token" value="<?php echo TemplateView::noHTML($this->token);?>"/>
                <div class="form-label-group"><input name="password" class="form-control" type="password" id="inputPasswordReg" for="inputPasswordReg" placeholder="Password" required="" autofocus=""><label for="inputPasswordReg">Password</label></div>
                <div class="form-label-group"><input name="passwordrepeat" class="form-control" type="password" id="inputPasswordRepeatReg" for="inputPasswordReg" placeholder="Repeat password" required=""><label for="inputPasswordRepeatReg">Repeat password</label></div>
                <button class="btn btn-primary btn-lg btn-login text-uppercase font-weight-bold mb-2"
                        type="submit">Change password</button> <br>
            </form>
        </div>
    </div>
</div>
<script>
    var password = document.getElementById("inputPasswordReg")
        , confirm_password = document.getElementById("inputPasswordRepeatReg");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
