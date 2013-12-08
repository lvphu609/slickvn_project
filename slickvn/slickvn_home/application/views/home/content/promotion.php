 <?php $url=  base_url();
       $url_res_frofile=$link_restaurant_frofile;
 ?>
<div id="append_Res_Newest_List">
  <div id="remove_Res_Newest_List">
    <div id="promotion">
       <!--Title Khuyến Mãi-->
    <div class="promotion_title">
       <div class="promotion_title_custom_center">
        <div class="title_left"></div>
       </div>
    </div>
   <!--end title Khuyến mãi--> 
       <div class="box_restaurant_content">
           <!--masonry  class="masonry js-masonry"-->
        <div class="box_restaurant_content_custom_center">
          <ul class="append_newest_restaurant thumb_grid ul_alight_center"  >
          <!--
            Purpose: Get API new restaurant list 
            Author: Vinh Phu
            Version: 28/10/2013
          !-->
          <script type="text/javascript" src="<?php echo $url."includes/js/time_left/remaining.js";?>"></script>
            <?php 
             //  var_dump($promotion_list);
                $stt_timer=1;
                foreach ($promotion_list as $value_promotion_item){
                  $due_date=$value_promotion_item['coupon_due_date']; 
                  $due_date=date("j F, Y H:i:s", strtotime($due_date)); 
                  
                  echo'<script type="text/javascript">  
                        var timer = setInterval(function(){

                          var seconds = remaining.getSeconds(\''.$due_date.'\');

                         // var remainingTime = remaining.getString(seconds, null, true);
                           var remainingTime = remaining.getString(seconds);
                          //var remainingTime = remaining.getStringDigital(seconds);

                          if (remainingTime == \'\') {
                            $(\'#remaining_'.$stt_timer.'\').html(\'đã hết!\');
                            clearInterval(timer);
                          } else {
                            $(\'#remaining_'.$stt_timer.'\').html(remainingTime);
                          }

                        }, 100);
                      </script>';
                  $stt_timer++;
                  
                }
            ?>
          <?php 
         // var_dump($newest_restaurant['0']);
            $stt_coupon=1;
            foreach ($promotion_list as $value_promotion_item){
            
             $avatar=$value_promotion_item['avatar'];             
             $id=$value_promotion_item['id'];
             $name=$value_promotion_item['name'];
             
             $desc=$value_promotion_item['desc'];
             $desc=substr($desc,0,120) . '...';
             //$desc="ádad ád ád ád ád ád ád ád ";
             //$desc=word_limiter($desc, 4);

             
             $address=$value_promotion_item['address'];
             $number_assessment=$value_promotion_item['number_assessment'];
             $number_like=$value_promotion_item['number_like'];
             $rate_point=$value_promotion_item['rate_point'];
             
            
              echo'
               <li >            
                <div class="detail_box">
                           <div class="img_item">
                             <a href="'.$url.'/index.php/detail_restaurant/detail_restaurant?id_restaurant='.$id.'">
                                 <img style="width=40px; height=40px;" class="big" src="'.$url_res_frofile.$avatar.'" >
                             </a>
                            </div>
                            <div id="time_left">
                              <span>thời gian khuyến mãi còn lại
                               <div id="remaining_'.$stt_coupon.'"></div>
                              </span>
                            </div>     
                       ';
                   
                      echo'<div class="introduce_restaurant">
                             <span>
                              '.$desc.'
                             </span>     
                          </div>';
                           echo' 
                           <div class="info_restaurant"> ';
                              
                              //line
                              echo'<div class="line"></div>';
                              
                               //iamges avatar restaurant
                              echo '<div class="avartar_restaurant">
                                      <a href="#">
                                          <img src="'.$url_res_frofile.$avatar.'" title="Sweet cherry cafe" alt="Sweet cherry cafe" >
                                      </a>                            
                                    </div>';
                                //name
                                echo'
                                  <div class="title_address">
                                     <div class="title">
                                      <a href="#"><span>'.$name.'</span></a>
                                     </div>';
                                //address   
                                echo'<div class="address">'.
                                         $address
                                     .'</div>                                       
                                  </div>
                                  
                             </div>
                          </div>  
              </li>
              ';
            
             $stt_coupon++;
           }         
            ?> 
        </ul>
        <ul id="more_Newest_Restaurant">
           <li class="li_more">
               <a href="javascript:;" id="btn_More_Newest_Restaurant">
                    <div id="remove_button_more" class="button_more_noload">
                      <div class="text"><span>&nbsp;</span></div>
                    </div>
                </a>
            </li> 
        </ul>
     </div>
    </div>
 </div>

    

    
<!--zoom hover-->
<div id="niceThumb_append">
  <div id="niceThumb_remove">
    <script>
        $(function(){
          niceThumb_Grid ();
        });
    </script>
   </div>
</div>
<!--zoom hover-->
         
         
<!--javascrip append <li> to <ul>-->
<input type="hidden" value="1" id="number_page_newest_restaurant"> 
<?php $url=  base_url(); ?>
<input type="hidden" value="<?php echo $url;?>" id="hidUrl"> 

<script>

  $(function(){
    var page_this = parseInt($('#number_page_newest_restaurant').val());
    var page_next= page_this; 
    $('#btn_More_Newest_Restaurant').click(function() {
     // more_Newest_Restaurant();
      page_next= page_next+1;
      //alert(page_next);
      $("#remove_button_more").removeClass('button_more_noload');
      $("#remove_button_more").addClass('button_more_loading');
      $("#niceThumb_remove").remove();
      
      var dataThumb = "<div id=\"niceThumb_remove\"><script>$(function(){niceThumb_Grid ();});<\/script></div>";
      
      var url = $('#hidUrl').val();
      $.post( url + "index.php/home_controller/more_Newest_Restaurant", 
               { page: page_next}, function(data){                                   
                                  $('.append_newest_restaurant').append(data);
                                  $('#niceThumb_append').append(dataThumb);
                                  $("#remove_button_more").removeClass('button_more_loading');
                                  $("#remove_button_more").addClass('button_more_noload');
                                  if(data==""){
                                    //alert('het');
                                    $("#more_Newest_Restaurant").remove();
                                  }
                                  
                                  });
      
        

    });
    
  }); 
</script>   
<!--end javascrip append <li> to <ul>-->
 </div>
</div>