<?php
	include('../db/connect.php');
?>
<?php
	if(isset($_POST['thembaiviet'])){
		$tensanpham = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$tenbaiviet=$_POST['tenbaiviet'];
		$danhmuc = $_POST['danhmuc'];
		$noidung = $_POST['noidung'];
		$tomtat = $_POST['tomtat'];
		$path = '../uploads/';
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		
		$sql_insert_product = mysqli_query($khangduy,"INSERT INTO baiviet(ten_baiviet,tomtat,noidung,id_danhmuctin,image_baiviet) values ('$tenbaiviet','$tomtat','$noidung','$danhmuc','$hinhanh')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);


		
	}else if(isset($_POST['capnhapbaiviet'])){
		$id_update=$_POST['id_update'];
		$tenbaiviet=$_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$danhmuc = $_POST['danhmuc'];
		$noidung = $_POST['noidung'];
		$tomtat = $_POST['tomtat'];
		$path = '../uploads/';
		if($hinhanh==''){
			$sql_update_image="UPDATE baiviet SET ten_baiviet='$tenbaiviet',noidung='$noidung',tomtat='$tomtat',noidung='$chitet',id_danhmuctin='$danhmuc' WHERE id_baiviet='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
			$sql_update_image="UPDATE baiviet SET ten_baiviet='$tenbaiviet',noidung='$noidung',tomtat='$tomtat',noidung='$chitet',id_danhmuctin='$danhmuc',image_baiviet='hinhanh' WHERE id_baiviet='$id_update'";
		}
		mysqli_query($khangduy,$sql_update_image);
	}
?> 
<?php
		if(isset($_GET['xoa'])){
			$id=$_GET['xoa'];
			$sql_xoa=mysqli_query($khangduy,"DELETE FROM baiviet WHERE id_baiviet='$id'");		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sản phẩm</title>
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
	</nav><br><br>
	<div class="container">
		<div class="row">
		<?php
			if(isset($_GET['quanly'])=='capnhat'){
				$id_capnhat = $_GET['capnhat_id'];
				$sql_capnhat = mysqli_query($khangduy,"SELECT * FROM baiviet WHERE id_baiviet	='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				$id_category_1 = $row_capnhat['id_danhmuctin'];
				?>
				<div class="col-md-4">
				<h4>Cập nhật bài viết</h4>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<label>Tên bài viết</label>
					<input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_capnhat['ten_baiviet'] ?>"><br>
					<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['id_baiviet'] ?>">
					<label>Hình ảnh</label>
					<input type="file" class="form-control" name="hinhanh"><br>
					<img src="../uploads/<?php echo $row_capnhat['image_baiviet'] ?>" height="80" width="80"><br>
					<label>Mô tả</label>
					<textarea class="form-control" rows="10" name="tomtat"><?php echo $row_capnhat['tomtat'] ?></textarea><br>
					<label>Chi tiết</label>
					<textarea class="form-control" rows="10" name="noidung"><?php echo $row_capnhat['noidung'] ?></textarea><br>
					<label>Danh mục</label>
					<?php
					$sql_danhmuc = mysqli_query($khangduy,"SELECT * FROM danhmuc_tin ORDER BY id_danhmuctin DESC"); 
					?>
					<select name="danhmuc" class="form-control">
						<option value="0">-----Chọn danh mục-----</option>
						<?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
							if($id_category_1==$row_danhmuc['id_danhmuctin']){
						?>
						<option selected value="<?php echo $row_danhmuc['id_danhmuctin'] ?>"><?php echo $row_danhmuc['ten_danhmuctin'] ?></option>
						<?php 
							}else{
						?>
						<option value="<?php echo $row_danhmuc['id_danhmuctin'] ?>"><?php echo $row_danhmuc['ten_danhmuctin'] ?></option>
						<?php
						}
						}
						?>
					</select><br>
					<input type="submit" name="capnhatsanpham" value="Cập nhật bài viết" class="btn btn-default">
				</form>
				</div>
			<?php
			}else{
				?> 
				<div class="col-md-4">
				<h4>Thêm bài viết</h4>
				
				<form action="" method="POST" enctype="multipart/form-data">
					<label>Tên bài viết</label>
					<input type="text" class="form-control" name="tenbaiviet" placeholder="Tên bài viết"><br>
					<label>Hình ảnh</label>
					<input type="file" class="form-control" name="hinhanh"><br>
					
					<label>Tóm tắt</label>
					<textarea class="form-control" name="tomtat"></textarea><br>
					<label>Nội dung</label>
					<textarea class="form-control" name="noidung"></textarea><br>
					<label>Danh mục</label>
					<?php
					$sql_danhmuc = mysqli_query($khangduy,"SELECT * FROM danhmuc_tin ORDER BY id_danhmuctin DESC"); 
					?>
					<select name="danhmuc" class="form-control">
						<option value="0">-----Chọn danh mục-----</option>
						<?php
						while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
						?>
						<option value="<?php echo $row_danhmuc['id_danhmuctin'] ?>"><?php echo $row_danhmuc['ten_danhmuctin'] ?></option>
						<?php 
						}
						?>
					</select><br>
					<input type="submit" name="thembaiviet" value="Thêm bài viết" class="btn btn-default">
				</form>
				</div>
				<?php
			} 
			
				?>
			<div class="col-md-8">
				<h4>Liệt kê bài viết</h4>
				<?php
				$sql_select_bv = mysqli_query($khangduy,"SELECT * FROM baiviet,danhmuc_tin WHERE baiviet.id_danhmuctin=danhmuc_tin.id_danhmuctin ORDER BY baiviet.id_danhmuctin DESC"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên bài viết</th>
						<th>Hình ảnh</th>
						<th>Danh mục</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while($row_bv = mysqli_fetch_array($sql_select_bv)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $row_bv['ten_baiviet'] ?></td>
						<td><img src="../uploads/<?php echo $row_bv['image_baiviet'] ?>" height="100" width="80"></td>
						<td><?php echo $row_bv['ten_danhmuctin'] ?></td>
						<td><a href="?xoa=<?php echo $row_bv['id_baiviet'] ?>">Xóa</a> || <a href="baiviet_admin?quanly=capnhat&capnhat_id=<?php echo $row_bv['id_baiviet'] ?>">Cập nhật</a></td>
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