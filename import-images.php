<?php

// Bootstrap WordPress
$path = preg_replace('/wp-content.*$/','',__DIR__);
require_once( $path.'wp-load.php' );

function move_image($fileurl) {

  $this_file = wp_upload_dir()['basedir'] . str_replace(SITE_URL . '/wp-content/uploads','',$fileurl);

  if(file_exists($this_file)) {

      //echo $total + $coiunt . '<br>';
          //echo $image[0] . '<br><br>';
  } else {
    $file = str_replace(SITE_URL,'https://www.ccgs.wa.edu.au',$fileurl);
    $newfile = $this_file;

    echo '<br>' . 'Copy: ' . $file . '<br>' . 'To: ' . $newfile . '<br>';
    echo '<img src="'.$file.'">';
    $path = pathinfo($newfile);

    $upPath = $path['dirname'];   // full path
    $tags = explode('/' ,$upPath);            // explode the full path
    $mkDir = "";

    foreach($tags as $folder) {
        $mkDir = $mkDir . $folder ."/";   // make one directory join one other for the nest directory to make
        //echo '"'.$mkDir.'"<br/>';         // this will show the directory created each time
        if(!is_dir($mkDir)) {             // check if directory exist or not
          mkdir($mkDir, 0777);            // if not exist then make the directory
        }
    }

    if ( copy($file, $newfile) ) {
        echo "Copy success!" . '<br><br>';
    }else{
        echo "Copy failed!" . '<br><br>';
    }

  }


}

if (isset($_GET['file'])) {

  move_image($_GET['file']);

}else{



  $paged = ( isset($_GET['paged']) ) ? $_GET['paged'] : 1;
  $new_page =  intval($paged) + 1;
  $args = array(
      'post_type' => 'attachment',
      //'post_mime_type' => 'application/pdf',
      'orderby' => 'post_date',
      'order' => 'desc',
      'posts_per_page' => '40',
      'post_status'    => 'inherit',
      'paged' => $paged
  );
  $total = intval($paged) * 40;
  $coiunt = 0;
  $loop = new WP_Query( $args );

  if ( $loop->have_posts() ) :

  while ( $loop->have_posts() ) : $loop->the_post();
    $coiunt++;
    $image = wp_get_attachment_url( get_the_ID() );
    echo get_the_ID() . '<br>';
    //pre($image);
    move_image($image);

  endwhile;
    echo '<a href="'.$_SERVER['PHP_SELF'].'?paged='.$new_page.'">Redirect</a>';
    header('Refresh: 1; url='.$_SERVER['PHP_SELF'].'?paged='.$new_page );
    die;

  else :

  endif;

}

?>
