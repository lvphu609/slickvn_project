
<?php $url=  base_url();?> 


<div id="promotion">
  <!--Title Khuyến Mãi-->
    <div class="promotion_title">
       <div class="promotion_title_custom_center">
        <div class="title_left"></div>
       </div>
    </div>
   <!--end title Khuyến mãi--> 
   
  
   <!--danh sách nhà hàng khuyến mãi-->
   <div id="restaurant_list_content">
       <div class="box_restaurant_content">
          <div class="box_restaurant_content_custom_center">
          <ul class="append_Promotion">
            <?php 
               var_dump($promotion_list);
                foreach ($promotion_list as $value_promotion_list){
//                $id= $value_promotion_list['id'];
//                $coupon_value=$value_promotion_list['coupon_value'];
//                $deal_to_date=$value_promotion_list['deal_to_date'];
//                $restaurant_name=$value_promotion_list['restaurant_name'];
//                $content=$value_promotion_list['content'];
//                $image_link=$value_promotion_list['image_link'];
//                $link_to=$value_promotion_list['link_to'];
                
                $id= "asdds";
                $coupon_value="10";
                $deal_to_date="12/12/2013";
                $restaurant_name="hihihi";
                $content="hihihi";
                $image_link="hihihi";
                $link_to="hihihi";
                
             /*   
                $avatar=$value_promotion_list['avatar'];             
                $id=$value_promotion_list['id'];
                $name=$value_promotion_list['name'];
                $desc=$value_promotion_list['desc'];
                $desc=substr($desc,0,120) . '...';
                $address=$value_promotion_list['address'];
                $number_assessment=$value_promotion_list['number_assessment'];
                $number_like=$value_promotion_list['number_like'];
                $rate_point=$value_promotion_list['rate_point'];*/
                
                
                echo '
                      <li>
                        <div class="detail_box">
                                <div class="promotion_custom">
                                  <div class="img_item">
                                      <a href="'.$link_to.'">
                                        <img src="'.$image_link.'" title="'.$restaurant_name.'" alt="'.$restaurant_name.'" >
                                      </a>
                                  </div>
                                  <div class="info_promotion">
                                        <div class="title">
                                           <a href="'.$link_to.'">'.$restaurant_name.'</a>
                                        </div>
                                        <div class="info_promotion">
                                           '.$content.'
                                        </div>
                                  </div>
                               </div>
                       </div> 
                     </li>
                ';
                
                
                
              }
       
            ?>
          </ul>
            
          <ul id="more_Promotion">
           <li class="li_more">
               <a href="javascript:;" id="btn_More_Promotion">
                    <div class="button_more">
                      <div class="text"><span>Xem thêm</span></div>
                    </div>
                </a>
            </li> 
          </ul>            
         </div>
       </div>
    </div>
  <!--end danh sách nhà hàng khuyến mãi-->   
   
</div>

<!--javascrip append <li> to <ul>-->
<input type="hidden" value="1" id="number_page_promotion"> 
<?php $url=  base_url(); ?>
<input type="hidden" value="<?php echo $url;?>" id="hidUrl"> 

<script>

  $(function(){
    var page_this_promotion = parseInt($('#number_page_promotion').val());
    var page_next_promotion= page_this_promotion; 
    $('#btn_More_Promotion').click(function() {
     // more_Newest_Restaurant();
      page_next_promotion= page_next_promotion+1;
      //alert(page_next);
      
      var url = $('#hidUrl').val();
      $.post( url + "index.php/home_controller/more_Promotion", 
               { page_promotion: page_next_promotion}, function(data){
                                  
                                  $('.append_Promotion').append(data);
                                  if(data==""){
                                    //alert('het');
                                    $("#more_Promotion").remove();
                                  }
                                  
                                  });

    });
    
  }); 
</script>   
<!--end javascrip append <li> to <ul>-->

