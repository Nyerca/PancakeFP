<?php
  $servername="localhost";
  $username ="root";
  $password ="";
  $database = "dbfp";

  $conn = new mysqli($servername, $username, $password, $database);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <title>Order</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../css/ViewOrders.css">
</head>
<body>
<?php
$id = $_GET["id"];
$query_sql="SELECT * FROM orders o, iteminorder io, item i WHERE o.IDOrder=io.IDOrder AND io.IDItem=i.IDItem AND io.Email=o.Email AND o.IDOrder='$id'";
$items = $conn->query($query_sql);

$query_sql2="SELECT * FROM orders o, orderroyalpancake orp , royalpancake r WHERE o.IDOrder=orp.IDOrder AND orp.IDRoyalPancake=r.IDRoyalPancake AND orp.Email=o.Email AND o.IDOrder='$id'";
$RPancakes = $conn->query($query_sql2);

 ?>
<div class="container">

  <div class="row">
  <br/>
  <br/>
     <nav class="navbar navbar-inverse">
      <div class="container-fluid">
       <div class="navbar-header">
        <a class="navbar-brand" href="#">Order</a>
       </div>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
         <ul class="dropdown-menu">
           <li class="divider"></li>
         </ul>
        </li>
       </ul>
      </div>
     </nav>
  </div>

  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
  	<?php
      $rowCheck = $items->fetch_assoc();
      if(strlen($rowCheck['IDDeliveryMode']) <= 0) {
        $query_sql="SELECT * FROM orders WHERE IDOrder='$id'";
      } else {
        $query_sql="SELECT * FROM orders o, deliverymode d WHERE IDOrder='$id' AND o.IDDeliveryMode=d.IDDeliveryMode";
      }
  			$result = $conn->query($query_sql);
  			if($result !== false){
  			?>
  			<table class="table table-striped">
  			<?php
  				if ($result->num_rows > 0) {
  					$row = $result->fetch_assoc();
  						?>
                <td>Data and time: </td>
  							<td><?php echo $row["DateTime"]; ?></td>
              </tr>
              <tr>
                <td>Total price: </td>
  							<td><?php echo $row["TotalPrice"]; ?></td>
              </tr>
              <?php
              if(strlen($rowCheck['IDDeliveryMode']) > 0){
              if(strlen($row["Address"]) > 0) {
                echo '<tr>';
                echo '<td>Address: </td>';
        				echo '<td>'.$row["Address"].'</td>';
                echo'</tr>';
                echo '<tr>';
                echo '<td>CAP: </td>';
                echo '<td>'.$row["CAP"].'</td>';
                echo'</tr>';
              } else if(strlen($row['Latitude']) > 0 ) {
                echo '<tr>';
                echo '<td>Delivery mode:</td>';
                echo '<td>Geolocalization</td>';
                echo'</tr>';
              }
            } else {
                echo '<tr>';
                echo '<td>Delivery mode:</td>';
                echo '<td>In market</td>';
                echo'</tr>';
            }
              if(strlen($row["CardOwner"]) > 0) {
                echo '<tr>';
                echo '<td>Payment mode:</td>';
                echo '<td>Credit card</td>';
                echo'</tr>';
              } else {
                echo '<tr>';
                echo '<td>Payment mode:</td>';
                echo '<td>Cash</td>';
                echo'</tr>';
              }
              ?>
              <?php
  				}
  			?>
  			  </tbody>
  			</table>
        <?php
          if ($items->num_rows > 0) {
            echo '<div class="pancakes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
            echo  '<h3>Items</h3>';
            while($row = $items->fetch_assoc()) {
              echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
              echo '<h4>'.$row['Name'].'</h4>';
              echo '<figure class="figure">';
              echo '<img  class="figure-img img-fluid rounded" width="100" height="100" src="' . htmlspecialchars($row['Photo']) . '"/>';
              echo '<figcaption class="figure-caption"> Price:'.$row['Price'].'</figcaption>';
              echo '<figcaption class="figure-caption"> Quantity: '.$row['Amount'].'</figcaption>';
              echo '</figure>';
              echo '</div>';
            }
            echo '</div>';
          }
            ?>

  		  <?php
  			}
  			$conn->close();
  	?>
  </div>

  <?php
      if ($RPancakes->num_rows > 0) {
        echo '<div class="royalPancakes"  class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
        echo '<h3>Royal Pancakes</h3>';
        while($row = $RPancakes->fetch_assoc()) {
          echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
          echo '<h4>'.$row['RoyalName'].'</h4>';
          echo '<figure class="figure">';
          echo '<img  class="figure-img img-fluid rounded" width="100" height="100" src="' . htmlspecialchars($row['Photo']) . '"/>';
          echo '<figcaption class="figure-caption"> Description:'.$row['Description'].'</figcaption>';
          echo '</figcaption> Quantity: '.$row['Amount'].'</figcaption> <br/>';
          if(isRemovedItem($row['Note'])) {
            echo '<b><em> Note: '.parseNote($row['Note']).'</em></b>';
          }
          echo '</figure>';
          echo '</div>';
        }
        echo '</div>';
      }
      ?>
<?php
  $row = $items->fetch_assoc();
  if($row['Status'] == 1){
    echo '<div class="row2">';
    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
    echo '<a href="../SetDelivery/php/SetDelivery.php?id='.$id.'" class = "btn btn-default btn-lg" role="button">Set delivery man</a>';
    echo '</div>';
    echo '</div>';
  }

  function isRemovedItem($note) {
     $noteChunked = chunk_split($note,1,".");
     $noteChunked = explode(".", $noteChunked);
     return $noteChunked[0] == 0 || $noteChunked[1] == 0 || $noteChunked[2] == 0;
  }

  function parseNote($note) {
    $noteChunked = chunk_split($note,1,".");
    $noteChunked = explode(".", $noteChunked);
    $missing = "missing ";
    if($noteChunked[0] == 0) {
      $missing = $missing. " pancake ";
    }
    if($noteChunked[1] == 0) {
      $missing = $missing. " drink ";
    }
    if($noteChunked[2] == 0) {
      $missing = $missing. " coffee ";
    }
    return $missing;
  }
    ?>
<br/>
<br/>
  <div class="row2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button href="#" class = "btn btn-default btn-lg" role="button">Back</button>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../../../WelcomeBoss/php/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }

  load_unseen_notification();

 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){
  load_unseen_notification();
}, 1000);

});


function GoToOrder(id) {
  window.location.href ="ViewSpecificOrderNotification.php?" + "id=" + id;
}

function DeleteNotification(id){
  //Ajax request
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        load_unseen_notification();
      }
  };
  var PageToSendTo = "../../../WelcomeBoss/php/DeleteNotification.php?";
  var VariablePlaceholder = "id=";
  var UrlToSend = PageToSendTo + VariablePlaceholder + id;
  xmlhttp.open("GET", UrlToSend, true);
  xmlhttp.send();
}

function ViewAllNotification() {
    window.location.href ="../../../WelcomeBoss/php/ViewAllNotification.php";
}
</script>
</body>
</html>
