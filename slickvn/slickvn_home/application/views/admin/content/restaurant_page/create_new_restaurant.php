<?php $url=  base_url();?>


<div id="create_new_restaurant">
  <div id="content_create_new_restaurant">
    <div class="create_new_restaurant_title">
     <span><div class=create_new_restaurant_text">Tạo mới nhà hàng</div></span>
   </div>
   <div class="line_title"></div></br>
   
   <div class="restaurant_info_title">
     <span>Thông tin nhà hàng</span>
   </div>
   
   <div class="box_input">
     <div class="image_restaurant"> 
       <span>ẢNH AVATAR ĐẠI DIỆN</span><br>
       <span>(Tải ảnh lên)</span>
        <script type="text/javascript" src="<?php echo $url;?>includes/plugins/post/scripts/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo $url;?>includes/plugins/post/scripts/jquery.form.js"></script>
          <script type="text/javascript" >
           $(document).ready(function() { 

              $('#photoimg').live('change', function()			{ 
                    $("#preview").html('');
                    $("#preview").html('<img src="<?php echo $url;?>includes/plugins/post/loader.gif" alt="Uploading...."/>');
                    $("#imageform").ajaxForm({
                      target: '#preview',
                      success: function(data) {
                        console.log(data);
                      }
                    }).submit();

              });
            }); 
          </script>
          <form id="imageform" method="post" enctype="multipart/form-data" action="http://localhost/slickvn/slickvn_api/include/modul_upload/avatar.php?url=<?php echo $url; ?>">
          <input type="file" name="photoimg" id="photoimg"  />
          </form>


          <div style="width:100%; height: 100%;" id='preview'>
          </div>
       
       
     </div>
     <div class="name_restaurant">
        <span>TÊN NHÀ HÀNG*</span><br>
        <input class="input_text" type="text" placeholder="vd. Hương Sen" name="" >
     </div>
     <div class="email_restaurant">
        <span>EMAIL</span><br>
        <input class="input_text" type="text" placeholder="vd. huongsen@gmail.com" name="">
     </div>
     <div class="address_restaurant">
        <span>ĐỊA CHỈ</span><br>
        <input class="input_text" type="text" placeholder="vd. Bình Chánh district, HCMC" name="">
     </div>
     <div class="phone_number_restaurant">
        <span>ĐIỆN THOẠI*</span><br>
        <input class="input_text" type="text" placeholder="vd. 01665847138" name="">
     </div>
     <div class="website_restaurant">
        <span>LINK WEB SITE NHÀ HÀNG</span><br>
        <input class="input_text" type="text" placeholder="vd. http://slick.vn" name="">
     </div>
