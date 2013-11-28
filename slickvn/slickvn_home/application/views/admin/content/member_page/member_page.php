
<?php $url=  base_url();?>


<div id="member_page">
  <div id="content_member_page">
   <div class="member_page_title">
     <span><div class=member_page_text">Danh sách thành viên</div></span>
   </div>
   <div class="line_title"></div></br>
   <div class="create_new_member">
     <a href="<?php echo $url;?>index.php/admin/admin_controller/create_new_member">
        <div class="btn_create_new_member">
            <div class="left"></div>
            <div class="middle"><span><div class="text_center">Tạo mới thành viên</div></span></div>
            <div class="right"></div>
        </div>
     </a>
   </div>
   <div class="member_list">
     <!--title-->
     <ul class="box_info">
       <li class="stt_member">
         <span>STT</span>
       </li>
<!--       <li class="code_member">
         <span>Mã thành viên</span>
       </li>-->
       <li class="name_member">
         <span>Họ và tên</span>
       </li>
<!--       <li class="job_member">
         <span>Nghề nghiệp</span>
       </li>-->
       <li class="email_member">
         <span>Email</span>
       </li>
       <li class="phonenumber_member">
         <span>Điện thoại</span>
       </li>
<!--       <li class="company">
         <span>Công ty</span>
       </li>-->
       <li class="update_delete">
       </li>
     </ul>
     
     
<?php 
$stt=1;
foreach ($all_user as $value_all_user){
      
      $id              =$value_all_user['id'];
      $full_name       =$value_all_user['full_name'];
      $email           =$value_all_user['email'];
      $phone_number    =$value_all_user['phone_number'];
      $address         =$value_all_user['address'];
      $location        =$value_all_user['location'];
      $avatar          =$value_all_user['avatar'];
      $role_list        =$value_all_user['role_list'];
      $created_date    =$value_all_user['created_date'];
      
      
     echo'
         <ul class="box_info">
            <li class="stt_member">
              <span>'.$stt.'</span>
            </li>
            <li class="name_member">
              <span>'.$full_name.'</span>
            </li>
            <li class="email_member">
              <span>'.$email.'</span>
            </li>
            <li class="phonenumber_member">
              <span>'.$phone_number.'</span>
            </li>
            <li class="update_delete">
              <a href="javascript:;" class="view_edit_user"  data-value_edit="'.$id.'"><div class="edit"></div></a>
              <a href="javascript:;" class="delete_user" data-value_delete="'.$id.'"><div class="delete" ></div></a>  
            </li>
          </ul>   

      ';
      
  $stt++;
  
}    
?>
     
   </div>
  </div>
</div>
<?php $url=  base_url(); ?>
<input type="hidden" value="<?php echo $url."index.php/admin/admin_controller/view_edit_user";?>" id="hdUrl_edit_user" >
<input type="hidden" value="<?php echo $url."index.php/admin/admin_controller/delete_user";?>" id="hdUrl_delete_user" >

<script>
  $(".view_edit_user").click(function (){
    var url=$("#hdUrl_edit_user").val();
    var data_value_edit=$(this).attr('data-value_edit');
    window.location=url+"?param_id="+data_value_edit;
  });
  $(".delete_user").click(function (){
      $(this).parent().parent().addClass('select_delete');
      
      
      var answer = confirm ("Bạn có chắc muốn xóa dữ liệu đang chọn không?")
      if (answer){
       var url=$("#hdUrl_delete_user").val();
       var data_value_delete=$(this).attr('data-value_delete');
       window.location=url+"?param_id="+data_value_delete;
       
      }
      else{
        $(this).parent().parent().removeClass('select_delete');
      }
       
  });
  
  
</script>