
<?php $url=  base_url(); 

 foreach ($info_restaurant as $info_detail_restaurant) {
   

      $id=                    $info_detail_restaurant['id'];
      //$id_user=               $info_detail_restaurant['id_user'];
      $id_menu_dish=          $info_detail_restaurant['id_menu_dish'];
      $id_coupon=             $info_detail_restaurant['id_coupon'];
      $name=                  $info_detail_restaurant['name'];
      $number_view=           $info_detail_restaurant['number_view'];
      $number_assessment=     $info_detail_restaurant['number_assessment'];
      $rate_point=            $info_detail_restaurant['rate_point'];
      $number_like=           $info_detail_restaurant['number_like'];
      $number_share=          $info_detail_restaurant['number_share'];
      $rate_service=          $info_detail_restaurant['rate_service'];
      $rate_landscape=        $info_detail_restaurant['rate_landscape'];
      $rate_taste=            $info_detail_restaurant['rate_taste'];
      $rate_price=            $info_detail_restaurant['rate_price'];
      $address=               $info_detail_restaurant['address'];
      $image_introduce_link=  $info_detail_restaurant['image_introduce_link'];
      $image_carousel_link=   $info_detail_restaurant['image_carousel_link'];
      $link_to=               $info_detail_restaurant['link_to'];
      $phone_number=          $info_detail_restaurant['phone_number'];
      $working_time=          $info_detail_restaurant['working_time'];
      $status_active=         $info_detail_restaurant['status_active'];
     // $favourite_list=        $info_detail_restaurant['favourite_list'];
    //  $price_person_list=     $info_detail_restaurant['price_person_list'];
    //  $culinary_style_list=   $info_detail_restaurant['culinary_style_list'];
      $mode_use_list_string=         $info_detail_restaurant['mode_use_list'];
      $mode_use_list_string = substr($mode_use_list_string,2);
      $mode_use_list=   explode(",",$mode_use_list_string);
      
      $payment_type_list_string=     $info_detail_restaurant['payment_type_list'];
      $payment_type_list_string = substr($payment_type_list_string,2);
      $payment_type_list=   explode(",",$payment_type_list_string);
      
      
      
      $landscape_list_string=        $info_detail_restaurant['landscape_list'];
      $landscape_list_string = substr($landscape_list_string,2);
      $landscape_list=   explode(",",$landscape_list_string);
      
      
      $other_criteria_list_string=   $info_detail_restaurant['other_criteria_list'];
      $other_criteria_list_string = substr($other_criteria_list_string,2);
      $other_criteria_list= explode(",",$other_criteria_list_string);
      
      $introduce=             $info_detail_restaurant['introduce'];
      //noi dung gioi thieu, tim va thay the folder_image_introduce_detail_page bang duong dan host
      $introduce = htmlspecialchars_decode ($introduce);
      $introduce =  str_replace("folder_image_introduce_detail_page",$link_restaurant_frofile, $introduce);
      
      
      
      
      $start_date=            $info_detail_restaurant['start_date'];
      $end_date=              $info_detail_restaurant['end_date'];
      $created_date=          $info_detail_restaurant['created_date'];
      $desc=                  $info_detail_restaurant['desc'];
       $email=                 $info_detail_restaurant['email'];
       
       
        $favourite_list=$info_detail_restaurant['favourite_list'];
        $favourite_list=substr($favourite_list, 1); 

        $price_person_list=$info_detail_restaurant['price_person_list'];
        $price_person_list=substr($price_person_list, 1); 

        $culinary_style_list=$info_detail_restaurant['culinary_style_list'];
        $culinary_style_list=substr($culinary_style_list, 1);

 }
 ?>



<input type="hidden" value="<?php echo $url;?>" id="hidUrl"> 

