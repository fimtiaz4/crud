<?php

  $db = mysqli_connect("localhost", "root", "", "newstoday");
  if($db){
    // echo "database ok";
  }
  else{
    echo "Database connection error";
  }

  ob_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>NwesToday</title>
  </head>
  <body>
    <center class="my-5">
      <h1 >CRUD Operation in PHP</h1>
    </center>
    <div class="container">
      <div class="row">
              <!-- form creation -->
      <div class="col-md-6">
        <form method="POST">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Add a Category</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Category" name="cat_name">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Category Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="cat_desc"></textarea>
          </div>
          <input type="submit" class="btn btn-md btn-primary" name="add_cat" value="Add Category" >
        </form>
      </div>
      <?php 
      // creat operation
      if(isset($_POST['add_cat'])){
        $cat_name=$_POST['cat_name'];
        $cat_desc=$_POST['cat_desc'];

        // send value to database
        $sql = "INSERT INTO category(c_name, c_desc) VALUES('$cat_name', '$cat_desc')";
        $result = mysqli_query($db,$sql);

        if($result){
          // echo "1";
        }else{
          echo "Insert data error";
        }
      }

       ?>


      <!-- table creation -->
      <div class="col-md-6">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sql2 = 'SELECT * FROM category';
            $result = mysqli_query($db,$sql2);
            $count = 0;

            while ($row = mysqli_fetch_assoc($result)) {
              $c_id = $row['c_id'];
              $c_name=$row['c_name'];
              $c_desc=$row['c_desc'];
              $count++;

              ?>
              <tr>
              <th scope="row"><?php echo $count; ?></th>
              <td><?php echo $c_name; ?></td>
              <td><?php echo $c_desc; ?></td>
              <td>
                <a href=""><span class="badge bg-warning">Edit</span></a>
                <a href="index.php?d_id=<?php echo $c_id; ?>"><span class="badge bg-danger">Delete</span></a>
              </td>
              </tr>

              <?php

            }

             ?>
          </tbody>
        </table>
      </div>
      </div>

    </div>

    <?php 
    // delete operation
    if(isset($_GET['d_id'])){
     
      $del_id = $_GET['d_id'];

      // delete

     $sql3 = "DELETE FROM category WHERE c_id = '$del_id' ";
     $result = mysqli_query($db,$sql3);

     if ($result) {
      header('Location: index.php');
     }else{
      echo "delete operation failed";
     }



    }

    ?>

    

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


    -->

    <?php 
    ob_end_flush();
     ?>




  </body>
</html>