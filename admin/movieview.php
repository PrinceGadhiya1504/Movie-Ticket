<?php
include("./header.php");

$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb","root","");
$statement = $pdo->prepare("SELECT * FROM movies");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Movies</p>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="display expandable-table" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Release Date</th>
                    <th>Language</th>
                    <th>Ticket Price</th>
                    <th>Image</th>
                  </tr>
                </thead>
                <?php
                foreach ($rows as $r) {
                ?>
                  <tbody>
                    <tr>
                      <td><?= $r['Id'] ?></td>
                      <td><?= $r['Name'] ?></td>
                      <td><?= $r['Description'] ?></td>
                      <td><?= $r['ReleaseDate'] ?></td>
                      <td><?= $r['Language'] ?></td>
                      <td><?= $r['TicketPrice'] ?></td>
                      <!-- <td><?= $r['ImageName'] ?></td> -->
                      <td><img src="../admin/images/<?= $r['ImageName']?>" class="img-1"></td>
                    </tr>
                  </tbody>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>