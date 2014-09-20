<!DOCTYPE html>
<html lang="en">

    <?php include('header_base.php'); ?>

    <body>
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Purplapp</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/account.php"><i class="fa fa-user fa-fw"></i>Account Tools</a></li>
                        <li><a href="/broadcast.php"><i class="fa fa-bolt fa-fw"></i>Broadcast Tools</a></li>
                        <li><a href="/donate.php"><i class="fa fa-bitcoin fa-fw"></i>Donate</a></li>
                        <li><a href="/about.php"><i class="fa fa-info fa-fw"></i>About</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">@<?php echo $auth_username; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $alpha; echo $auth_username;?>" target="_blank"><i class="fa fa-adn"></i> Alpha Profile</a></li>
                                <!-- <li class="divider"></li> -->
                                <li><a href="/phplib/PurplappSignout.php"><i class="fa fa-sign-out"></i> Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">