<script>
  
  $(document).ready(function() {
       
//     var url =document.URL;
//     var str= url.substr(0, url.indexOf('index.php')); 
//      alert(str);
         //gioi thieu nha hang
       
          $("#introduce_restaurant").css({
            display: "block",
            width: "734px",
            marginLeft: "10px",
            marginRight: "10px",
            height: "auto",
            float: "left",
            background: "#FFF",
            marginBottom: "20px",
            marginTop: "20px",
            visibility: ""

          });
        
        
         $("#info_restaurant").css({
            display: "none"
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
            display: "none"
          
        });
        //binh luận
         $("#comment_restaurant").css({
            display: "none"
          
        });
    
    
   });
  
  
  
  
  $(function(){
    
     /*Giới thiệu nhà hàng--------------------------------------------------------------------*/
    $('#btn_introduce').click(function() {
        $("#status_clicked_1").addClass('active');
        $("#status_clicked_2").removeClass('active');
        $("#status_clicked_3").removeClass('active');
        $("#status_clicked_4").removeClass('active'); 
        
        //gioi thieu nha hang
        $("#introduce_restaurant").css({
           display: "block",
          width: "734px",
          marginLeft: "10px",
          marginRight: "10px",
          height: "auto",
          float: "left",
          background: "#FFF",
          marginBottom: "20px",
          marginTop: "20px",
          visibility: ""
          
        });
        
         //thong tin nha hang
         $("#info_restaurant").css({
            display: "none"
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
           display: "none"
          
        });
        //binh luận
         $("#comment_restaurant").css({
           display: "none"
          
        });
        
        
    });
    
    
    /*thông tin nhà hàng-------------------------------------------------------------------------------*/
    $('#btn_info_restaurant').click(function() {
      //alert("thông tin nhà hàng");
     // var url = $('#hidUrl').val();
       
        $("#status_clicked_1").removeClass('active');
        $("#status_clicked_2").addClass('active');
        $("#status_clicked_3").removeClass('active');
        $("#status_clicked_4").removeClass('active');
        
         //gioi thieu nha hang
        $("#introduce_restaurant").css({
          display: "none"
          
        });
        
         //thong tin nha hang
         $("#info_restaurant").css({
            display: "block",
            width: "734px",
            marginLeft: "10px",
            marginRight: "10px",
            height: "auto",
            float: "left",
            background: "#FFF",
            marginBottom: "20px",
            marginTop: "20px",
            visibility: ""
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
            display: "none"
          
        });
        //binh luận
         $("#comment_restaurant").css({
            display: "none"
          
        });
        
                                  
    });
    
    
    /*tiện ích--------------------------------------*/
    $('#btn_utilities_restaurant').click(function() {
        $("#status_clicked_1").removeClass('active');
        $("#status_clicked_2").removeClass('active');
        $("#status_clicked_3").addClass('active');
        $("#status_clicked_4").removeClass('active'); 
        
        //gioi thieu nha hang
        $("#introduce_restaurant").css({
            display: "none"
          
        });
        
         //thong tin nha hang
         $("#info_restaurant").css({
            display: "none"
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
            display: "block",
            width: "734px",
            marginLeft: "10px",
            marginRight: "10px",
            height: "auto",
            float: "left",
            background: "#FFF",
            marginBottom: "20px",
            marginTop: "20px",
            visibility: ""
          
        });
        //binh luận
         $("#comment_restaurant").css({
           display: "none"
          
        });
        
        
                                  
    });
     /*binh luận--------------------------------------*/
    $('#btn_comment_restaurant').click(function() {
        $("#status_clicked_1").removeClass('active');
        $("#status_clicked_2").removeClass('active');
        $("#status_clicked_3").removeClass('active');
        $("#status_clicked_4").addClass('active'); 
        
        //gioi thieu nha hang
        $("#introduce_restaurant").css({
            display: "none"
          
        });
        
         //thong tin nha hang
         $("#info_restaurant").css({
           display: "none"
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
            display: "none"
          
        });
        //binh luận
         $("#comment_restaurant").css({
            display: "block",
            width: "734px",
            marginLeft: "10px",
            marginRight: "10px",
            height: "auto",
            float: "left",
            background: "#FFF",
            marginBottom: "20px",
            marginTop: "20px",
            visibility: ""
          
        });
        
                                  
    });
     
     
     //btn_đánh giá
        /*--------------------------------------*/
    $('#btn_danhgia').click(function() {
        $("#status_clicked_1").removeClass('active');
        $("#status_clicked_2").removeClass('active');
        $("#status_clicked_3").removeClass('active');
        $("#status_clicked_4").addClass('active'); 
        
        //gioi thieu nha hang
        $("#introduce_restaurant").css({
            display: "none"
          
        });
        
         //thong tin nha hang
         $("#info_restaurant").css({
            display: "none"
          
        });
        //tiện ích
         $("#utilities_restaurant").css({
            display: "none"
          
        });
        //binh luận
         $("#comment_restaurant").css({
            display: "block",
            width: "734px",
            marginLeft: "10px",
            marginRight: "10px",
            height: "auto",
            float: "left",
            background: "#FFF",
            marginBottom: "20px",
            marginTop: "20px",
            visibility: ""
          
        });
        
                                  
    });
    
     
    
  }); 
</script>

