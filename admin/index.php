<meta charset = "utf8" />
<?php
session_start();
require_once "../config.php";
if (isset($_SESSION['user']) && isset($_SESSION['pass'])){
    if ($_SESSION['user'] != $admin_username && $_SESSION['pass'] != $admin_pass){
    	$_SESSION['mess'] = "Bạn nhập sai user hoặc password cmnr";
        header("location: login.php");
        die();
    }
    
}else
{
    $_SESSION['mess'] = "Bạn chưa nhập tên đăng nhập hoặc mật khẩu";
    header("location: login.php");
    die();
    
}
?>
<!DOCTYPE html>
<?php 

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
			    <a href="logout.php">Log Out</a>
				<a href=""><i class="fa fa-facebook cus-icon" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-google-plus-official cus-icon" aria-hidden="true"></i></a>
			</div>
		</div><!--  Het footer -->
		<div class="container">
			<div class="row" style="padding-top: 30px;">
				<div class="col-md-8"">

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
					{
						if ($row['rep'] != NULL)
							echo 
							"<p>".$row['date']."</p>
							<div class='title'>
								<img src='http://via.placeholder.com/60x60' class='rounded-circle' style='width: 60px;height: 60px;'>
							   	<h7>Anonymous</h7> 
							</div>

							<div class='text-body'>".
								$row['mess']
							."</div>"
							. "<div class='reply'>".
							"<img src='".$image_url."' class='rounded-circle' class='rounded-circle' style='width: 40px;height: 40px;'>
							   <h7>Trần Đức Ý></h7>
							   ".$row['rep'].
							"</div>";
							else {
								echo 
								"<p>".$row['date']."</p>
								<div class='title'>
									<img src='http://via.placeholder.com/60x60' class='rounded-circle' style='width: 60px;height: 60px;'>
							   		<h7>Anonymous</h7> 
							   	</div>
							   	<div class='text-body'>".
									$row['mess']
							    ."</div>".
								"<div class='reply'>
							   		<form method='POST' class='resert'>
							       		<textarea style='height: 70px' placeholder='Nhập câu trả lời' class='form-control' name='rep'></textarea>
							       		<input type='hidden' name='id_post' value='".$row['id']."'/>
							       		<button type='submit' class='btn btn-success'>Gửi</button>
							   
							   		</form>
							    	
								</div>";
							}
					}
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
		<script>
			
		</script>
	</div> <!-- Het container -->
	<script src="js/card.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
	if(isset($_POST['rep']) && isset($_POST['id_post'])){
		$reply = htmlentities($_POST['rep'], ENT_QUOTES, "UTF-8");
		$id_int = (int)$_POST['id_post'];
	    $conn = mysql_connect($host,$db_user,$db_pass);
	    mysql_select_db($db_name);
	    $query_insert = "UPDATE tbl_mess SET rep =  '{$reply}' WHERE id ={$id_int}";
	    $status = mysql_query($query_insert,$conn);
	    if ($status) echo "<script type='text/javascript'>
					// Load one times
					(function()
					{
					  if( window.localStorage )
					  {
					    if( !localStorage.getItem('firstLoad') )
					    {
					      localStorage['firstLoad'] = true;
					      window.location.reload();
					    }  
					    else
					      localStorage.removeItem('firstLoad');
					  }
					})();
					
				</script>";
	    	else echo "<script>alert('Thất cmn Bại)</script>";
	    mysql_close();
	}
?>    