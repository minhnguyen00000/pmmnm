<?php
  session_start();
  if(!isset($_SESSION['dangnhap'])){
       header('Location:index.php');
  }
    if(isset($_GET['login'])){
    $dangxuat=$_GET['login'];
   }else{
    $dangxuat='';
   }
   if($dangxuat=='dangxuat'){ 
    session_destroy();
    header('Location:index.php');
   }
   if(isset($_POST['dangnhap'])){
    $taikhoan=$_POST['taikhoan'];
    $matkhau=md5($_POST['matkhau']);
    if($taikhoan==''|| $matkhau==''){
      echo '<p>Xin nhập đầy đủ thông tin</p>';
    }else{
              //Ket noi vs CSDL lay thong tin dang nhap
        $sql_select_admin=mysqli_query($toannhat,"SELECT * FROM admin where taikhoan='$taikhoan' AND matkhau='$matkhau' LIMIT 1");
        $count=mysqli_num_rows($sql_select_admin);
        $row_dangnhap=mysqli_fetch_array($sql_select_admin);
        if($count>0){
          $_SESSION['dangnhap']=$row_dangnhap['tenadmin'];
           $_SESSION['ma']=$row_dangnhap['ma'];
           
          header('Location:home.php');
        }else{
          echo 'Tài khoản hoặc mật khẩu không đúng !';
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chào mừng đến với trang ADMIN</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
  <?php 
  if(isset($_SESSION['ma'])){?>
    <p>Xin chào <?php echo $_SESSION['dangnhap'] ?> <a href="logout.php"> Đăng xuất </a></p>
  <?php
  }else{
    header('Location:index.php');
  }
  ?>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
</body>
</html>