<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helper/format.php';?>
<?php
	$pd = new product();
	$fm = new format();
	if (isset($_GET['productid'])) {
        $id = $_GET['productid'];
		$delPro = $pd->delete_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
			<?php 
			if(isset($delPro)){
				echo $delPro;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Thứ tự</th>
					<th>Tên sản phẩm</th>
					<th>Hình ảnh</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Giới tính</th>
					<th>Mô tả</th>
					<th>Giá</th>
					<th>Loại sản phẩm</th>
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$pdlist = $pd->show_product();
				if($pdlist)
				{
					$i = 0;
					while($result = $pdlist->fetch_assoc())
					{
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="80" height="100"></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php
						if($result['gender']==0){
							echo 'Đồng hồ nam';
						}else{
							echo 'Đồng hồ nữ';
						} 
					?></td>
					<td><?php
					echo $fm->textShorten($result['product_desc'], 20);
					?></td>
					<td><?php echo number_format($result['price']) ?></td>
					
					<td><?php
						if($result['type']==0){
							echo 'Đồng hồ giá rẻ';
						}else{
							echo 'Đồng hồ cao cấp';
						} 
					?></td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có chắc chắn xóa')" href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
				</tr>
				<?php 
					}	
				}
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
