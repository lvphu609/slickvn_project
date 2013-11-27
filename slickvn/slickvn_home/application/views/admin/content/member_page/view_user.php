<?php $url=  base_url();

 foreach ($detail_user as $value_detail_user){
      $id              =$value_detail_user['id'];
      $full_name       =$value_detail_user['full_name'];
      $email           =$value_detail_user['email'];
      $phone_number    =$value_detail_user['phone_number'];
      $address         =$value_detail_user['address'];
    //  $location        =$value_detail_user['location'];
      $avatar          =$value_detail_user['avatar'];
      $role_list        =$value_detail_user['role_list'];
     // $created_date    =$value_detail_user['created_date'];
 }



?>


<div id="create_new_member">
  <div id="content_create_new_member">
   <div class="create_new_member_title">
     <span><div class=create_new_member_text">Thông tin thành viên</div></span>
   </div>
   <div class="line_title"></div></br>
   
   <div class="member_info_title">
     <span>Thông tin thành viên</span>
     
   </div>
   
   <div class="box_input">
     <div class="image_profile"> 
       <span>ẢNH</span><br>
       <span>(Tải ảnh lên)</span><br>
       <img width="100%;" height="80%;" src="<?php echo $avatar; ?>">
     </div>
     <div class="name_profile">
        <span>HỌ VÀ TÊN*</span><br>
        <input class="input_text" type="text" placeholder="vd. Nguyễn Văn A" name="" value="<?php echo $full_name; ?>" >
     </div>
     <div class="job_profile">
        <span>ĐỊA CHỈ*</span><br>
        <input class="input_text" type="text" placeholder="vd. TP Hồ Chí Minh" name="" value="<?php echo $address;?>">
     </div>
     <div class="phone_number_profile">
        <span>ĐIỆN THOẠI*</span><br>
        <input class="input_text" type="text" placeholder="vd. 01665847138" name="" value="<?php echo $phone_number;?>">
     </div>
<!--     <div class="company_profile">
        <span>CÔNG TY</span><br>
        <input class="input_text" type="text" placeholder="vd. Cty TNHH ABC" name="">
     </div>-->
     <div class="email_profile">
        <span>EMAIL</span><br>
        <input class="input_text" type="text" placeholder="vd. nva@aaa.com" name="" value="<?php echo $email;?>">
     </div>
<!--     <div class="facebock_url_profile">
        <span>FACEBOOK URL</span><br>
        <input class="input_text" type="text" placeholder="http://" name="">
     </div>-->
<!--     <div class="code_member_profile">
        <span>MÃ THÀNH VIÊN*</span><br>
        <input class="input_text" type="text" placeholder="vd. SLI1223" name="">
     </div>-->
<!--     <div class="password_profile">
        <span>MẬT KHẨU BAN ĐẦU*</span><br>
        <input class="input_text" type="password" placeholder="vd. 123456" name="">
     </div>-->
     <div class="line_title"></div></br>
     <div class="introduce_member_profile">
        <span>GIỚI THIỆU THÀNH VIÊN</span><br>
        <textarea class="input_textarea" name=""></textarea>
     </div>
     <div class="btn_save_cancel">
       <a href="<?php echo $url;?>index.php/admin/admin_controller/create_new_member_success">
        <div class="btn_save">
          <lable><div class="center_text">Lưu</div></lable>
        </div>
       </a>
       <a href="#">
        <div class="btn_cancel">
          <lable><div class="center_text">Hủy</div></lable>
        </div>
       </a>
     </div>
     
   </div>
   
   
   
   
   
   
   
   
   
   
  </div>
</div>