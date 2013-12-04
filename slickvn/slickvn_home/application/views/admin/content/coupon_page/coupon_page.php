
<?php $url=  base_url();?>


<div id="restaurant_page">
  <div id="content_restaurant_page">
   <div class="restaurant_page_title">
     <span><div class="restaurant_page_text">Thêm thông tin khuyến mãi</div></span>
   </div>
   <div class="line_title"></div></br>
   <!--
   <div class="create_new_restaurant">
     <a href="<?php //echo $url;?>index.php/admin/admin_controller/create_new_restaurant">
        <div class="btn_create_new_restaurant">
            <div class="left"></div>
            <div class="middle"><span><div class="text_center">Thêm khuyến mãi</div></span></div>
            <div class="right"></div>
        </div>
     </a>
   </div>
   -->
   <div class="restaurant_list">
     <!--title-->
     <ul class="box_info">
       <li class="stt_restaurant">
         <span>STT</span>
       </li>
<!--       <li class="code_restaurant">
         <span>Mã nhà hàng</span>
       </li>-->
       <li class="name_restaurant">
         <span>Tên nhà hàng</span>
       </li>
<!--       <li class="job_restaurant">
         <span>Nghề nghiệp</span>
       </li>-->
       <li class="email_restaurant">
         <span>Email</span>
       </li>
       <li class="phonenumber_restaurant">
         <span>Điện thoại</span>
       </li>
<!--       <li class="company">
         <span>Công ty</span>
       </li>-->
       <li class="update_delete">
       </li>
     </ul>
     
     <!--List member-->
     <?php
            $stt=1;
            foreach($all_restaurant as $value_res){
                         
             $id=$value_res['id'];
             $name=$value_res['name'];
             $phone_number= $value_res['phone_number'];
             $email= $value_res['email'];
             
             echo'
                    <ul class="box_info">
                      <li class="stt_restaurant">
                        <span>'.$stt.'</span>
                      </li>
                      <li class="name_restaurant">
                        <span>'.$name.'</span>
                      </li>
                      <li class="email_restaurant">
                        <span>'.$email.'</span>
                      </li>
                      <li class="phonenumber_restaurant">
                        <span>'.$phone_number.'</span>
                      </li>
                      <li class="update_delete">
                        <a href="'.$url.'index.php/admin/admin_controller/form_add_coupon?id_restaurant='.$id.'&name_res='.$name.'"><div class="add"></div></a>
                      </li>
                    </ul>

              ';
             
             $stt=$stt+1;
            }
     ?>
     
     
   </div>
   
    
    
    
    
  </div>
</div>