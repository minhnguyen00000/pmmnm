<?php
	 include('../connect.php');
?>

<?php
//////////CAP NHAP XU LY
	if(isset($_POST['capnhapdonhang'])){
		$xuly=$_POST['xuly'];
		$mahang=$_POST['mahang_xuly'];
		$sql_update_donhang=mysqli_query($toannhat,"UPDATE don_hang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	}
?>

<?php 
//////XOA DON HANG
if(isset($_GET['xoadonhang'])){
	$mahang=$_GET['xoadonhang'];
	$sql_delele=mysqli_query($toannhat,"DELETE FROM don_hang WHERE ma_dh='$mahang'");
	header('location:donhang_admin.php');
	}
?>
<!-- ///// THEM DANH MUC VAO 	DATABASE ////////
	// if(isset($_POST['themdanhmuc'])){
	// 	$tendanhmuc=$_POST['danhmuc'];
	// 	$sql_themdanhmuc=mysqli_query($khangduy,"INSERT INTO danhmuc(ten_danhmuc) values('$tendanhmuc')");
	// }
		
////// XOA DANH MUC //////////
	if(isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$sql_xoa_danhmuc=mysqli_query($khangduy,"DELETE FROM danhmuc WHERE id_danhmuc='$id'");
	}
/////CAP NHAP DANH MUC
	if(isset($_GET['quanly'])=='capnhap'){
		$id_capnhap=$_GET['id'];
		$sql_capnhap_danhmuc=mysqli_query($khangduy,"SELECT * FROM danhmuc WHERE id_danhmuc='$id_capnhap'");
		$row_capnhap=mysqli_fetch_array($sql_capnhap_danhmuc);
	}
	if(isset($_POST['capnhapdanhmuc'])){
	$id_post=$_POST['id_danhmuc'];
	$ten_danhmuc=$_POST['danhmuc'];
	$sql_update=mysqli_query($khangduy,"UPDATE danhmuc SET ten_danhmuc='$ten_danhmuc' WHERE id_danhmuc='$id_post'");
	header('Location:danhmuc_admin.php');
} -->



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đơn hàng</title>
	 <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<?php
	session_start(); 
  if(isset($_SESSION['ma'])){?>
    <p> Xin chào !  <?php echo $_SESSION['dangnhap'] ?> <a href="logout.php"> Đăng xuất </a></p>
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
			<?php 
			if(isset($_GET['quanly'])=='xemdonhang'){
				$mahang=$_GET['ma_banh'];
				$sql_chitietdonhang=mysqli_query($toannhat,"SELECT * FROM don_hang,banh WHERE don_hang.ma_banh=banh.ma_banh AND don_hang.ma_dh='$mahang'");
				// $row_chitietdonhang=mysqli_fetch_array($sql_chitietdonhang);
				?> 
				<div class="col-md-10">
				<h1>Xem chi tiết đơn hàng</h1>
				<form action="" method="POST">	
				<table class="table table-bordered">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tên bánh</th>
						<th>Số lượng</th>	
						<th>Giá</th>
						<th>Tổng tiền</th>
					</tr>
					<?php 
					$i=0;
					while($row_donhang=mysqli_fetch_array($sql_chitietdonhang)){
						$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_donhang['ma_dh']; ?></td>
						<td><?php echo $row_donhang['ten_banh']; ?></td>
						<td><?php echo $row_donhang['soluong']; ?></td>
						<td><?php echo number_format($row_donhang['giakm_sanpham'])." VND "; ?></td> 
						<td><?php echo number_format($row_donhang['soluong']*$row_donhang['giakm_sanpham'])." VND "; ?></td>

						<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['ma_dh']?>">
						<!-- <td><a href="?xoa=<?php echo $row_donhang['id_donhang']?>"> Xóa </a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']?>">Xem đơn hàng</a> </td> -->
					</tr>	
					<?php
					}
					?> 
				</table>
				</div>
				</form>
				<?php
			}else{	
				?>
				
				<div class="col-md-7">
				<p>Đơn hàng</p>
				</div> 
			<?php
			}
			?> 
			<div class="col-md-8">
				<h4>Danh Sách đơn hàng</h4>
				<?php 
				$sql_select=mysqli_query($toannhat,"SELECT * FROM khach_hang,banh,chitiet_dh,don_hang WHERE chitiet_dh.ma_banh=banh.ma_banh AND don_hang.ma_kh=khach_hang.ma_kh ORDER BY don_hang.ma_dh DESC");
				?> 
				<table class="table table-bordered">
					<tr>
						<th>Thứ tự</th>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Mã hàng</th>
						<th>Tên KH</th>
						<th>Quản lý</th> 
					</tr>
					<?php 
					$i=0;
					while($row_donhang=mysqli_fetch_array($sql_select)){
						$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_donhang['ten_banh']; ?></td>
						<td><?php echo $row_donhang['soluong']; ?></td>
						<td><?php echo $row_donhang['ma_dh']; ?></td>
							<td><?php echo $row_donhang['name']; ?></td>
						<td><a href="?xoadonhang=<?php echo $row_donhang['ma_dh']?>"> Xóa </a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['ma_dh']?>">Xem đơn hàng</a> </td>
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