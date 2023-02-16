<?php

include("./header.php");
// include("./connect.php");
// $query = "SELECT * FROM `Movies`";
// $result = $connection->query($query);
// $rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<body>

  <div class="container-scroller">
    <?php include_once("./navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include_once("./sidebar.php"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Movies</h4>
                  <form class="form-sample" action="./script/movieinsert.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Movie Name </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="moviename" id="moviename" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Discription</label>
                          <div class="col-sm-9">
                            <textarea name="description" id="description" cols="50" rows="5" class="form-control" required></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Image</label>
                          <div class="col-sm-9">
                            <input type="file" accept="image/*" class="form-control" name="image" id="image" required/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Relese Date</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" name="relesedate" id="relesedate" required />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Language</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="language" id="language" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Ticket Price</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="ticketprice" id="ticketprice" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="center">
                      <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php include("./movieview.php"); ?>
        </div>
      </div>
    </div>
  </div>
  <?php include("./footer.php"); ?>