<?php
 get_header(); the_post();
?>

<?php get_template_part('templates/page','header');?>

<section class="paddit sectionit">
  <div class="wrap-large">
  <div class="onecolumn">
    <article class="intro-box">
        <div class="textbox">
            <h1><?php the_title(); ?></h1>
              <?php
              echo '<div class="career-vacancies">';
              echo '<div class="row header"><div class="col">Position</div><div class="col">Status</div><div class="col">Applications close</div></div>';
              $args = array( 'post_type' => 'careers', 'posts_per_page' => -1 );
              $loop = new WP_Query( $args );
              while ( $loop->have_posts() ) : $loop->the_post();
                echo '<div class="row">';
                  $link = 'class="link" href="#"';
                  echo '<div class="col"><a '.$link.'>' . get_the_title() . '</a></div>';
                  echo '<div class="col">' . get_field('status') . '</div>';
                  echo '<div class="col">' . get_field('application_close') . '</div>';
                  echo '<div class="description">' . get_the_content_with_formatting() . '</div>';
                echo '</div>';
              endwhile;
              echo '</div>';
              ?>

              <p></p>

          <?php //the_content(); ?>

        </div>
    </article>

  </div>

</div>
</section>
<?php get_footer(); ?>