<div id="tabs_detail_restaurant">
  <div class="tabs_align_center">
    <div class="tabs_title">
      <div class="menu">
        <ul id="ul_menu">
          <a href="javascript:;" id="btn_introduce">
            <li id="status_clicked_1" class="active">
              <span>GIỚI THIỆU</span><i></i>
            </li>
          </a>
          <a href="javascript:;" id="btn_info_restaurant">
            <li id="status_clicked_2" class="">
              <span>THÔNG TIN NHÀ HÀNG</span><i></i>
            </li>
          </a>
          <a href="javascript:;" id="btn_utilities_restaurant">
            <li id="status_clicked_3"  class="">
              <span>TIỆN ÍCH</span><i></i>
            </li>
          </a>
          <a href="javascript:;" id="btn_comment_restaurant">
            <li id="status_clicked_4" class="">
              <span>BÌNH LUẬN</span>
            </li>
          </a>
        </ul>
      </div>
    </div>
    <div class="line_tabs"></div>
    
    <div class="tabs_left">
      <!--giới thiệu nhà hàng- active_hidden_introduce_restaurant-->
      <div id="introduce_restaurant" >
             <!--post introduce-->
                  <?php //echo $introduce; ?>
             <!--end post introduce-->
             
             <!--text example-->
              <?php echo $introduce; ?>
             
             <!--end text example-->
             
             
             
             
      </div>
      <!--end giới thiệu nhà hàng-->
      
    <!--==============thông tin nhà hàng=================================-->
    <div id="info_restaurant">
      <div class="box_detail_info_restaurant">
        <div class="line_top"></div>
        <ul class="ul_detail_info_restaurant">
          <li>
            <div class="info_left">
              <span>
                Địa chỉ:
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php echo $address;?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Điện thoại:
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php echo $phone_number;?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Email:
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php echo $email;?>
              
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Website:
              </span>
            </div>
            <div class="info_right">
              <span>
                <a href="#" ><?php echo $link_to;?></a>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Giờ làm việc:
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php echo $working_time;?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Tình trạng:
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php echo $status_active;?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Mục Đích
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php 
                    /*
                    foreach ($favourite_list as $value_favourite) {
                      
                      echo $value_favourite;
                      
                      echo ", ";

                     }*/
                echo $favourite_list;
                ?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Giá trung bình/người
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php 
                    
                   /* foreach ($price_person_list as $value_price_person_list) {
                      
                      echo $value_price_person_list;
                      
                      echo ", ";

                     }*/
                echo $price_person_list;
                ?>
              </span>
            </div>
            
          </li>
          
          <li>
            <div class="info_left">
              <span>
                Phong cách ẩm thực
              </span>
            </div>
            <div class="info_right">
              <span>
                <?php 
                    /*
                    foreach ($culinary_style_list as $value_culinary_style_list) {
                      
                      echo $value_culinary_style_list;
                      
                      echo ", ";

                     }*/
                   echo $culinary_style_list;
                ?>
              </span>
            </div>
            
          </li>
          
          <div class="line_bottom">
            <div class="detail_line_bottom">
              <span>Món ăn đặc trưng: &nbsp;</span>
              <span>Cơm chiên, Lẩu hải sản</span>
            </div>
          </div>
        </ul>
      </div>
    </div>
    <!--===============================end thông tin nhà hàng====================-->
    
    <!--==============tiện ích=================================-->
    <div id="utilities_restaurant">
      <!--thanh toán-->
      <div class="box_tienich">
        <div class="top_title"><span><div class="span_center">Cách thanh toán</div></span></div>
        <ul class="detail_box_tienich" >
          <?php 
                //var_dump($payment_type_list);
                $str_payment=array("Thẻ Debit","Tiền mặt","Thẻ ATM","Thẻ tín dụng");
               // var_dump( array_intersect($payment_type_list, $str_payment));
               // var_dump($str_payment);
               // var_dump($payment_type_list);
                foreach ($payment_type_list as $value_payment_type_list) {
                  
                  $value_payment_type_list = trim($value_payment_type_list);
                  
                  if(strcmp($value_payment_type_list,"Thẻ Debit")==0)
                  {
                    echo'<li>
                          <span class="image_status icon_Dedit"></span>
                          <span class="content">Thẻ Debit</span>            
                        </li>';
                    
                  }
                  if(strcmp($value_payment_type_list,"Tiền mặt")==0)
                  {
                    echo'<li>
                            <span class="image_status icon_tienmat"></span>
                            <span class="content">Tiền mặt</span>            
                          </li>';
                    
                  }
                   if($value_payment_type_list=="Thẻ ATM")
                  {
                    echo'<li>
                            <span class="image_status icon_atm"></span>
                            <span class="content">Thẻ ATM</span>            
                          </li>';
                    
                  }
                   if($value_payment_type_list=="Thẻ tín dụng")
                  {
                     echo'<li>
                            <span class="image_status icon_thetindung"></span>
                            <span class="content">Thẻ tín dụng</span>            
                          </li>';
                    
                  }
                     //xóa bỏ những phần tử có trong mảng $str_payment
                      $index = array_search($value_payment_type_list,$str_payment);
                      if($index !== FALSE){
                          unset($str_payment[$index]);
                      }
                  
                  
                 }
                // var_dump($str_payment);
                 //những cách thanh toán chưa có
              foreach ($str_payment as $str_payment) {
                   if($str_payment=="Thẻ Debit")
                    {
                      echo'<li>
                            <span class="image_status icon_Dedit_xam"></span>
                            <span class="content">Thẻ Debit</span>            
                          </li>';

                    }
                    if($str_payment=="Tiền mặt")
                    {
                      echo'<li>
                              <span class="image_status icon_tienmat_xam"></span>
                              <span class="content">Tiền mặt</span>            
                            </li>';

                    }
                     if($str_payment=="Thẻ ATM")
                    {
                      echo'<li>
                              <span class="image_status icon_atm_xam"></span>
                              <span class="content">Thẻ ATM</span>            
                            </li>';

                    }
                     if($str_payment=="Thẻ tín dụng")
                    {
                       echo'<li>
                              <span class="image_status icon_thetindung_xam"></span>
                              <span class="content">Thẻ tín dụng</span>            
                            </li>';

                    }
                   
                 }
                   
          ?>
          
          