<!--     <div class="facebock_url_profile">
        <span>FACEBOOK URL</span><br>
        <input class="input_text" type="text" placeholder="http://" name="">
     </div>
     <div class="code_restaurant_profile">
        <span>MÃ THÀNH VIÊN*</span><br>
        <input class="input_text" type="text" placeholder="vd. SLI1223" name="">
     </div>
     <div class="password_profile">
        <span>MẬT KHẨU BAN ĐẦU*</span><br>
        <input class="input_text" type="password" placeholder="vd. 123456" name="">
     </div>-->
     <div class="line_title"></div></br>
     <div class="introduce_short_restaurant">
        <span>MÔ TẢ NGẮN VỀ NHÀ HÀNG</span><br>
        <textarea class="input_textarea" name=""></textarea>
     </div>
     
     <!--phong cách ẩm thực-->
     <div class="box_select_option">
        <form id="FormAddListing_Culinary_Style">
          <span class="span_title">PHONG CÁCH ẨM THỰC</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Culinary_Style(this);" >
                     phong cach am thuc<span class="checkbox" id="phongcachamthuc11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end phong cách ẩm thực-->
     
      <!--mục đích-->
     <div class="box_select_option">
        <form id="FormAddListing_Mode_Use_List">
          <span class="span_title">MỤC ĐÍCH</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                    muc dich<span class="checkbox" id="mucdich7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Mode_Use_List(this);" >
                     muc dich<span class="checkbox" id="mucdich11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end mục đích-->
     
      <!--nhu cầu-->
     <div class="box_select_option">
        <form id="FormAddListing_Favourite_List">
          <span class="span_title">NHU CẦU</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                    nhu cầu<span class="checkbox" id="nhucau7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Favourite_List(this);" >
                     nhu cầu<span class="checkbox" id="nhucau11"></span>
                   </li>
          </ul>
          
        </form>
     </div>
     <!--end nhu cầu-->
     
      <!--hình thức thanh toán-->
     <div class="box_select_option">
        <form id="FormAddListing_Payment_Type_List">
          <span class="span_title">HÌNH THỨC THANH TOÁN</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                    hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Payment_Type_List(this);" >
                     hinh thuc thanh toan<span class="checkbox" id="hinhthucthanhtoan11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end hình thức thanh toán-->
     
      <!--ngoại cảnh-->
     <div class="box_select_option">
        <form id="FormAddListing_Landscape_List">
          <span class="span_title">NGOẠI CẢNH</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                    ngoai canh<span class="checkbox" id="ngoaicanh2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                    ngoai canh<span class="checkbox" id="ngoaicanh7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Landscape_List(this);" >
                     ngoai canh<span class="checkbox" id="ngoaicanh11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end ngoại cảnh-->
     
     <!--giá trung bình người-->
     <div class="box_select_option">
        <form id="FormAddListing_Price_Person_List">
          <span class="span_title">GIÁ TRUNG BÌNH NGƯỜI</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                    giá trng bình người<span class="checkbox" id="giatrungbinhnguoi2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                    giá trng bình người<span class="checkbox" id="giatrungbinhnguoi7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Price_Person_List(this);" >
                     giá trng bình người<span class="checkbox" id="giatrungbinhnguoi11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end giá trung bình người-->
     
      <!--các tiêu chí khác-->
     <div class="box_select_option">
        <form id="FormAddListing_Other_Criteria_List">
          <span class="span_title">CÁC TIÊU CHÍ KHÁC</span>
          <ul class="list_index">
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac1"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                    cac tieu chi khac<span class="checkbox" id="tieuchikhac2"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac3"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac4"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac5"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac6"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                    cac tieu chi khac<span class="checkbox" id="tieuchikhac7"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac8"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac9"></span>
                   </li>
                    <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac10"></span>
                   </li>
                   <li onclick="return onclickLiCheckListing_Other_Criteria_List(this);" >
                     cac tieu chi khac<span class="checkbox" id="tieuchikhac11"></span>
                   </li>
          </ul>
        </form>
     </div>
     <!--end các tiêu chí khác-->
     
     <!--giới thiệu nhà hàng-->
     <div class="box_select_option">
        <span class="span_title">BÀI VIẾT GIỚI THIỆU NHÀ HÀNG</span>
        <script src="<?php echo $url;?>includes/plugins/ckeditor/ckeditor.js"></script>
        <form action="#" method="post">
              <p>
                <textarea  class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
                </textarea>
              </p>
       </form>
     </div>
     <!--end giới thiệu nhà hàng-->
     
     <!--hình ảnh sử dụng cho bài viết-->
     <div class="box_select_option">
        <span class="span_title">HÌNH ẢNH SỬ DỤNG CHO BÀI VIẾT</span>
       
        <script type="text/javascript" >
                  
                 $(document).ready(function() { 
                          var stt=1;
                          $('#photoimg_post').live('change', function(){
                            var next = stt+1;
                            var new_div_preview_post = "<div class='preview_post' id='preview_post_"+next+"'></div>";
                            $("#append_img_content").append(new_div_preview_post);
                            $("#preview_post_"+stt).html('');
                            $("#preview_post_"+stt).html('<img src="<?php echo $url;?>includes/plugins/post/loader.gif" alt="Uploading...."/>');
                            $("#imageform_post").ajaxForm({
                              target: "#preview_post_"+stt

                             }).submit();
                              stt=stt+1;
                          });
                  }); 
                </script>
                <form id="imageform_post" method="post" enctype="multipart/form-data" action="http://localhost/slickvn/slickvn_api/include/modul_upload/content.php?url=<?php echo $url; ?>">
                  <div class="input_post_image_content"><input type="file" name="photoimg_post" id="photoimg_post" /></div>
                </form>
                
                <div id="append_img_content">
                  <div class="preview_post" id='preview_post_1'>
                  </div>
                  
                </div> 
     </div>
     <!--end hình ảnh sử dụng cho bài viết-->
     
     <!--carousel-->
      <div class="box_select_option">
        <span class="span_title">CAROUSEL</span>
        <script type="text/javascript" >
           $(document).ready(function() { 

              $('#photoimg_carousel').live('change', function()			{ 
                    $("#preview_carousel").html('');
                    $("#preview_carousel").html('<img src="<?php echo $url;?>includes/plugins/post/loader.gif" alt="Uploading...."/>');
                    $("#imageform_carousel").ajaxForm({
                      target: '#preview_carousel',
                      success: function(data) {
                        console.log(data);
                      }
                    }).submit();

              });
            }); 
          </script>
          <form id="imageform_carousel" method="post" enctype="multipart/form-data" action="http://localhost/slickvn/slickvn_api/include/modul_upload/avatar.php?url=<?php echo $url; ?>">
          <input type="file" name="photoimg_carousel" id="photoimg_carousel" />
          </form>


          <div style="width:100%; height: 100%;" id='preview_carousel'>
          </div>
     </div>
     <!--end carousel-->
     
     
     <div class="btn_save_cancel">
       <a href="<?php echo $url;?>index.php/admin/admin_controller/create_new_restaurant_success">
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

