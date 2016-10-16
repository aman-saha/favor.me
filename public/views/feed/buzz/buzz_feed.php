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
  redirect_to("../../reg/index.php");
?>
<?php
  $output='<div id="add_buzz"></div>';
  $category = $_GET['category'];
  if($category=="all")
    $query = "SELECT * FROM event ORDER BY id DESC";
  else
    $query = "SELECT * FROM event WHERE category='$category' ORDER BY id DESC";
  $result = mysqli_query($connection,$query);
  if($result)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      $image_url = $row['image_url'];
      if($image_url=="#")
      {
        $output.= '<div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col  mdl-grid--no-spacing">
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                    <header class="author__header">
                        <img src="../assets/images/user.jpg" class="comment__avatar">
                        <div class="author__bio">
                            <strong>'.$current_username.'</strong>
                            <span>'.$row['start_time'].'</span>
                        </div>                            
                    </header>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                    <h2>'.$row['title'].'</h2>'.$row['description'].'
                </div>
               
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">'.$row['start_date'].'</div>
                    <div class="mdl-color-text--red-600 buzz_date buzz_end_date">'.$row['category'].'</div>
                </div>
            </div>';
      }
      else
      {
        $output.='<div class="section__text mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col  mdl-grid--no-spacing">
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone flex-dis-col">
                    <header class="author__header">
                        <img src="../assets/images/user.jpg" class="comment__avatar">
                        <div class="author__bio">
                            <strong>'.$current_username.'</strong>
                            <span>'.$row['start_time'].'</span>
                        </div>                            
                    </header>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                    <h2>'.$row['title'].'</h2> '.$row['description'].'
                </div>
                <div class="mdl-card__media mdl-card__title mdl-cell--12-col buzz_image">
                    <img src="/cambuzz-new/public/buzz/'.$row['image_url'].'" width="100%" height="100%" border="0" alt="">
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-color-text--cyan-600 buzz_date buzz_start_date">'.$row['start_date'].'</div>
                    <div class="mdl-color-text--red-600 buzz_date buzz_end_date">'.$row['category'].'</div>
                </div>
            </div>';
      }
    }
  }
  echo "$output";
?>