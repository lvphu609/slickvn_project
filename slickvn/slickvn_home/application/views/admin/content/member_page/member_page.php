
<?php $url=  base_url();?>


<div id="member_page">
  <div id="content_member_page">
   <div class="member_page_title">
     <span><div class=member_page_text">Danh sách thành viên</div></span>
   </div>
   <div class="create_new_member">
     <a href="<?php echo $url;?>index.php/admin/admin_controller/create_new_member">
        <div class="btn_create_new_member">
            <div class="left"></div>
            <div class="middle"><span><div class="text_center">Tạo mới thành viên</div></span></div>
            <div class="right"></div>
        </div>
     </a>
   </div>
   <div class="input_search_member">
     <div class="logo_search"></div>
     <div class="box_text_search">
       <input type="text" placeholder="Tìm kiếm" class="input_text_search" id="input_text_search" />
     </div>
     <div class="image_btn_search" id="btn_search_member">
     </div>
   </div>
    
   <div class="line_title"></div></br>
   
   <div class="member_list">
     <!--title-->
     <ul class="box_info">
       <li class="stt_member">
         <span class="index_bole">STT</span>
         <div class="line_index"></div>
       </li>
<!--       <li class="code_member">
         <span>Mã thành viên</span>
       </li>-->
       <li class="name_member">
         <span class="index_bole">Họ và tên</span>
         <div class="line_index"></div>
       </li>
<!--       <li class="job_member">
         <span>Nghề nghiệp</span>
       </li>-->
       <li class="email_member">
         <span class="index_bole">Email</span>
         <div class="line_index"></div>
       </li>
       <li class="phonenumber_member">
         <span class="index_bole">Điện thoại</span>
         <div class="line_index"></div>
       </li>
<!--       <li class="company">
         <span>Công ty</span>
       </li>-->
       <li class="update_delete">
         
       </li>
     </ul>
     
     
<?php 
$stt=1;
if(is_array($all_user)&&  sizeof($all_user)>0){
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
      
    if($stt%2==0){
      echo'
         <ul class="box_info row_color">
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
    }
    else{
      
       echo'
         <ul class="box_info ">
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
      
    }
     
     
     
      
  $stt++;
  
}
}
?>
     
   </div>
  </div>
</div>
<?php $url=  base_url(); ?>
<input type="hidden" value="<?php echo $url."index.php/admin/admin_controller/view_edit_user";?>" id="hdUrl_edit_user" >
<input type="hidden" value="<?php echo $url."index.php/admin/admin_controller/delete_user";?>" id="hdUrl_delete_user" >
<input type="hidden" value="<?php echo $url;?>" id="hidUrl"> 
<script>
  
   $(document).ready(function () {
         $('.delete_member').hide();
      });
  
  $(".view_edit_user").click(function (){
    var url=$("#hdUrl_edit_user").val();
    var data_value_edit=$(this).attr('data-value_edit');
    window.location=url+"?param_id="+data_value_edit;
  });
  $(".delete_user").click(function (){
      $(this).parent().parent().addClass('select_delete');
      var url=$("#hdUrl_delete_user").val();
      var data_value_delete=$(this).attr('data-value_delete');
   
      $( ".delete_member" ).dialog({
          title: "Thông báo", 
          show: "scale",
          hide: "explode",
          closeOnEscape: true,
          modal: true,
          minWidth: 200,
          minHeight: 200,

          resizable: false,
          height:200,
          modal: true,
          buttons: {
            "Xóa": function() {
              window.location=url+"?param_id="+data_value_delete;
              $( this ).dialog( "close" );
            },
            "Hủy": function() {
              $(".delete_user").parent().parent().removeClass('select_delete');
              $( this ).dialog( "close" );
            }
          }
    
      });
       
       
       
  });
  
 //search member
 $('#btn_search_member').click(function (){
    
    var input_text_search=$("#input_text_search").val();
    var url= $("#hidUrl").val();
    var url_search_member=url+'index.php/search/search/admin_search_member';
    window.location=url_search_member+"?input_text_search="+input_text_search;
 
 });
 
  
  
  
  
</script>

  <div class="delete_member" title="Thông báo">  
    <lable class="label">Bạn có chắc muốn xóa dữ liệu đang chọn không!</lable></br>
    <!--<button type="button" id="btnYes" class="btn btn-warning">Đồng ý</button>
    <button type="button" id="btnNo" class="btn btn-warning">Hủy</button>-->
  </div>