<!--            <li>
              <span class="image_status icon_atm"></span>
              <span class="content">Thẻ ATM</span>            
            </li>
            <li>
              <span class="image_status icon_thetindung"></span>
              <span class="content">Thẻ tín dụng</span>            
            </li>
            <li>
              <span class="image_status icon_tienmat"></span>
              <span class="content">Tiền mặt</span>            
            </li>
            <li>
              <span class="image_status icon_Dedit"></span>
              <span class="content">Thẻ Debit</span>            
            </li>-->
            
            
            
         </ul>
      </div>
      <!--tieu chi khac-->
      <div class="box_tienich">
        <div class="top_title"><span><div class="span_center">Tiêu chí khác</div></span></div>
        <ul class="detail_box_tienich" >
           <?php 
                
                $arr_other_criteria_list=array("Âm thanh, máy chiếu",
                                               "Bãi đậu xe hơi",
                                               "Bãi đậu xe máy",
                                               "Ghế ngồi cho trẻ em",
                                               "Karaoke",
                                               "Khu vui chơi cho trẻ em",
                                               "Máy lạnh/lò sưởi",
                                               "Phòng VIP",
                                               "Wifi"
                                                    );
                foreach ($other_criteria_list as $other_criteria_list) {
                  $other_criteria_list = trim($other_criteria_list);
                  if($other_criteria_list=="Âm thanh, máy chiếu")
                  {
                    echo'<li>
                          <span class="image_status icon_amthanh_maychieu"></span>
                          <span class="content">Âm thanh, máy chiếu</span>            
                        </li>';
                    
                  }
                  if($other_criteria_list=="Bãi đậu xe hơi")
                  {
                    echo'<li>
                          <span class="image_status icon_baidauxehoi"></span>
                          <span class="content">Bãi đậu xe hơi</span>            
                        </li>';
                    
                  }
                  if($other_criteria_list=="Bãi đậu xe máy")
                  {
                    echo' <li>
                            <span class="image_status icon_baidauxemay"></span>
                            <span class="content">Bãi đậu xe máy</span>            
                          </li>';
                    
                  }
                  if($other_criteria_list=="Ghế ngồi cho trẻ em")
                  {
                    echo'<li>
                            <span class="image_status icon_ghengoitreem"></span>
                            <span class="content">Ghế ngồi cho trẻ em</span>            
                          </li>';
                    
                  }
                  if($other_criteria_list=="Karaoke")
                  {
                    echo'<li>
                          <span class="image_status icon_karaoke"></span>
                          <span class="content">Karaoke</span>            
                        </li>';
                    
                  }
                  if($other_criteria_list=="Khu vui chơi cho trẻ em")
                  {
                    echo'<li>
                          <span class="image_status icon_khuvuichoi"></span>
                          <span class="content">Khu vui chơi cho trẻ em</span>            
                        </li>';
                    
                  }
                  if($other_criteria_list=="Máy lạnh/lò sưởi")
                  {
                    echo'
                       <li>
                          <span class="image_status icon_maylanh"></span>
                          <span class="content">Máy lạnh/Lò sưởi</span>            
                        </li>';
                    
                  }
                   if($other_criteria_list=="Phòng VIP")
                  {
                    echo'
                       <li>
                          <span class="image_status icon_phongvip"></span>
                          <span class="content">Phòng VIP</span>            
                        </li>';
                    
                  }
                   if($other_criteria_list=="Wifi")
                  {
                    echo'
                      <li>
                        <span class="image_status icon_wifi"></span>
                        <span class="content">Wifi</span>            
                      </li>';
                    
                  }
                
                     //xóa bỏ những phần tử có trong mảng $arr_other_criteria_list
                      $index = array_search($other_criteria_list,$arr_other_criteria_list);
                      if($index !== FALSE){
                          unset($arr_other_criteria_list[$index]);
                      }
                  
                  
                 }
                 //những cách thanh toán chưa có
                 foreach ($arr_other_criteria_list as $arr_other_criteria_list) {
                        if($arr_other_criteria_list=="Âm thanh, máy chiếu")
                       {
                         echo'<li>
                               <span class="image_status icon_amthanh_maychieu_xam"></span>
                               <span class="content">Âm thanh, máy chiếu</span>            
                             </li>';

                       }
                       if($arr_other_criteria_list=="Bãi đậu xe hơi")
                       {
                         echo'<li>
                               <span class="image_status icon_baidauxehoi_xam"></span>
                               <span class="content">Bãi đậu xe hơi</span>            
                             </li>';

                       }
                       if($arr_other_criteria_list=="Bãi đậu xe máy")
                       {
                         echo' <li>
                                 <span class="image_status icon_baidauxemay_xam"></span>
                                 <span class="content">Bãi đậu xe máy</span>            
                               </li>';

                       }
                       if($arr_other_criteria_list=="Ghế ngồi cho trẻ em")
                       {
                         echo'<li>
                                 <span class="image_status icon_ghengoitreem_xam"></span>
                                 <span class="content">Ghế ngồi cho trẻ em</span>            
                               </li>';

                       }
                       if($arr_other_criteria_list=="Karaoke")
                       {
                         echo'<li>
                               <span class="image_status icon_karaoke_xam"></span>
                               <span class="content">Karaoke</span>            
                             </li>';

                       }
                       if($arr_other_criteria_list=="Khu vui chơi cho trẻ em")
                       {
                         echo'<li>
                               <span class="image_status icon_khuvuichoi_xam"></span>
                               <span class="content">Khu vui chơi cho trẻ em</span>            
                             </li>';

                       }
                       if($arr_other_criteria_list=="Máy lạnh/lò sưởi")
                       {
                         echo'
                            <li>
                               <span class="image_status icon_maylanh_xam"></span>
                               <span class="content">Máy lạnh/Lò sưởi</span>            
                             </li>';

                       }
                        if($arr_other_criteria_list=="Phòng VIP")
                       {
                         echo'
                            <li>
                               <span class="image_status icon_phongvip_xam"></span>
                               <span class="content">Phòng VIP</span>            
                             </li>';

                       }
                        if($arr_other_criteria_list=="Wifi")
                       {
                         echo'
                           <li>
                             <span class="image_status icon_wifi_xam"></span>
                             <span class="content">Wifi</span>            
                           </li>';

                       }
                    
                   
                 }
                   
          ?>
          
          
