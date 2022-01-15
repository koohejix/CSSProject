<?php require('views/template/header.phtml');?>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                        <h3 class="mb-0 font-weight-normal">Test</h3>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="mb-0 font-weight-normal">Test</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="mb-0 font-weight-normal">Test</h3>
                </div>
            </div>
        </div>
        </div>
    </div>

<?php require('views/template/footer.phtml');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/CSC_MVC/css/bootstrap.css" rel="stylesheet">
    <link href="/CSC_MVC/css/custom.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a href="?index.php" class="brand">SpaceBook</a>
            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li><a href="?index">Home</a></li>
                    <?php if(isset($_SESSION['userid'])) { ?>
                        <li><a href="?myprofile">My Profile</a></li>
                        <li><a href="?friends">My Friends</a></li>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="navbar-search pull-left">
                            <input type="text" name="searchContent" placeholder="Search &hellip;" class="search-query">
                        </form>
                    <?php } ?>
                </ul>
                <ul class="nav pull-right">
                    <?php if(isset($_SESSION['userid'])) { ?>
                        <li><a href="?logout">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="?login">Login</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="?register">Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
