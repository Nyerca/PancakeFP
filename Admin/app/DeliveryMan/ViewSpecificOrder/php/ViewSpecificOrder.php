<?php
session_start();
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
<title>View orders</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/DeliveryOrders.css">
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
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h1>Order</h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <input id="bellNotification" type="image" src="../../../../res/bellNotification.png" name="bellNotification" alt="bellNotification" width="50" height="50"/>
    </div>
  </div>

  <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
  	<?php
  			$query_sql="SELECT * FROM orders o, deliverymode d WHERE IDOrder='$id' AND o.IDDeliveryMode=d.IDDeliveryMode";
  			$result = $conn->query($query_sql);
  			if($result !== false){
  			?>
  			<table class="table table-striped">
  			<?php
  				if ($result->num_rows > 0) {
  					$row = $result->fetch_assoc();
  						?>

              <tr>
                <td>Date and time: </td>
  							<td><?php echo $row["DateTime"]; ?></td>
              </tr>
              <tr>
                <td>Total price: </td>
  							<td><?php echo $row["TotalPrice"]; ?></td>
              </tr>
              <?php
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
                echo '<td>Geolocalization mode: </td>';
                echo '<td><a onclick=Geolocalize('.$row['Latitude'].','.$row['Longitude'].') >See coordinates</a></td>';
                echo'</tr>';

              } else {
                echo '<tr>';
                echo '<td>Delivery mode:</td>';
                echo '<td>In market</td>';
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
          echo '<figcaption class="figure-caption"> Quantity: '.$row['Amount'].'</figcaption>';
          echo '</figure>';
          echo '</div>';
        }
        echo '</div>';
      }
      ?>

<br/>
<br/>
</div>
<div class="row2">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <button href="#" class = "btn btn-default btn-lg" role="button">Back</button>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <button onclick="DeclareDelivered('<?php echo $_GET['id']?>')" class = "btn btn-default btn-lg" role="button">Declare delivered</button>
  </div>
</div>
<script type="text/javascript">
  function Geolocalize(lat, long) {
    window.location.href = "Geolocalization/Geolocalization.php?"+ "lat=" + lat + "&long=" + long;
  }

  function DeclareDelivered(id) {
    window.location.href = "SubmitDeclareDelivered.php?" + "id=" + id;
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
