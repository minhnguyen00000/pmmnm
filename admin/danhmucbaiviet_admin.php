<?php
	 include('../db/connect.php');
?>

<?php
///// THEM DANH MUC VAO DATABASE ////////
	if(isset($_POST['themdanhmuc'])){
		$tendanhmuc=$_POST['danhmuc'];
		$sql_themdanhmuc=mysqli_query($khangduy,"INSERT INTO danhmuc_tin(ten_danhmuctin) values('$tendanhmuc')");
	}
		
////// XOA DANH MUC //////////
	if(isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$sql_xoa_danhmuc=mysqli_query($khangduy,"DELETE FROM danhmuc_tin WHERE id_danhmuctin='$id'");
	}
/////CAP NHAP DANH MUC
	if(isset($_GET['quanly'])=='capnhap'){
		$id_capnhap=$_GET['id'];
		$sql_capnhap_danhmuc=mysqli_query($khangduy,"SELECT * FROM danhmuc_tin WHERE id_danhmuctin='$id_capnhap'");
		$row_capnhap=mysqli_fetch_array($sql_capnhap_danhmuc);
	}
	if(isset($_POST['capnhapdanhmuc'])){
	$id_post=$_POST['id_danhmuc'];
	$ten_danhmuc=$_POST['danhmuc'];
	$sql_update=mysqli_query($khangduy,"UPDATE danhmuc_tin SET ten_danhmuctin='$ten_danhmuc' WHERE id_danhmuctin='$id_post'");
	header('Location:danhmucbaiviet_admin.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADMIN</title>
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
			        <a class="nav-link" href="danhmuc_admin.php">Danh mục</a>
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
			if(isset($_GET['quanly'])){
				$capnhap=$_GET['quanly']; 
			}else{
				$capnhap='';
			}
			if($capnhap=='capnhap'){
				?>
				<div class="col-md-4">
				<h4>Cập nhập danh mục</h4>
				<label>Tên danh mục</label>
				<form action="" method="POST">
					<input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhap['ten_danhmuctin']?>"></br>
					<input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhap['id_danhmuctin']?>"></br>
					<input type="submit"  name="capnhapdanhmuc" value="Cập nhập danh mục" class="btn btn-primary">
				</form>
				</div>
				<?php
			}else{	
				?>
				<div class="col-md-4">
				<h4>Thêm danh mục</h4>
				<label>Tên danh mục</label>
				<form action="" method="POST">
					<input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục"></br>
					<input type="submit"  name="themdanhmuc" value="Thêm danh mục" class="btn btn-primary">
				</form>
				</div>	
			<?php
			}
			?>
			<div class="col-md-8">
				<h4>Liệt kê danh mục</h4>
				<?php 
				$sql_select_danhmuc=mysqli_query($khangduy,"SELECT * FROM danhmuc_tin ORDER BY id_danhmuctin DESC");
				?>
				<table class="table table-bordered">
					<tr>
						<th>Thứ tự</th>
						<th>Tên danh mục</th>
						<th>Quản lý</th>
					</tr>
					<?php 
					$i=0;
					while($row_danhmuc=mysqli_fetch_array($sql_select_danhmuc)){
						$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_danhmuc['ten_danhmuctin'] ?></td>
						<td><a href="?xoa=<?php echo $row_danhmuc['id_danhmuctin']?>"> Xóa </a> || <a href="?quanly=capnhap&id=<?php echo $row_danhmuc['id_danhmuctin']?>">Cập nhập</a> </td>
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