<?php
class Upload_image extends CI_Controller{
  
  public function upload(){
    $this->load->helper('url');
    $this->load->view('upload_view');
    
  }
  
  public function index(){
//    echo'upload_success <br>';
//    /*
//    $allowedExts = array("gif", "jpeg", "jpg", "png");
//          $temp = explode(".", $_FILES["file"]["name"]);
//          $extension = end($temp);
//          if ((($_FILES["file"]["type"] == "image/gif")
//          || ($_FILES["file"]["type"] == "image/jpeg")
//          || ($_FILES["file"]["type"] == "image/jpg")
//          || ($_FILES["file"]["type"] == "image/pjpeg")
//          || ($_FILES["file"]["type"] == "image/x-png")
//          || ($_FILES["file"]["type"] == "image/png"))
//          && ($_FILES["file"]["size"] < 20000)
//          && in_array($extension, $allowedExts))
//            {
//                if ($_FILES["file"]["error"] > 0)
//                  {
//                  echo "Error: " . $_FILES["file"]["error"] . "<br>";
//                  }
//                else
//                  {
//                  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//                  echo "Type: " . $_FILES["file"]["type"] . "<br>";
//                  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//                  echo "Stored in: " . $_FILES["file"]["tmp_name"];
//                  }
//            }
//          else
//            {
//                 echo "định dạng không đúng";
//            }
//    
//    */
//    $name=$_FILES["file"]["name"];
//    //echo $name;
//    
//     $this->load->helper('url');
//     $url=  base_url();
//     
//    $path=$url."includes/images/restaurant/restaurant_1.jpg";
//   
//    
//     $image=$path;
//     $data = fopen ($image, 'rb');
//
//      //$size=  filesize($image);
//      var_dump($data);
//    //  $contents= fread ($fd, $size);
//
//    //  fclose ($fd);

    
    $this->load->view('upload_view');
  }
  
  
}
?>