<!--            <li>
              <span class="image_status icon_amthanh_maychieu_xam"></span>
              <span class="content">Âm thanh, máy chiếu</span>            
            </li>
            <li>
              <span class="image_status icon_baidauxehoi"></span>
              <span class="content">Bãi đậu xe hơi</span>            
            </li>
            <li>
              <span class="image_status icon_baidauxemay"></span>
              <span class="content">Bãi đậu xe máy</span>            
            </li>
            <li>
              <span class="image_status icon_ghengoitreem_xam"></span>
              <span class="content">Ghế ngồi cho trẻ em</span>            
            </li>
             <li>
              <span class="image_status icon_karaoke"></span>
              <span class="content">Karaoke</span>            
            </li>
            <li>
              <span class="image_status icon_khuvuichoi_xam"></span>
              <span class="content">Khu vui chơi cho trẻ em</span>            
            </li>
            <li>
              <span class="image_status icon_maylanh"></span>
              <span class="content">Máy lạnh/Lò sưởi</span>            
            </li>
            <li>
              <span class="image_status icon_phongvip"></span>
              <span class="content">Phòng VIP</span>            
            </li>
            <li>
              <span class="image_status icon_wifi"></span>
              <span class="content">Wifi</span>            
            </li>-->
          </ul>
      </div>
      <!--phuong thuc su dung-->
      <div class="box_tienich">
        <div class="top_title"><span><div class="span_center">Phương thức sử dụng</div></span></div>
        <ul class="detail_box_tienich" >
          
          
          
          <?php
          $arr_mode_use_list=array("Đặt tiệc tận nhà",
                                               "Giao tận nơi",
                                               "Mang về",
                                               "Ăn tại nhà hàng"
                                                    );
                
                foreach ($mode_use_list as $mode_use_list) {
                  $mode_use_list = trim($mode_use_list);
                  if($mode_use_list=="Đặt tiệc tận nhà")
                  {
                    echo' <li>
                          <span class="image_status icon_dattiectainha"></span>
                          <span class="content">Đặt tiệc tận nhà</span>            
                        </li>';
                    
                  }
                  if($mode_use_list=="Giao tận nơi")
                  {
                    echo'<li>
                          <span class="image_status icon_giaohangtannoi"></span>
                          <span class="content">Giao tận nơi</span>            
                        </li>';
                    
                  }
                  if($mode_use_list=="Mang về")
                  {
                    echo' <li>
                            <span class="image_status icon_mangve"></span>
                            <span class="content">Mang về</span>            
                          </li>';
                    
                  }
                  if($mode_use_list=="Ăn tại nhà hàng")
                  {
                    echo'<li>
                          <span class="image_status icon_antainhahang"></span>
                          <span class="content">Ăn tại nhà hàng</span>            
                        </li>';
                    
                  }
                  
                
                     //xóa bỏ những phần tử có trong mảng $mode_use_list
                      $index = array_search($mode_use_list,$arr_mode_use_list);
                      if($index !== FALSE){
                          unset($arr_mode_use_list[$index]);
                      }
                  
                  
                 }
                 //những cách thanh toán chưa có
                 foreach ($arr_mode_use_list as $arr_mode_use_list) {
                       if($mode_use_list=="Đặt tiệc tận nhà")
                  {
                    echo' <li>
                          <span class="image_status icon_dattiectainha_xam"></span>
                          <span class="content">Đặt tiệc tận nhà</span>            
                        </li>';
                    
                  }
                  if($mode_use_list=="Giao tận nơi")
                  {
                    echo'<li>
                          <span class="image_status icon_giaohangtannoi_xam"></span>
                          <span class="content">Giao tận nơi</span>            
                        </li>';
                    
                  }
                  if($mode_use_list=="Mang về")
                  {
                    echo' <li>
                            <span class="image_status icon_mangve_xam"></span>
                            <span class="content">Mang về</span>            
                          </li>';
                    
                  }
                  if($mode_use_list=="Ăn tại nhà hàng")
                  {
                    echo'<li>
                          <span class="image_status icon_antainhahang_xam"></span>
                          <span class="content">Ăn tại nhà hàng</span>            
                        </li>';
                    
                  }
                    
                   
                 }
                   
          ?>
          
          
