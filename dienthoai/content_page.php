﻿	<?php 
		if(isset($_GET['action']))
    {    $action=$_GET['action'];}
    else $action=""; 
		if(isset($_GET['content']))
				{
					switch ($_GET['content'])
					{
						case "gioithieu":
							include ('gioithieu.php');
							break;
						case "timkiem":
							include ('timkiem.php');
							break;
						case "dangky":
							include ('dangky.php');
							break;
						case "dangnhap":
							include ('dangnhap.php');
							break;
						case "chitietsp":
							include ('chitietsp.php');
							break;
						case "cart":
							include ('cart/index.php');
							break;
						case "hotro":
							include ('hotro.php');
							break;
						case "sanpham":
							include ('sanpham.php');
							break;
						case "phukien":
							include ('phukien.php');
							break;
						case "tintuc":
							include ('tintuc.php');
							break;
						case "chitiettintuc":
							include ('chitiettintuc.php');
							break;
						case "hethang":
							include ('hethang.php');
							break;
						case "khuyenmai":
							include ('khuyenmai.php');
							break;
					}
				}
			elseif(isset($_GET['madm'])) {
					$sql = "SELECT * FROM sanpham  WHERE madm='{$_GET['madm']}'";	
					if(isset($GET['madm']))
					{
						$sql.="where madm='".$_GET['madm']."'";
					}
						/*------------Phan trang------------- */
						// Nếu đã có sẵn số thứ tự của trang thì giữ nguyên (ở đây tôi dùng biến $page) 
						// nếu chưa có, đặt mặc định là 1!   
					
						if(!isset($_GET['page'])){  
						$page = 1;  
						} else {  
						$page = $_GET['page'];  
						}  

						// Chọn số kết quả trả về trong mỗi trang mặc định là 10 
						$max_results = 12;  

						// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
						$from = (($page * $max_results) - $max_results);  

						// Chạy 1 MySQL query để hiện thị kết quả trên trang hiện tại  

						$sql.=  "LIMIT $from, $max_results";
						
		
					$query=mysqli_query($mysqli,$sql);
					$total=mysqli_num_rows($query);
					if($total>0)
					{
					?>
						
						<div class="sanpham">	
							<?php
							$sql1="select tendm from danhmuc where madm='{$_GET['madm']}'";
							$query1=mysqli_query($mysqli,$sql1);
							$row=mysqli_fetch_array($query1);
							?>
						<h2><?php echo $row['tendm']?></h2>
							<div class="sanphamcon">
								
								<?php 
								  while ($result=mysqli_fetch_array($query))
								  { ?>
								
								<div class="dienthoai">
									<?php 
										if($result['khuyenmai1']>0)
										{
									?>
									<div class="moi"><h3>-<?php echo $result['khuyenmai1']?>%</h3></div>
									<?php } ?>
									<a href="#"><img  src="img/uploads/<?php echo $result['hinhanh'];?>"></a>				
									<p><a href="#" ><?php echo $result['tensp'];?></a></p>
									<h4><?php echo number_format(($result['gia']*((100-$result['khuyenmai1'])/100)),0,",",".");?></h4>
									<div class="button">
										<ul>
											<li>
												<h1><a href="index.php?content=chitietsp&idsp=<?php echo $result['idsp'] ?>" class="chitiet"><button>Chi tiết</button></a></h1>
											</li>
											<li>
												<h5><a href="index.php?content=cart&action=add&idsp=<?php echo $result['idsp'] ?>"><button>Cho vào giỏ</button></a></h5>
											</li>
										</ul>
									</div><!-- End .button-->
								</div><!-- End .dienthoai-->
								<?php } ?>
								
							</div><!-- End .sanphamcon-->
							
						</div><!-- End .sanpham-->
										<?php 
					}
					else {echo "Không có sản phẩm nào";}
				}
				else {
		
	?>
					<div class="sanpham">			
							<h2>ĐIỆN THOẠI BÁN CHẠY</h2>
						<div class="sanphamcon">
							<?php 
						    $sql1="select * from sanpham inner join danhmuc on sanpham.madm = danhmuc.madm where dequi=1 order by daban  DESC limit 6 ";
							$result1= mysqli_query($mysqli,$sql1);
						?>
						<?php 
						  while ($row=mysqli_fetch_array($result1))
						  { ?>
						
						<div class="dienthoai">
							<?php 
										if($row['khuyenmai1']>0)
										{
									?>
									<div class="moi"><h3>-<?php echo $row['khuyenmai1']?>%</h3></div>
									<?php } ?>
							<h1><a href="#"><img  src="img/uploads/<?php echo $row['hinhanh'];?>"></a></h1>				
							<p><a href="#" ><?php echo $row['tensp'];?></a></p>
							<h4>Giá: <?php echo number_format(($row['gia']*((100-$row['khuyenmai1'])/100)),0,",",".");?></h4>
							<div class="button">
										<ul>
											<li>
												<h1><a href="index.php?content=chitietsp&idsp=<?php echo $row['idsp'] ?>" class="chitiet"><button>Chi tiết</button></a></h1>
											</li>
											<li>
												<h5><a href="index.php?content=cart&action=add&idsp=<?php echo $row['idsp'] ?>"><button>Cho vào giỏ</button></a></h5>
											</li>
										</ul>
									</div><!-- End .button-->
						</div><!-- End .dienthoai-->
						<?php } ?>
						
					</div><!-- End .sanphamcon-->
					
				</div><!-- End .sanpham-->
				
				<!------------------------------------------------------------------------------------------------------------------->
                <div class="sanpham">			
						<h2>ĐIỆN THOẠI MỚI</h2>
					<div class="sanphamcon">
					    <?php 
						    $sql1="select * from sanpham inner join danhmuc on sanpham.madm = danhmuc.madm where dequi=1 order by idsp  DESC limit 6 ";
							$result1= mysqli_query($mysqli,$sql1);
						?>
						<?php 
						  while ($row=mysqli_fetch_array($result1))
						  { ?>
						
						<div class="dienthoai">
							<?php 
										if($row['khuyenmai1']>0)
										{
									?>
									<div class="moi"><h3>-<?php echo $row['khuyenmai1']?>%</h3></div>
									<?php } ?>
							<h1><a href="#"><img  src="img/uploads/<?php echo $row['hinhanh'];?>"></a></h1>				
							<p><a href="#" ><?php echo $row['tensp'];?></a></p>
							<h4><?php echo number_format(($row['gia']*((100-$row['khuyenmai1'])/100)),0,",",".");?></h4>
							<div class="button">
										<ul>
											<li>
												<h1><a href="index.php?content=chitietsp&idsp=<?php echo $row['idsp'] ?>" class="chitiet"><button>Chi tiết</button></a></h1>
											</li>
											<li>
												<h5><a href="index.php?content=cart&action=add&idsp=<?php echo $row['idsp'] ?>"><button>Cho vào giỏ</button></a></h5>
											</li>
										</ul>
									</div><!-- End .button-->
						</div><!-- End .dienthoai-->
						<?php } ?>
						
					</div><!-- End .sanphamcon-->
					
				</div><!-- End .sanpham-->
	<?php } ?>