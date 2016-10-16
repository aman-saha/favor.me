<?php 
  include("../../../../includes/database_connection.php");
  include("../../../../includes/functions.php");
  include("../../../../includes/session.php");
  ?>
<?php
  if(logged_in())
  {
    $current_username= $_SESSION['current_username'];
    $current_name=$_SESSION['current_name'];
    $current_user_id=$_SESSION['current_user_id'];
  }
else
  redirect_to("../reg/index.php");
?>
<?php

  $post_title = $_POST['post_title'];
  $post_description = $_POST['post_description'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $image = $_POST['image'] ;
  if($image == "#")
  {
    $query = "INSERT INTO event(user_id,title,description,start_date,end_date,start_time,end_time,image_url) VALUES($current_user_id,'$post_title','$post_description','$start_date','$end_date','$start_time','$end_time','$image')";
    $result = mysqli_query($connection,$query);
    if($result)
    {
      $output.= '<div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col  mdl-grid--no-spacing">
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                    <header class="author__header">
                        <img src="../assets/images/user.jpg" class="comment__avatar">
                        <div class="author__bio">
                            <strong>'.$current_username.'</strong>
                            <span>2 days ago</span>
                        </div>                            
                    </header>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                    <h2>'.$post_title.'</h2>'.$post_description.'
                </div>
               
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">'.$start_date.'</div>
                    <div class="mdl-color-text--red-600 buzz_date buzz_end_date">'.$end_date.'</div>
                </div>
            </div>';
    }
    else
    {
      $output = "Buzz failed";
    }
  }
  else
  {
   
    define('UPLOAD_DIR', 'images/');
    $img = $_POST['image'];
    //echo "$img";
    $split = explode( ';', $img );
    $get_type = explode('/',$split[0]);
    $type = $get_type[1];
    //echo "$type"; 
    $img = str_replace('data:image/'.$type.';base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR . uniqid() . '.'.$type;
    //echo "$file";
    $image_url = $file;
    $success = file_put_contents($file, $data);
    //print $success ? $file : 'Unable to save the file.';
    if($success)
    {
      $query = "INSERT INTO event(user_id,title,description,start_date,end_date,start_time,end_time,image_url) VALUES($current_user_id,'$post_title','$post_description','$start_date','$end_date','$start_time','$end_time','$image_url')";
        $result = mysqli_query($connection,$query);
        if($result)
        {
          $output.='<div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col  mdl-grid--no-spacing">
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                    <header class="author__header">
                        <img src="../assets/images/user.jpg" class="comment__avatar">
                        <div class="author__bio">
                            <strong>'.$current_username.'</strong>
                            <span>2 days ago</span>
                        </div>                            
                    </header>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                    <h2>'.$post_title.'</h2> '.$post_description.'
                </div>
                <div class="mdl-card__media mdl-card__title mdl-cell--12-col buzz_image">
                    <img src="/cambuzz-new/public/buzz/'.$image_url.'" width="100%" height="100%" border="0" alt="">
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">'.$start_date.'</div>
                    <div class="mdl-color-text--red-600 buzz_date buzz_end_date">'.$end_date.'</div>
                </div>
            </div>';
        }
        else
        {
          $output = "Buzz failed";
        }
      }
    else
    {
      $output = "Cannot save file";
    }
  }
  echo "$output";
?>