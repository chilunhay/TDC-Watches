<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>
<?php
    class brand
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_brand($brandName)
        {
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span style='color:red; font-size:18px;'>Thương hiệu không được trống</span>";
                return $alert;
            } else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                if($result)
                {
                    $alert = "<span style='color:green; font-size:18px;'>Thêm thương hiệu thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span style='color:red; font-size:18px;'>Thêm thương hiệu không thành công</span>";
                    return $alert;
                }
            }
        }
        public function show_brand()
        {
            $query = "SELECT * FROM tbl_brand ORDER BY brandId desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_brand($brandName,$id)
        {
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($brandName)){
                $alert = "<span style='color:red; font-size:18px;'>Thương hiệu không được trống</span>";
                return $alert;
            } else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id' ";
                $result = $this->db->update($query);
                if($result)
                {
                    $alert = "<span style='color:green; font-size:18px;'>Sửa thương hiệu thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span style='color:red; font-size:18px;'>Sửa thương hiệu không thành công</span>";
                    return $alert;
                }
            }
        }
        public function delete_brand($id)
        {
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->delete($query);
            if($result)
                {
                    $alert = "<span style='color:green; font-size:18px;'>Xóa thương hiệu thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span style='color:red; font-size:18px;'>Xóa thương hiệu không thành công</span>";
                    return $alert;
                }
        }
        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function show_brand_frontend()
        {
            $query = "SELECT * FROM tbl_brand ORDER BY brandId";
            $result = $this->db->select($query);
            return $result;
        }

		public function get_product_by_brand($id){
			$query = "SELECT * FROM tbl_product WHERE brandId='$id' order by brandId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_brand($id){
			$query = "SELECT tbl_product.*,tbl_brand.brandName,tbl_brand.brandId FROM tbl_product,tbl_brand WHERE tbl_product.brandId=tbl_brand.brandId AND tbl_product.brandId ='$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
    }
?>