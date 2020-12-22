<?php
	 include('../db/connect.php');
?>

<!-- <?php
//////////CAP NHAP XU LY
	if(isset($_POST['capnhapdonhang'])){
		$xuly=$_POST['xuly'];
		$mahang=$_POST['mahang_xuly'];
		$sql_update_donhang=mysqli_query($khangduy,"UPDATE donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	}
?> 

<?php 
//////XOA DON HANG
if(isset($_GET['xoadonhang'])){
	$mahang=$_GET['xoadonhang'];
	$sql_delele=mysqli_query($khangduy,"DELETE FROM donhang WHERE mahang='$mahang'");
	header('location:donhang_admin.php');
	}
?>  -->



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Khách hàng</title>
	 <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<?php
	session_start(); 
  if(isset($_SESSION['id_admin'])){?>
    <p> Xin chào -:- <?php echo $_SESSION['dangnhap'] ?> <a href="logout.php"> Đăng xuất </a></p>
  <?php
  }else{
    header('Location:index.php');
  }
  ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav">
			      <li class="nav-item active">
			        <a class="nav-link" href="donhang_admin.php">Đơn hàng <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="danhmuc_admin.php">Danh Sách Loại</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="danhmucbaiviet_admin.php">Danh mục bài viết</a>
			      </li>
			       <li class="nav-item">
			        <a class="nav-link" href="baiviet_admin.php">Bài viết</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="sanpham_admin.php">Sản phẩm</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link disabled" href="khachhang_admin.php">Khách hàng</a>
			      </li>

			    </ul>
		  </div>
</nav>
</br>
	<div class="container">
		<div class="row">	

				
			<div class="col-md-12">
				<h4>Khách hàng</h4>
				<?php 
				$sql_select2=mysqli_query($khangduy,"SELECT * FROM khachhang ORDER BY khachhang.id_khachhang DESC");
				?> 
				<table class="table table-bordered">
					<tr>
						<th>Thứ tự</th>
						<th>Tên KH</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Email</th>
					<!-- 	<th>Quản lý</th>  -->
					</tr>
					<?php 
					$i=0;
					while($row_khachhang=mysqli_fetch_array($sql_select2)){
						$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_khachhang['name']; ?></td>
						<td><?php echo $row_khachhang['phone']; ?></td>
						<td><?php echo $row_khachhang['address']; ?></td>
						<td><?php echo $row_khachhang['email']; ?></td>
						<!-- <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['id_khachhang'] ?>">Xem giao dịch</a> </td> -->
					</tr>	
					<?php
					}
					?> 
				</table>
			</div>
		</div>	
	</div>
	
</body>
</html>