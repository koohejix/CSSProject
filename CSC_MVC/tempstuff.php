<?php require('template/header.phtml');?>

    <div class="container">
        <div class="row">
            <div class="span12">
                <h1>Users</h1>
                <hr>
            </div>
        </div>
        <div class="row" id="scroll">
            <?php foreach($view->userDataSet as $userData) { ?>
                <div class="col-3 mb-3">
                    <div class="card w-100">
                        <div class="card-body">
                            <img class="profile-pic mr-3 img-fluid" src="/CSC_MVC/images/<?php echo $userData->getProfilePic();?>" alt="placeholder">
                            <div class="flex-column">
                                <h3 class="mb-0 font-weight-normal"><?php echo $userData->getFirstName() . ' ' . $userData->getLastName(); ?></h3>
                                <a class = "btn btn-primary mt-1" href="profile.php?id=<?php echo $userData->getID()?>">Go To Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php require('template/footer.phtml')?>