<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>
<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function search_product($tukhoa){
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;
		}

        public function insert_product($data,$files)
        {

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $gender = mysqli_real_escape_string($this->db->link, $data['gender']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            //Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
            

            if($productName=="" || $category=="" || $brand=="" || $gender=="" || $product_desc=="" || $price=="" || $type=="" || $file_name==""){
                $alert = "<span class='error'>Các trường không được trống</span>";
                return $alert;
            } else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName,catId,brandId,gender,product_desc,price,type,image) 
                VALUES('$productName','$category','$brand','$gender','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result)
                {
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                    return $alert;
                }
            }
        }
        public function show_product()
        {
            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
            ORDER BY tbl_product.productId desc";
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_product($data,$files,$id)
        {
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $gender = mysqli_real_escape_string($this->db->link, $data['gender']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            //Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $category=="" || $brand=="" || $gender=="" || $product_desc=="" || $price=="" || $type==""){
                $alert = "<span class='error'>Các trường không được trống</span>";
                return $alert;
            }else
            {
                if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
                    define('MB', 1048576);
					if ($file_size > 5*MB) {
                        $alert = "<span class='success'>Kích thước ảnh không lớn hơn 5MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				    // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>Bạn chỉ có thể upload file:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_product SET
					productName = '$productName',
                    catId = '$category',
					brandId = '$brand',
					gender = '$gender',
					product_desc = '$product_desc',
					price = '$price', 
					image = '$unique_image',
                    type = '$type' 
					WHERE productId = '$id'";
                } 
                else{
                    //Nếu người dùng không chọn ảnh
                    $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    catId = '$category',
					brandId = '$brand',
					gender = '$gender',
					product_desc = '$product_desc',
					price = '$price', 
                    type = '$type' 
					WHERE productId = '$id'";
                }
                $result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
						return $alert;
					}
            }
        }
        public function delete_product($id)
        {
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result)
                {
                    $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
                    return $alert;
                }
        }
        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        //END BACKEND

        public function getproduct_feature()
        {
            $query = 
            "SELECT tbl_product.*
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            WHERE tbl_product.catId = tbl_category.catId AND tbl_category.catName LIKE '%Đồng hồ nổi bật'
            ORDER BY tbl_product.productId desc LIMIT 4";
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_newproduct()
        {
            $query = 
            "SELECT tbl_product.*
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            WHERE tbl_product.catId = tbl_category.catId AND tbl_category.catName LIKE '%Đồng hồ mới về'
            ORDER BY tbl_product.productId desc LIMIT 4";
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_best()
        {
            $query = 
            "SELECT tbl_product.*
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            WHERE tbl_product.catId = tbl_category.catId AND tbl_category.catName LIKE '%Đồng hồ bán chạy nhất'
            ORDER BY tbl_product.productId desc LIMIT 4";
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_cheap(){
            $query = "SELECT * FROM tbl_product WHERE type = '0' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_high(){
            $query = "SELECT * FROM tbl_product WHERE type = '1' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_men(){
            $query = "SELECT * FROM tbl_product WHERE gender = '0'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getproduct_women(){
            $query = "SELECT * FROM tbl_product WHERE gender = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct()
        {
            $query = "SELECT * FROM tbl_product";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new_3(){
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_detail($id){
            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
            INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
            WHERE tbl_product.productId = '$id'";
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_type(){
            $query = "SELECT DISTINCT type FROM tbl_product";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_type($type){
			$query = "SELECT * FROM tbl_product WHERE type='$type'";
			$result = $this->db->select($query);
			return $result;
		}
        public function get_name_by_type($type){
			$query = "SELECT * FROM tbl_product WHERE type='$type' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
    }
?>