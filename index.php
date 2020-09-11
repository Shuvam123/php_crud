<?php
//connect to database
//INSERT INTO `notes` (`Slno`, `title`, `description`, `timestamp`) VALUES (NULL, 'Test5', 'check', current_timestamp());
$insert = false;
$delete = false;
$update = false;
$server = "localhost";
$password = "";
$user = "root";
$database = "notes";

$con = mysqli_connect($server,$user,$password,$database);
if(!$con)
die("Connection failed".mysqli_connect_error());

 if(isset($_GET['delete'])){
   $sno = $_GET['delete'];
   $delete = true;
   $sql = "Delete from `notes` where `Slno`=$sno";
   $result = mysqli_query($con,$sql);
 }
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if(isset($_POST['snoEdit']))
  {
    //update the record
  $sno = $_POST["snoEdit"];
  $title=$_POST['titlenewedit'];
  
  $description=$_POST['descriptionnewedit'];
  
  $query = "UPDATE  `notes` set `title`='$title' , `description`='$description' where `notes`.`Slno`=$sno";
  $result=mysqli_query($con,$query);
  if(!$result)
  echo "Update failed because of ".mysqli_error($con);
  else
  $update = true;
    
  }
    else{
 $title=$_POST['title'];
  $description=$_POST['description'];

  $query = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description');";
  $result=mysqli_query($con,$query);
  if(!$result)
  echo "Insertion failed because of ".mysqli_error($con);
  else
  $insert = true;
   
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
   
    

    <title>iNote-Notes</title>

    
  </head>
  <body>

  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditModal">
  edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/crud/index.php" method="post">
      <div class="modal-body">
      

      <input type="hidden" name="snoEdit" id="snoEdit">
      
        <div class="form-group">
          <label for="title">Note Title </label>
          <input type="text" class="form-control" id="titlenewedit" name="titlenewedit" aria-describedby="emailHelp" >
          
        </div>
        
        <div class="form-group">
            <label for="description">Note Description</label>
            <textarea class="form-control" id="descriptionnewedit" name="descriptionnewedit" rows="3" ></textarea>
          </div>
        
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	</form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">iNote-Notes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
              </li>
            
            
          </ul>
          <form class="form-inline my-2 my-lg-0" >
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <?php
      if($insert)
      {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Inserted Successfully!</strong> You should check in on some of those fields below.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";

      }
      if($update)
      {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Update Successfully!</strong> Update on your own will :)
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";

      }
      if($delete)
      {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Deleted Successfully!</strong> Delete at your own risk :)
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>";

      }

?>
<div class="container my-4">

    <h2>Add a note</h2>
    <form action="/crud/index.php" method="post">
        <div class="form-group">
          <label for="title">Note Title </label>
          <input type="text" class="form-control" id="titlenew" name="title" aria-describedby="emailHelp" >
          
        </div>
        
        <div class="form-group">
            <label for="description">Note Description</label>
            <textarea class="form-control" id="descriptionnew" name="description" rows="3" ></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
      </form>
</div>
<div class="container my-4">



<table class="table" id="myTable">
  <thead>
    <tr>
      
      <th scope="col">Slno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  
  <?php
  $sql="SELECT * FROM `notes`";

$result = mysqli_query($con,$sql);
$sno123=0;
while($row = mysqli_fetch_assoc($result)){


  $sno123 = $sno123 + 1;
 
echo "<tr>
<th scope='row'>". $sno123 ."</th>
<td>". $row['title'] ."</td>

<td>". $row['description'] ."</td>
            <td> <button class='edit btn btn-sm btn-primary' id=". $row['Slno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d". $row['Slno'].">Delete</button>  </td>

</tr>";

}
?>
    
  </tbody>
 

</table>

</div>
<hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
  
      
       tr = e.target.parentNode.parentNode;
       
       
       
       title = tr.getElementsByTagName("td")[0].innerText;
       description = tr.getElementsByTagName("td")[1].innerText;
       
       titlenewedit.value=title;
       descriptionnewedit.value=description;
        snoEdit.value = e.target.id;
        
       $('#EditModal').modal('toggle');
        })

      })
    </script>
    <script>
      deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
       sno = e.target.id.substr(1);
      if(confirm("Press a button!"))
      {
        
        window.location = `/crud/index.php?delete=${sno}`;
      }
      
      
        })

      })
    </script>
  </body>
</html>