<!--            <li>
              <span class="image_status icon_dattiectainha"></span>
              <span class="content">Đặt tiệc tận nhà</span>            
            </li>
            <li>
              <span class="image_status icon_giaohangtannoi"></span>
              <span class="content">Giao tận nơi</span>            
            </li>
            <li>
              <span class="image_status icon_mangve"></span>
              <span class="content">Mang về</span>            
            </li>
            <li>
              <span class="image_status icon_antainhahang_xam"></span>
              <span class="content">Ăn tại nhà hàng</span>            
            </li>-->
          </ul>
      </div>
      <!--quan canh-->
      <div class="box_tienich">
        <div class="top_title"><span><div class="span_center">Quang cảnh</div></span></div>
        <ul class="detail_box_tienich" >
          <?php 
               
                $arr_landscape_list=array("Canh ban công",
                                               "Cảnh biển",
                                               "Cảnh sân thượng",
                                               "Cảnh sông",
                                               "Ngoài trời",
                                               "Quán vỉa hè",
                                               "Sân vườn"
                                                    );
                
                foreach ($landscape_list as $landscape_list) {
                   $landscape_list = trim($landscape_list);
                  if($landscape_list=="Canh ban công")
                  {
                    echo'<li>
                          <span class="image_status icon_canhbancong"></span>
                          <span class="content">Cảnh ban công</span>            
                        </li>';
                  }
                  if($landscape_list=="Cảnh biển")
                  {
                    echo' <li>
                            <span class="image_status icon_canhbien"></span>
                            <span class="content">Cảnh biển</span>            
                          </li>';
                  }
                  if($landscape_list=="Cảnh sân thượng")
                  {
                    echo'<li>
                            <span class="image_status icon_canhsanthuong"></span>
                            <span class="content">Cảnh sân thượng</span>            
                          </li>';
                  }
                  if($landscape_list=="Cảnh sông")
                  {
                    echo'<li>
                          <span class="image_status icon_canhsong"></span>
                          <span class="content">Cảnh sông</span>            
                        </li>';
                  }
                  if($landscape_list=="Ngoài trời")
                  {
                    echo'<li>
                          <span class="image_status icon_canhngoaitroi"></span>
                          <span class="content">Ngoài trời</span>            
                        </li>';
                  }
                  if($landscape_list=="Quán vỉa hè")
                  {
                    echo'<li>
                          <span class="image_status icon_canhviahe"></span>
                          <span class="content">Quán vỉa hè</span>            
                        </li>';
                  }
                  if($landscape_list=="Sân vườn")
                  {
                    echo'<li>
                          <span class="image_status icon_canhsanvuon"></span>
                          <span class="content">Sân vườn</span>            
                        </li>';
                  }
                  
                
                  
                  
                  //xóa bỏ những phần tử có trong mảng $arr_other_criteria_list
                   $index = array_search($other_criteria_list,$arr_landscape_list);
                   if($index !== FALSE){
                       unset($arr_landscape_list[$index]);
                   }
                  
                  
                 }
                 //những cách thanh toán chưa có
                 foreach ($arr_landscape_list as $arr_landscape_list) {
                        
                        if($arr_landscape_list=="Canh ban công")
                      {
                        echo'<li>
                              <span class="image_status icon_canhbancong_xam"></span>
                              <span class="content">Cảnh ban công</span>            
                            </li>';
                      }
                      if($arr_landscape_list=="Cảnh biển")
                      {
                        echo' <li>
                                <span class="image_status icon_canhbien_xam"></span>
                                <span class="content">Cảnh biển</span>            
                              </li>';
                      }
                      if($arr_landscape_list=="Cảnh sân thượng")
                      {
                        echo'<li>
                                <span class="image_status icon_canhsanthuong_xam"></span>
                                <span class="content">Cảnh sân thượng</span>            
                              </li>';
                      }
                      if($arr_landscape_list=="Cảnh sông")
                      {
                        echo'<li>
                              <span class="image_status icon_canhsong_xam"></span>
                              <span class="content">Cảnh sông</span>            
                            </li>';
                      }
                      if($arr_landscape_list=="Ngoài trời")
                      {
                        echo'<li>
                              <span class="image_status icon_canhngoaitroi_xam"></span>
                              <span class="content">Ngoài trời</span>            
                            </li>';
                      }
                      if($arr_landscape_list=="Quán vỉa hè")
                      {
                        echo'<li>
                              <span class="image_status icon_canhviahe_xam"></span>
                              <span class="content">Quán vỉa hè</span>            
                            </li>';
                      }
                      if($arr_landscape_list=="Sân vườn")
                      {
                        echo'<li>
                              <span class="image_status icon_canhsanvuon_xam"></span>
                              <span class="content">Sân vườn</span>            
                            </li>';
                      }
                  
                   
                 }
                   
          ?>
          
          
          
          
