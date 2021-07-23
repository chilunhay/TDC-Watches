<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>
<?php
    class customer
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $gender = mysqli_real_escape_string($this->db->link, $data['gender']);
            if($name=="" || $email=="" || $password=="" || $phone=="" || $address=="" || $gender==""){
                $alert = "<span style='color:red; font-size:18px;'>Các trường không được trống</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check)
                {
                    $alert = "<span style='color:red; font-size:18px;'>Email đã được đăng ký</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_customer(name,email,password,phone,address,gender) 
                    VALUES('$name','$email','$password','$phone','$address','$gender')";
                    $result = $this->db->insert($query);
                    if($result)
                    {
                        $alert = "<span style='color:green; font-size:18px;'>Đăng ký thành công</span>";
                        return $alert;
                    } else
                    {
                        $alert = "<span style='color:red; font-size:18px;'>Đăng ký không thành công</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            if($email=="" || $password==""){
                $alert = "<span style='color:red; font-size:18px;'>Tài khoản và mật khẩu không được trống</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' LIMIT 1";
                $result_check = $this->db->select($check_login);
                if($result_check != false)
                {
                    $value = $result_check->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['name']);
                    echo("<script>location.href = 'index.php';</script>");
                }else{
                    $alert = "<span style='color:red; font-size:18px;'>Email hoặc mật khẩu không đúng</span>";
                    return $alert;
                    
                }
            }
        }

        public function show_customer($id)
        {
            $query = "SELECT * FROM tbl_customer WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_customer($data, $id){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            if($name=="" || $email=="" || $address=="" || $phone==""){
                $alert = "<span style='color:red; font-size:18px;'>Các trường không được trống</span>";
                return $alert;
            }
            else{ 
                $query = "UPDATE tbl_customer SET name ='$name',email = '$email',phone = '$phone',address = '$address'
                WHERE id = '$id'";
                $result = $this->db->insert($query);
                if($result)
                {
                    $alert = "<span style='color:green; font-size:18px;'>Sửa thông tin thành công</span>";
                    return $alert;
                } else
                {
                    $alert = "<span style='color:red; font-size:18px;'>Sửa thông tin không thành công</span>";
                    return $alert;
                }
            
            }   
        }
    }
?>