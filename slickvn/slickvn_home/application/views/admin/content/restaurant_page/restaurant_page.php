
<?php $url=  base_url();?>


<div id="restaurant_page">
  <div id="content_restaurant_page">
   <div class="restaurant_page_title">
     <span><div class="restaurant_page_text">Danh sách nhà hàng</div></span>
   </div>
   <div class="line_title"></div></br>
   <div class="create_new_restaurant">
     <a href="<?php echo $url;?>index.php/admin/admin_controller/create_new_restaurant">
        <div class="btn_create_new_restaurant">
            <div class="left"></div>
            <div class="middle"><span><div class="text_center">Tạo mới nhà hàng</div></span></div>
            <div class="right"></div>
        </div>
     </a>
   </div>
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
                        <a href="'.$url.'index.php/admin/admin_controller/edit_restaurant_page?id_restaurant='.$id.'"><div class="edit"></div></a>
                        <a href="javascript:;" onclick="return a"><div class="delete"></div></a>  
                      </li>
                    </ul>

              ';
             
             $stt=$stt+1;
            }
     ?>
     
     
   </div>
   
    
    
    
    
  </div>
</div>