<!--            <li>
              <span class="image_status icon_canhbancong"></span>
              <span class="content">Cảnh ban công</span>            
            </li>
            <li>
              <span class="image_status icon_canhbien"></span>
              <span class="content">Cảnh biển</span>            
            </li>
            <li>
              <span class="image_status icon_canhsanthuong_xam"></span>
              <span class="content">Cảnh sân thượng</span>            
            </li>
            <li>
              <span class="image_status icon_canhsong"></span>
              <span class="content">Cảnh sông</span>            
            </li>
            <li>
              <span class="image_status icon_canhngoaitroi"></span>
              <span class="content">Ngoài trời</span>            
            </li>
            <li>
              <span class="image_status icon_canhviahe_xam"></span>
              <span class="content">Quán vỉa hè</span>            
            </li>
            <li>
              <span class="image_status icon_canhsanvuon"></span>
              <span class="content">Sân vườn</span>            
            </li>-->
            
            
            
            
          </ul>
      </div>
      
    </div>
    <!--===============================end tiện ích====================-->
    
    <!--==============Bình luận=================================-->
    <div id="comment_restaurant">
      
      
      <div class="box_your_comment">
        <div class="your_avatar">
          <a href="javascript:;">
                <img src="http://dendau.vn/style/avatar/10.gif" >
          </a>
        </div>
        <div class="box_form_comment">
            <form action="javascript:;" method="post" name="review_inline" id="review_inline" class="form-comment" onsubmit="return false">
                <input id="id_restaurant" value="restaurant_id 1" type="hidden">
                <input id="id_user" value="hjhjkhkghjw" type="hidden">
                <input id="email_user" value="lvphu609@gmail.com" type="hidden">
                <input id="fullname_fullname" value="Lê Vĩnh Phú" type="hidden">

                <div class="box_comment_top">
                  <ul class="list_vote_rating">
                    <li>
                      <div class="left">Dịch vụ:</div>
                      <div class="right">
                        <div class="rating_comment_service" data-average="0" data-id="1"></div>
                      </div>
                    </li>
                    <li>
                      <div class="left">Quang cảnh:</div>
                      <div class="right">
                        <div class="rating_comment_landscap" data-average="0" data-id="2"></div>
                      </div>                    
                    </li>
                    <li>
                      <div class="left">Giá cả:</div>
                      <div class="right">
                        <div class="rating_comment_price" data-average="0" data-id="3"></div>
                      </div>
                    </li>
                    <li>
                      <div class="left">Hương vị:</div>
                      <div class="right">
                        <div class="rating_comment_taste" data-average="0" data-id="4"></div>
                      </div>
                    </li>
                  </ul>
                  <div class="txtComments-box">
                    <textarea id="text_comment_main" name="textare_binhluan" class="txt_comment" placeholder="Nhập bình luận..." style="resize: none; "></textarea>
                            <textarea style="display: none; resize: none; "></textarea>
                  </div>
                </div>
                <ul id="box-up-image" class="list-image-upload"></ul>
                <div class="box_comment_bottom">
                  <div class="left">
                  </div>
                  <div class="right">
                    <input id="btn_sent_comment" class="btn_comment" type="button" value="Gửi" >
                  </div>
                </div>
            </form>
          <div class="line_comment"></div>
        </div>
      </div>
      
      
      
      <!--danh sach comment-->
     <div id="box_assessment_restaurant">
       
      <div class="box_show_list_comment">
        
          <div class="avatar">
            <a href="javascript:;">
                  <img src="http://dendau.vn/style/avatar/10.gif" >
            </a><br>
          <span>286 bình luận</span>
          </div>
          <div class="full_name_user">
            <span>Lê Vĩnh Phú</span>
          </div>
          <ul class="list_vote_rating">
            <li>
              <div class="left">Dịch vụ:</div>
              <div class="right">
                 <div class="rating">
                    <span class="star_active"></span>
                    <span class="star_no_active"></span>
                    <span class="star_no_active"></span>
                    <span class="star_no_active"></span>
                    <span class="star_no_active"></span>
                 </div>
              </div>
            </li>
            <li>
              <div class="left">Quang cảnh:</div>
              <div class="right">
                  <div class="rating">
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_no_active"></span>
                  </div>
              </div>                    
            </li>
            <li>
              <div class="left">Giá cả:</div>
              <div class="right">
                 <div class="rating">
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_no_active"></span>
                  </div>
              </div>
            </li>
            <li>
              <div class="left">Hương vị:</div>
              <div class="right">
                 <div class="rating">
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_active"></span>
                    <span class="star_no_active"></span>
                    <span class="star_no_active"></span>
                  </div>
              </div>
            </li>
          </ul>
          
          <div class="content_comment">
            <p>
              Mùa này mưa nhiều, vào mấy kiểu quán Hàn - Nhật này là phù hợp rồi,
              ví tiền rủng rỉnh thì vào đây nhậu nhẹt là quá chuẩn,
              uống rượu Hàn vừa ấm bụng lại không sợ say như rượu VN,
              giá cũng rẻ hơn rượu Tây nhiều nên mấy ông bạn mình là toàn chuộng kiểu nhà hàng này.
            </p>
          </div>
          <div class="like_share_reply">
            <ul class="box_btn_submit">
              <li class="btn_like_assessment">
                <span>like</span><span>(0)</span>
              </li>
              <li class="btn_share_assessment">
                <span>share</span><span>(0)</span>
              </li>
              <li class="btn_reply">
                <span>trả lời</span>
              </li>
            </ul>
            
            
          </div>
          <div class="comment_for_assessment">
            <ul class="box_detail_comment_for_assessment">
              <li>
             
              <li>
            </ul>
          </div>
          <div class="line_box_list_comment"></div>
         
      </div>
      
     </div>
      
      <!--end box_comment-->
      
      
      
    </div>
    <!--===============================end binh luan====================-->
    
    </div>
