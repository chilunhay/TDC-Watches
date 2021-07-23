<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>
<?php
    class cart
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($quantity, $id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            

            $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            $result_check_cart = $this->db->select($check_cart);
            if($result_check_cart)
            {
                $msg = "<span style='color:red; font-size:18px;'>Sản phẩm đã có trong Giỏ hàng</span>";
				return $msg;
            }
            else
            {
                $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
				$result = $this->db->select($query)->fetch_assoc();
                $productName = $result["productName"];
                $price = $result["price"];
                $image = $result["image"];

                $query_insert = "INSERT INTO tbl_cart(productId, sId, productName, price, quantity, image) 
                VALUES('$id','$sId','$productName','$price','$quantity','$image')";
                $insert_cart = $this->db->insert($query_insert);
                if($insert_cart)
                {
                    echo("<script>location.href = 'cart.php';</script>");
                } 
                else{
                    echo("<script>location.href = '404.php';</script>");
                }
            }
            
        }

        public function check_cart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $cartId)
        {
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);

            $query = "UPDATE tbl_cart SET
            quantity = '$quantity' 
			WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            if($result)
            {
                $msg = "<span style='color:green; font-size:18px;'>Số lượng sản phẩm cập nhật thành công</span>";
                return $msg;
            }else
            {
                $msg = "<span style='color:red; font-size:18px;'>Số lượng sản phẩm cập nhật không thành công</span>";
                return $msg;
            }
        }

        public function delete_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM tbl_cart WHERE cartid = '$cartid'";
            $result = $this->db->delete($query);
            if($result)
            {
                $msg = "<span style='color:green; font-size:18px;'>Xóa sản phẩm thành công</span>";
                return $msg;
            }else
            {
                $msg = "<span style='color:red; font-size:18px;'>Xóa sản phẩm không thành công</span>";
                return $msg;
            }
        }

        public function del_all_data_cart()
        {
            $sId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
        }
    }
?>