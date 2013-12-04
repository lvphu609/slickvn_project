<?php $url=  base_url();?>


<div id="create_new_member">
  <div id="content_create_new_member">
   <div class="create_new_member_title">
     <span><div class=create_new_member_text"><?php echo $name_res;?></div></span>
   </div>
   <div class="line_title"></div></br>
   
   <div class="member_info_title">
     <span>Thông tin khuyến mãi</span>
   </div>
   
   <div class="box_input">
     <div class="name_profile">
        <span>GIÁ TRỊ KHUYẾN MÃI (%)*</span><br>
        <input id="param_value_coupon" class="input_text" type="text" placeholder="vd. 50" name="" >
     </div>
     <div class="job_profile">
        <span>THỜI GIAN BẮT ĐẦU*</span><br>
         <script src="<?php echo $url;?>includes/plugins/date_time_picker/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo $url;?>includes/plugins/date_time_picker/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo $url;?>includes/plugins/date_time_picker/jquery-ui-timepicker-addon.js"></script>
         <div class="date_time_picker">
            <div>
               <input id="param_date_coupon_start" class="input_text" type="text" placeholder="vd. 1/1/2014" name="">
            </div>					
           <script defer="true">
            $('#param_date_coupon_start').datetimepicker({
                  timeFormat: "hh:mm:00",
                  dateFormat: "dd-mm-yy"
            });
            </script>
          </div>
     </div>
     <div class="phone_number_profile">
        <span>THỜI GIAN KẾT THÚC*</span><br>
        <div class="date_time_picker">
          <div>
              <input id="param_date_coupon_end" class="input_text" type="text" placeholder="vd. 30/12/2014" name="">
          </div>					
          <script defer="true">
          $('#param_date_coupon_end').datetimepicker({

              timeFormat: "hh:mm:00",
              dateFormat: "dd-mm-yy"
          });
          </script>
        </div>
        
        
     </div>

     <div class="line_title"></div></br>
     <div class="introduce_member_profile">
        <span>MÔ TẢ THÔNG TIN KHUYẾN MÃI</span><br>
        <textarea id="param_description" class="input_textarea" name=""></textarea>
     </div>
    
     
     
     
     <div class="btn_save_cancel">
       <a href="javascript:;" onclick="return submit_save_info_coupon()">
        <div class="btn_save">
          <lable><div class="center_text">Lưu</div></lable>
        </div>
       </a>
       <a href="javascript:;" onclick="return submit_cancle()">
        <div class="btn_cancel">
          <lable><div class="center_text">Hủy</div></lable>
        </div>
       </a>
     </div>
     
   </div>
   
   
   
   
   
   
   
   
   
   
  </div>
</div>
<input type="hidden" value="<?php echo $id_res;?>" id="param_id_restaurant" >
<input type="hidden" value="<?php echo $url;?>" id="hdUrl" >
<script>
  function  submit_save_info_coupon(){
     var param_id_restaurant=$('#param_id_restaurant').val();
     var param_value_coupon=$('#param_value_coupon').val();
     var param_date_coupon_start=$('#param_date_coupon_start').val();
     var param_date_coupon_end=$('#param_date_coupon_end').val();
     var param_description=$('#param_description').val();
     
     
     var url=$("#hdUrl").val();
     var url_api=url+"index.php/admin/admin_controller/add_coupon";
     var data={
              id_restaurant:  param_id_restaurant,
              value_coupon:  param_value_coupon,
              date_coupon_start:  param_date_coupon_start,
              date_coupon_end:  param_date_coupon_end,
              description:  param_description
          }
  
     $.ajax({
          url: url_api ,
          type: 'POST',
          data:data,
          success: function(data){
             alert('them thanh cong');
             window.location=url+"index.php/admin/admin_controller/coupon_page";
          },

         //timeout:5000,
         error: function(a,textStatus,b){
           alert('khong thanh cong');
         }
       });
    
  }
  function submit_cancle(){
     var url=$("#hdUrl").val();
     window.location=url+"index.php/admin/admin_controller/coupon_page";
  
  }
  
  
</script>