<!--end tabs left-->

<!--tabs right-->
    <div class="tabs_right">
      <div class="similar_restaurant">
        <ul class="show_list_restaurant">
          <a href="javascript:;">
            <li>
              <div class="left">
                <div class="avatar_restaurant">
                  <img src="http://dendau.vn/style/avatar/10.gif">
                </div>
              </div>
              <div class="right">
                <div class="name_restaurant">
                  <span>Nhà hàng Kim Chi Hàn Quốc</span>
                </div>
                <div class="address_restaurant">
                  <span>
                    349 Hoàng Văn Thụ, Phường 2, 
                    Quận Tân Bình, Tp. Hồ Chí Minh

                  </span>
                </div>

              </div>            
            </li>
           </a>
          
          <a href="javascript:;">
            <li>
              <div class="left">
                <div class="avatar_restaurant">
                  <img src="http://dendau.vn/style/avatar/10.gif">
                </div>
              </div>
              <div class="right">
                <div class="name_restaurant">
                  <span>Nhà hàng Kim Chi Hàn Quốc</span>
                </div>
                <div class="address_restaurant">
                  <span>
                    349 Hoàng Văn Thụ, Phường 2, 
                    Quận Tân Bình, Tp. Hồ Chí Minh

                  </span>
                </div>

              </div>            
            </li>
           </a>
          
          <a href="javascript:;">
            <li>
              <div class="left">
                <div class="avatar_restaurant">
                  <img src="http://dendau.vn/style/avatar/10.gif">
                </div>
              </div>
              <div class="right">
                <div class="name_restaurant">
                  <span>Nhà hàng Kim Chi Hàn Quốc</span>
                </div>
                <div class="address_restaurant">
                  <span>
                    349 Hoàng Văn Thụ, Phường 2, 
                    Quận Tân Bình, Tp. Hồ Chí Minh

                  </span>
                </div>

              </div>            
            </li>
           </a>
          
          <a href="javascript:;">
            <li>
              <div class="left">
                <div class="avatar_restaurant">
                  <img src="http://dendau.vn/style/avatar/10.gif">
                </div>
              </div>
              <div class="right">
                <div class="name_restaurant">
                  <span>Nhà hàng Kim Chi Hàn Quốc</span>
                </div>
                <div class="address_restaurant">
                  <span>
                    349 Hoàng Văn Thụ, Phường 2, 
                    Quận Tân Bình, Tp. Hồ Chí Minh

                  </span>
                </div>

              </div>            
            </li>
           </a>
          
          
          
          
          
          
        </ul>
      </div>
    </div>
<!--end tabs right-->




  </div>  
</div>






<div class="datasSent1"></div>
<div class="datasSent2"></div>
<div class="datasSent3"></div>
<div class="datasSent4"></div>



	<script type="text/javascript" src="<?php echo $url;?>includes/plugins/rating_jquery/jRating.jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.basic').jRating();
      //dich vu
			$('.rating_comment_service').jRating({
				step:true,
				length : 5,
				canRateAgain : true,
				nbRates : 1000
			});
      //quang canh
      	$('.rating_comment_landscap').jRating({
				step:true,
				length : 5,
				canRateAgain : true,
				nbRates : 1000
			});
      //gia ca
      	$('.rating_comment_price').jRating({
				step:true,
				length : 5,
				canRateAgain : true,
				nbRates : 1000
			});
      //huong vị
      	$('.rating_comment_taste').jRating({
				step:true,
				length : 5,
				canRateAgain : true,
				nbRates : 1000
			});
      
		});
    //sent assessment
      $('#btn_sent_comment').click(function() {
        var rate1=$('#res_vote_1').val();
        var rate2=$('#res_vote_2').val();
        var rate3=$('#res_vote_3').val();
        var rate4=$('#res_vote_4').val();
        var content = $('textarea#text_comment_main').val();
        var id_user = $('#id_user').val();
        var id_restaurant=$('#id_restaurant').val();
    
       var a = 'rate1 = '+rate1+
                ' \n\
                 rate2 = '+rate2+' \n\
                 rate3 = '+rate3+' \n\
                 rate4 = '+rate4+' \n\
                 content: '+content+'\n\
                 id_restaurant:'+ id_restaurant+'\n\
                 id_user: '+ id_user ;
        
        alert(a);
        
      });
   
   
   
    
    
	</script>
  
  

  