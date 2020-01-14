<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 30.10.2019
 * Time:
 */

use domain\User;
use view\TemplateView;
isset($this->simple) ? $simple = $this->simple : true;
isset($this->loggedin) ? $loggedin = $this->loggedin : false;
isset($this->user) ? $user = $this->user : $user = new User();
isset($this->allowSearch) ? $allowSearch = $this->allowSearch : False;
isset($this->SearchPlaceholder) ? $SearchPlaceholder = $this->SearchPlaceholder : "search...";

// echo $user->getUsername();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Lightread</title>
    <link rel="icon" type="image/png" sizes="32x33" href="assets/img/lightread.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/lightread16.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Data-Table-1.css">
    <link rel="stylesheet" href="assets/css/Data-Table.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/responsive-tiles.css">
    <link rel="stylesheet" href="assets/css/tx-list.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom_icons.css">
    <link rel="stylesheet" href="assets/css/amsify.suggestags.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-lg fixed-top <?php echo ($this->simple) ? "index" : "" ?>" id="mainNav">
    <div class="container"><a class="navbar-brand lrlogo <?php echo ($this->simple) ? "lrlogo-index" : "" ?>" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/">light<i class="fa fa-flash" style="color: #ffc81e;"></i>read</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false"
                                                                                                                                                    aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <?php
            if ($this->allowSearch) { ?>
                <ul class="nav navbar-nav ml-auto">
                    <li role="presentation" class="nav-item">
                        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input id="strm" name="searchterm" type="search" class="border rounded form-control" style="width: 333px;" placeholder="<?php echo $this->SearchPlaceholder; ?>" />
                            <input type="submit" id="mySubmit" style="display: none;" />
                        </form>
                    </li>
                </ul>
            <?php } ?>

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/about">About</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/category">Category</a></li>
                <?php if (!($loggedin)): ?>
                    <li class="nav-item" role="presentation" id="login"><a class="nav-link" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/login">Login</a></li>
                <?php else: ?>
                    <?php if($user->getIsAdmin()): ?>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/node">Nodeinfo</a></li>
                    <?php endif; ?>
                    <li class="nav-item post-subtitle" role="presentation" id="login">
                        <a class="nav-link" id="login" href="<?php echo $GLOBALS["ROOT_URL"]; ?>/profile"><i class="fa fa-user-circle-o" style="font-size: 16px;vertical-align: middle;"></i>&nbsp;
                            <?php echo $user->getUsername(); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function (){

        $('#mySubmit').click(function() {
            alert('Submitted!');
            return false;
        });

        $('#strm').on('keyup', function(e) {
            if (e.keyCode === 13) { //13 = Enter
                $('#mySubmit').click();
            }
        });

    });

</script>