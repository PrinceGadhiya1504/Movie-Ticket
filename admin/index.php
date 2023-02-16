<?php

include("./header.php");
// include("./navbar.php");
// include("./connection/connect.php");

?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <form class="pt-3" action="./login.php" method="POST">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login_button">SIGN IN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include("./footer.php");
?>