<?php

    //connect to the database
    $insert = false;
    $update = false;
    $delete = false;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inotes";

    //create a connection

    $conn = mysqli_connect($servername, $username, $password, $database);

    //Die if connection was not successfull

    if(!$conn){
        die("Sorry! We failed to connect: " . mysqli_connect_error());
    }
    // else{
    //     echo "Connection was successful<br>";
    // }

    if(isset($_GET['delete'])){
        $sno = $_GET['delete'];
        // echo $sno;
        $delete = true;
        $sql = "DELETE FROM `mynotes` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //For modal when you click on update record
        if(isset($_POST['snoEdit'])){
            
            //update the record
            $sno = $_POST["snoEdit"];
            $title = $_POST["titleEdit"];
            $description = $_POST["descriptionEdit"];
            $sql = "UPDATE `mynotes` SET `title` = '$title' , `description` = '$description' WHERE `mynotes` . `sno` = '$sno' ";
            $result = mysqli_query($conn, $sql);
            if($result){
                $update = true;
            }
            else{
                echo "We could not update record successfully.";
            }
    
        }

        else{
        $title = $_POST["title"];
        $description = $_POST["description"];

        //sql query to be executed

        $sql = "INSERT INTO `mynotes` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);

        //Add notes in database

        if($result){
            // echo "The Noets have been successfully Inserted<br>";
            $insert = true;
        }
        else{
            echo "The Noets have not been successfully Inserted because of this error --- " . mysqli_error($conn);
        }
    }
    }


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Fontawesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <title>PHP_CRUD</title>
</head>

<body>

    <!-- Add Modal -->
    <!-- For Edit the notes -->

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">x</span> -->
                    </button>
                </div>
                <form action="/CRUD_PROJECT/index.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp"
                                name="titleEdit">
                            <!-- <div id="emailHelp" class="form-text">Give Here Note Title.</div> -->
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top"> -->
                <i class="fas fa-list-alt"></i>
                My iNotes
            </a>
        </div>
    </nav>


    <!-- For alert when data inserted successfully -->
    <?php

    if($insert){
        echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>SUCCESS!</strong> Your note has been added successfully in My iNotes.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        </button>
      </div>";
    }

    ?>

    <?php

        if($update){
            echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your note has been updated successfully in My iNotes.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            </button>
        </div>";
        }

        ?>

    <?php

        if($delete){
            echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Your note has been deleted successfully in My iNotes.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            </button>
        </div>";
        }

        ?>


    <div class="container my-4">
        <h2>Add a Note to My iNotes</h2>
        <form action="/CRUD_PROJECT/index.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
                <!-- <div id="emailHelp" class="form-text">Give Here Note Title.</div> -->
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-4">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
            
            $sql = "SELECT * FROM `mynotes`";
            $result = mysqli_query($conn, $sql);
            $sno = 0;
            while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;
                echo "<tr>
                <th scope='row'>". $sno ."</th>
                <td>". $row['title'] ."</td>
                <td>". $row['description'] ."</td>
                <td> 
                <button class='edit btn btn-sm btn-primary' id=". $row['sno'] .">Edit</button> 
                <button class='delete btn btn-sm btn-primary' id=d". $row['sno'] .">Delete</button> 
                </td>
            </tr>";
                // echo $row['sno'] . ". Title " . $row['title'] ." Description " . $row['description'];
            }

            ?>
            </tbody>
        </table>
    </div>
    <hr>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <!--Link jquery Data table's CSS & JS CDN -->

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit", e.target);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                // console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                // console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id.substr(1,);

                if (confirm("Are you sure you want to delete this note?")) {
                    console.log("yes");
                    // if we use backtick in js and use $ for some element it considered that as a variable.
                    window.location = `/CRUD_PROJECT/index.php?delete=${sno}`;

                    //create a form and use post request to submit a form
                }
                else {
                    console.log("No");
                }
            })
        })

    </script>
</body>

</html>