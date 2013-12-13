<?php $url=  base_url(); 
      $link_image_post_url=$link_image_post_url;
?>
<div id="articles">
   <!--Title bài viết hay-->
    <div class="articles_title">
       <div class="articles_title_custom_center">
          <div class="title_left"></div>
       </div>
    </div>
   <!--end title bài viết hay--> 
   <div class="articles_list">
     <div class="articles_list_custom_center"  id="append_More_Post">
       <?php
       if(is_array($articles_list)&&  sizeof($articles_list)>0){
       foreach ($articles_list as $value_articles_item) {
            $id=$value_articles_item['id'];
            $title=$value_articles_item['title'];
            $id_user=$value_articles_item['id_user'];
            $avatar=$value_articles_item['avatar'];
            $address=$value_articles_item['address'];
            $content=$value_articles_item['content'];
            //$number_view=$articles_list['number_view'];
            $number_view=0;
           // $note=$value_articles_list['note'];
          //  $authors=$value_articles_list['authors'];
            $created_date=$value_articles_item['created_date'];
            
            $favourite_type_list=$value_articles_item['favourite_type_list'];
            $favourite_type_list=substr($favourite_type_list, 1); 
    
            $price_person_list=$value_articles_item['price_person_list'];
            $price_person_list=substr($price_person_list, 1); 
            
            $culinary_style=$value_articles_item['culinary_style_list'];
            $culinary_style=substr($culinary_style, 1); 
//            $culinary_style=substr($culinary_style, 1); 
            $rate_point=5;
            $number_assessment=0;
            //var_dump($culinary_style);
            
            echo'
                <div class="box_list">
                  <div class="images">
                    <a  href="'.$url.'/index.php/detail_post/detail_post?id_post='.$id.'">
                      <div class="detail_image">
                        <img src="'.$link_image_post_url.$avatar.'" >

                      </div>
                    </a>
                  </div>
                  <div class="content">
                    <span class="title">'.$title.'</span> <br>
                    <p>'.$address.'</p>              
                    <b>Mục Đích:</b>&nbsp; '.$favourite_type_list.' <br>
                    <b>Giá trung bình/người:</b>&nbsp; '.$price_person_list.'<br>
                    <b>Phong cách ẩm thực:</b>&nbsp; '.$culinary_style.'<br>
                  </div>
                  <div class="comment">
                      <div class="box_comment">
                        <div class="title">
                          <span>'.$rate_point.'</span>
                        </div>';
            
                         
                          echo'   <div class="vote">';
                          
                          $stt_off=5-$rate_point;
                          $stt_on= $rate_point;
                          while ($stt_on!=0){
                            echo '<span class="star_on"></span>';
                              $stt_on--;
                          }
                         
                          while ($stt_off!=0){        
                                   echo'<span class="star_off"></span>';
                                   $stt_off--;
                          }
                          echo'   </div>'; 

                       
                        

                      echo'<div class="detail">
                         <b>'.$number_assessment.'</b>&nbsp; Bình luận <br>
                         <b>'.$number_view.'</b>&nbsp; Lượt xem
                        </div>
                      </div>
                  </div>
                </div>
            ';
            
       }     
       }
       ?>
      
       
               
       </div>
    </div>
</div>

<!--btn more post-->
   <div id="articles" class="more_Post_div">
     <div class="articles_list">
      <div class="articles_list_custom_center">
       <div class="box_list">
         <div class="more_Post">
           <a href="javascript:;" id="btn_More_Post">
             <div class="text_more_post">
               <div class="text">
                 <span>Xem thêm</span>
               </div>               
             </div>
           </a>
           <a href="<?php echo $url?>index.php/home_controller/add_post" id="btn_add_post">
             <div class="text_add_post">
               <div class="text">
                 <span>Thêm bài viết</span>
               </div>               
             </div>
           </a>
         </div>
         
       </div>
      </div>
    </div>
   </div>
<!--end btn more post-->  






<!--javascrip append <li> to <ul>-->
<input type="hidden" value="1" id="number_page_post"> 
<?php $url=  base_url(); ?>
<input type="hidden" value="<?php echo $url;?>" id="hidUrl">

<script>

  $(function(){
    var page_this_post = parseInt($('#number_page_post').val());
    var page_next_post= page_this_post; 
    $('#btn_More_Post').click(function() {
     // more_Newest_Restaurant();
      page_next_post= page_next_post+1;
      //alert(page_next);
      
      var url = $('#hidUrl').val();
      $.post( url + "index.php/home_controller/more_Post", 
               { page_more_post: page_next_post}, function(data){
                                  
                                  $('#append_More_Post').append(data);
                                  if(data==""){
                                    //alert('het');
                                    $(".more_Post_div").remove();
                                  }
                                  
                                  });

    });
    
  }); 
</script>   
<!--end javascrip append <li> to <ul>-->