<script type="text/javascript" src="<?php echo $url;?>includes/plugins/post/scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>includes/plugins/post/scripts/jquery.form.js"></script>
<script>
  //phong cách ẩm thực=====================================================================>
  function onclickLiCheckListing_Culinary_Style(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_culinary_style[]" class="input_culinary_style_class" id="input_culinary_style' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Culinary_Style').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_culinary_style" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}

//muc dich======================================================================>
  function onclickLiCheckListing_Mode_Use_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_mode_use_list[]" class="input_mode_use_list_class" id="input_mode_use_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Mode_Use_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_mode_use_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}

//nhu cầu======================================================================>
  function onclickLiCheckListing_Favourite_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_favourite_list[]" class="input_favourite_list_class" id="input_favourite_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Favourite_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_favourite_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}

//hình thức thanh toán======================================================================>
  function onclickLiCheckListing_Payment_Type_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_payment_type_list[]" class="input_payment_type_list_class" id="input_payment_type_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Payment_Type_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_payment_type_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}

//ngoại cảnh======================================================================>
  function onclickLiCheckListing_Landscape_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_landscape_list[]" class="input_landscape_list_class" id="input_landscape_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Landscape_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_landscape_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}

//giá trung bình người======================================================================>
  function onclickLiCheckListing_Price_Person_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_price_person_list[]" class="input_price_person_list_class" id="input_price_person_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Price_Person_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_price_person_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}
//các tiêu chí khác======================================================================>
  function onclickLiCheckListing_Other_Criteria_List(obj){
    if($(obj).find('span').first().hasClass('checkbox')){
            $(obj).find('span').first().removeClass('checkbox').addClass('checkboxSelect');
            var myText = $(obj).text();
            var id = $(obj).find('span').first().attr('id');
            var newEle = '<input type="hidden" name="arr_other_criteria_list[]" class="input_other_criteria_list_class" id="input_other_criteria_list' + id + '" value="' + id + '"/>';
                        
           // $('ul.listSelectDanhBaDiaDiem').append('<li class="select' + id + '">'+ $(obj).text()+'</li>');
            $('#FormAddListing_Other_Criteria_List').append(newEle);
        }else{
            $(obj).find('span').first().removeClass('checkboxSelect').addClass('checkbox');
            var id=$(obj).find('span').first().attr('id');
            $("#input_other_criteria_list" + id ).remove();
            
           // $('ul.listSelectDanhBaDiaDiem .select' + id).remove();
        }
}


  
</script>