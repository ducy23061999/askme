<!DOCTYPE html>
<?php 
require "config.php";
require "getip.php";

	$conn = mysql_connect($host, $db_user, $db_pass);
	mysql_select_db($db_name,$conn);
	$qr_total = "SELECT count(id) as total from tbl_mess";
	$sum = mysql_query($qr_total,$conn);
	$cout = mysql_fetch_assoc($sum);
	$total_record =  (int)$cout['total'];
	$limit = 10;
	$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
	$total_fage = ceil($total_record/$limit);
	
	if ($current_page > $total_fage) $current_page = $total_fage;
		else if ($current_page<1) $current_page = 1;
	$start = ($current_page - 1)*$limit;
	
	$result = mysql_query("SELECT * FROM tbl_mess ORDER BY id DESC LIMIT $start, $limit",$conn);
	
	mysql_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ask Me Plz &gl3 </title>
	<link rel="stylesheet" href="css/card.css">
	<link rel="stylesheet" href="css/theme.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>
<body>
		<div class="footer">
			<div class="float-left">
				<a href="#"><i>PLZ ASK ME<i></a>
				<i class="fa fa-gratipay" aria-hidden="true" style="font-size: 30px;padding-top: 5px;color: #ffffffba"></i>
			</div>
			<div class="float-right">
				<a href=""><i class="fa fa-facebook cus-icon" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-google-plus-official cus-icon" aria-hidden="true"></i></a>
			</div>
		</div><!--  Het footer -->
		<div class="container">
			<div class="row" style="padding-top: 30px;">
				<div class="col-md-8"">
			  		<div class="block" style="width: 700px;min-height: 50px;">
			  			<div class="status-bar" style="width: 700px;">
			  				<a href="#" class="active alert">Tạo bài viết <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			  			</div>
			  			<form method="POST">
			  				<textarea style="min-height: 150px;height: 100%" placeholder="Hỏi tôi thứ gì đó tại đây nhé :)" class="form-control" id="feed" name="msg"></textarea>
			  				<button type="submit" class="btn btn-primary" style="width: 100px">Gửi      <i class="fa fa-share-square-o" aria-hidden="true"></i></button>
			  			</form>
			  			
			  		</div> <!-- Het Block -->

			  		<div class="alert alert-primary" role="alert" style="width: 700px;margin-top:20px;">
			  		  Quote: Mọi thứ đều bớt quan trong khi bạn mắc ỉa
			  		</div> <!-- Het Alert -->
				</div> <!-- Trai -->

				<div class="col-md-4">
					<div class="card-info">
						<div style="width: 300px; height: 300px";>
							<div class="back-gr">
								<img src="<?php echo $image_url;?>" class="rounded-circle">
								<p style="text-align: center; padding-top: 90px; color: white">Trần Đức Ý</p>
							</div>
							<div class='card-wrapper'>
							  <div class='card' data-toggle-class='flipped'>
							    <div class='card-front'>
							      <div class='layer'>
							        <h1>Click Me</h1>
							        <div class='corner'></div>
							        <div class='corner'></div>
							        <div class='corner'></div>
							        <div class='corner'></div>
							      </div>
							    </div>
							    <div class='card-back'>
							      <div class='layer'>
							        <div class='top'>
							          <h2>My Info</h2>
							        </div>
							        <div class='bottom'>
							          <h3>
							            Sở thích: Code,Nghe nhạc 
							          </h3>
							          <h3>
							            Sở đoản: Hay quên, hay mất tập trung
							          </h3>
							          <h3>
							            Nơi ở: Huế
							          </h3>
							          <h3>
							            Đẹp trai : True
							          </h3>
							        </div>
							      </div>
							    </div>
							  </div>
							</div>
						</div>
					</div>
				</div><!--  Het col 4 -->
			</div><!--  Het row 1-->
			<div class="row">
				<div class="col-md-8">
					<div class="content">
					<?php 
					while($row = mysql_fetch_assoc($result) )
						echo "<p>".$row['date']."</p>
						<div class='title'>
							<img src='http://via.placeholder.com/60x60' class='rounded-circle' style='width: 60px;height: 60px;'>
							   <h7>Anonymous</h7> 
						</div>

						<div class='text-body'>".
							$row['mess']
						."</div>
						<div class='reply'>
							<img src='".$image_url."' class='rounded-circle' class='rounded-circle' style='width: 40px;height: 40px;'>
							   <h7>Trần Đức Ý></h7>
							   Ok mình công nhận bạn đẹp trai 
						</div>";
					
					
					
					
					?>
					</div> <!-- Het content -->
				
					
				</div> <!-- Het col 2 -->
			</div><!-- Het row 2 -->
		
		<div class="row">
			<div class="col-md-8">
				<div class="status-bar" style="width: 700px;">
				<?php 
					if ($current_page > 1 && $total_fage > 1){
    					echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
					}
 
					for ($i = 1; $i <= $total_fage; $i++){
    					if ($i == $current_page){
    						echo '<span>'.$i.'</span> | ';
					 }
						else{
    					 echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
						}
					}
 
					if ($current_page < $total_fage && $total_fage > 1){
    					echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
					}
					
				?>
				</div>
			</div>
		</div>
	</div> <!-- Het container -->
	<script src="js/card.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
	$ip = get_client_ip();
	$msg = $_POST['msg'];
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$time = date("Y-m-d h:i:sa");
	$conn = mysql_connect($host, $db_user, $db_pass);
	mysql_select_db('c9',$conn);
	if (isset($msg)){
		$query = "INSERT INTO `tbl_mess` (`id` ,`ip` ,`mess`,`date`)
		VALUES (NULL ,  '{$ip}',  '{$msg}',  '{$time}');";
	
		if ($conn) {
			$qr = mysql_query($query,$conn);
		} 
	
		mysql_close($conn);
	}
	
?>