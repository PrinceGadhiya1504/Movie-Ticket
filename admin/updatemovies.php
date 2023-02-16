<?php

include("./header.php");
// include("./connect.php");

$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb", "root", "");
$statement = $pdo->prepare("SELECT * FROM movies");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

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
                                <form class="form-sample" action="./script/updatemovie.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" value="" id="value_id" name="id">
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
                                                    <input type="file" accept="image/*" class="form-control" name="image" id="image" required />
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
                                                        <th>Relese Date</th>
                                                        <th>Language</th>
                                                        <th>Ticket Price</th>
                                                        <th>Image</th>
                                                        <th>Update</th>
                                                        <th>Delete</th>
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
                                                            <td><img src="../admin/images/<?= $r['ImageName'] ?>" class="img-1"></td>

                                                            <td><button class="btn btn-warning update">Update</button></td>
                                                            <td><button class="btn btn-warning delete" id="d<?= $r['Id'] ?>">Delete</button></td>
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
            </div>
        </div>
    </div>
</div>

<script>
    update = document.getElementsByClassName('update');
    Array.from(update).forEach((element) => {
        element.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;
            id = tr.getElementsByTagName("td")[0].innerText;
            moviename = tr.getElementsByTagName("td")[1].innerText;
            description = tr.getElementsByTagName("td")[2].innerText;
            relesedate = tr.getElementsByTagName("td")[3].innerText;
            language = tr.getElementsByTagName("td")[4].innerText;
            ticketprice = tr.getElementsByTagName("td")[5].innerText;
            image = tr.getElementsByTagName("td")[6].innerText;
            $("#moviename").val(moviename);
            $("#description").val(description);
            $("#relesedate").val(relesedate);
            $("#language").val(language);
            $("#ticketprice").val(ticketprice);
            $("#image").val(image);
            $("#value_id").val(id);
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            sno = e.target.id.substr(1);
            if (confirm("Are you sure you want to delete this Record!")) {
                console.log("yes! I want to delete this record");
                window.location = `./script/deletemovie.php?delete=${sno}`;
            } else {
                console.log("No!!! I dont want to delete this record");
            }
        })
    })
</script>

<?php
include("./footer.php");
?>