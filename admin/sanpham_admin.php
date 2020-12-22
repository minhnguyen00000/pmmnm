<?php
	include('../connect.php');
?>
<?php
	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$gia = $_POST['giasanpham'];
		$danhmuc = $_POST['danhmuc'];
		$thanhphan = $_POST['thanhphan'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];



		
		$sql_insert_product = mysqli_query($toannhat,"INSERT INTO banh(ma_loai,ten_banh,thanh_phan,mo_ta,gia,hinh) values ('$danhmuc','$tensanpham','$thanhphan','$mota','$gia','$hinhanh')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}
	
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sản phẩm</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
		<?php
	session_start(); 
  if(isset($_SESSION['ma'])){?>
    <p> Xin chào -:- <?php echo $_SESSION['dangnhap'] ?> <a href="logout.php"> Đăng xuất </a></p>
  <?php
  }else{
    header('Location:index.php');
  }
  ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
	</nav><br><br>
	<div class="container">
		<div class="row">
		<?php
			if(isset($_GET['quanly'])=='capnhat'){
				$id_capnhat = $_GET['capnhat_id'];
				$sql_capnhat = mysqli_query($toannhat,"SELECT * FROM banh WHERE ma_banh='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				$id_category_1 = $row_capnhat['ma_loai'];
				?>
				<div class="col-md-4">
				<h4>Cập nhật sản phẩm</h4>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<label>Tên sản phẩm</label>
					<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['ten_banh'] ?>"><br>
					<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['ma_banh'] ?>">
					<label>Hình ảnh</label>
					<input type="file" class="form-control" name="hinhanh"><br>
					<img src="../img/banh/<?php echo $row_capnhat['hinh'] ?>" height="80" width="80"><br>
					<label>Giá</label>
					<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['gia'] ?>"><br>
					
					<label>Mô tả</label>
					<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhat['mo_ta'] ?></textarea><br>
					<label>Chi tiết</label>
					<textarea class="form-control" rows="10" name="thanhphan"><?php echo $row_capnhat['thanh_phan'] ?></textarea><br>
					<label>Danh mục</label>
					<?php
					$sql_danhmuc = mysqli_query($toannhat,"SELECT * FROM loai ORDER BY ma_loai DESC"); 
					?>
					<select name="danhmuc" class="form-control">
						<option value="0">-----Chọn Loại-----</option>
						<?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
							if($id_category_1==$row_danhmuc['ma_loai']){
						?>
						<option selected value="<?php echo $row_danhmuc['ma_loai'] ?>"><?php echo $row_danhmuc['ten_loai'] ?></option>
						<?php 
							}else{
						?>
						<option value="<?php echo $row_danhmuc['ma_loai'] ?>"><?php echo $row_danhmuc['ten_loai'] ?></option>
						<?php
						}
						}
						?>
					</select><br>
					<input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
				</form>
				</div>
			<?php
			}else{
				?> 
				<div class="col-md-4">
				<h4>Thêm sản phẩm</h4>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<label>Tên sản phẩm</label>
					<input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
					<label>Hình ảnh</label>
					<input type="file" class="form-control" name="hinhanh"><br>
					<label>Giá</label>
					<input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
					
					<label>Mô tả</label>
					<textarea class="form-control" name="mota"></textarea><br>
					<label>Chi tiết</label>
					<textarea class="form-control" name="thanhphan"></textarea><br>
					<label>Danh mục</label>
					<?php
					$sql_danhmuc = mysqli_query($toannhat,"SELECT * FROM loai ORDER BY ten_loai DESC"); 
					?>
					<select name="danhmuc" class="form-control">
						<option value="0">-----Chọn loai-----</option>
						<?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
						?>
						<option value="<?php echo $row_danhmuc['ma_loai'] ?>"><?php echo $row_danhmuc['ten_loai'] ?></option>
						<?php 
						}
						?>
					</select><br>
					<input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
				</form>
				</div>
				<?php
			} 
			
				?>
			<div class="col-md-8">
				<h4>Danh Sách Bánh</h4>
				<?php
				$sql_select_sp = mysqli_query($toannhat,"SELECT * FROM banh,loai WHERE banh.ma_loai=loai.ma_loai ORDER BY banh.ma_banh DESC"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên sản phẩm</th>
						<th>Hình ảnh</th>
						
						<th>Loại</th>
						<th>Giá sản phẩm</th>
						
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while($row_sp = mysqli_fetch_array($sql_select_sp)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $row_sp['ten_banh'] ?></td>
						<td><img src="../img/banh/<?php echo $row_sp['hinh'] ?>" height="100" width="80"></td>
						
						<td><?php echo $row_sp['ten_loai'] ?></td>
						<td><?php echo number_format($row_sp['gia']).'vnđ' ?></td>
						
						<td><a href="?xoa=<?php echo $row_sp['ma_banh'] ?>">Xóa</a> || <a href="sanpham_admin?quanly=capnhat&capnhat_id=<?php echo $row_sp['ma_banh'] ?>">Cập nhật</a></td>
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