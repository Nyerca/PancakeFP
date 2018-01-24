<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" title="stylesheet" href="headerStyle.css">
  <link rel="stylesheet" type="text/css" title="stylesheet" href="style.css">
</head>
<body>

<?php

require_once 'notification.php';
$result = showNotificationOfUser($_SESSION['user']["email"]);
if($result->num_rows > 0)	{
			while($row = $result->fetch_assoc()) {
				?>
				<div class="col col-xs-12">
              <li>
                  <span class="item">
                    <span class="item-left">
                        <span class="item-info fadeMe<?php echo $row["IDUserNotification"];?>">
							<button class="btn btn-primary" type="button" data-toggle="collapse" onclick="collapseNotification(<?php echo $row["IDUserNotification"];?>)">
								<?php echo $row["Title"];?>
							</button>
							<span class="item-right">
								<button id="<?php echo $row["IDUserNotification"];?>" onclick="deleteNotification(this)" class="btn btn-xs btn-danger pull-right">x</button>
							</span>
							<div class="collapse" id="collapseExample<?php echo $row["IDUserNotification"];?>">
								<div class="card card-body">
									<?php echo $row["Description"];?>
								</div>
							</div>
                        </span>
                    </span>
                   
                </span>
              </li>
			  </div>
				<?php
			}
		}
?>
</body>
</html>
