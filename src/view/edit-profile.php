<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 13.11.19
 * Time: 17:21
 */
use domain\User;

isset($this->user) ? $user = $this->user : $user = new User();

?>
<div class="container">
    <div class="row articlerow">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h1>Edit Profile</h1>
            <form method="post" action="edit-profile">
                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">

                <div class="text-center clearfix cont"><img class="profilepic_edit" src="assets/img/rb.jpeg">
                    <div class="img-overlay"><label>Edit picture</label></div>
                </div><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

                    <tr>
                        <td>Firstname</td>
                        <td><input name="firstname" class="form-control" type="text" name="firstname" value="<?php echo $user->getFirstname() ?>" required></input></td>

                    </tr>
                    <tr>
                        <td>Lastname</td>
                        <td><input name="lastname" class="form-control" type="text" name="lastname" value="<?php echo $user->getLastname() ?>" required></input></td>

                    </tr>
                    <tr>
                        <td>Nickname</td>
                        <td><input name="username" class="form-control" type="text" name="nickname" value="<?php echo $user->getUsername() ?>" required></input></td>

                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td><input name="email" class="form-control" type="text" name="email" value="<?php echo $user->getEmail() ?>" required></input></td>

                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input name="password" class="form-control" type="password" name="password" value="" placeholder="unchanged"></input></td>

                    </tr>
                    <tr>
                        <td>Repeat Password</td>
                        <td><input class="form-control" type="password" name="repeatpassword" value="" placeholder="unchanged"></input></td>

                    </tr>
                </table>
                <div class="text-center clearfix"><button class="btn btn-primary" type="submit" value="submit">Save changes&nbsp;</button></div>
            </form>
        </div>
    </div>
</div>
