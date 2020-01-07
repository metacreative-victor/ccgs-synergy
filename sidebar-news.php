<?php
$post_type = 'post';
?>
<div id="news_categories">
  <a id="news_cats_opener">News Categories</a>
  <?php
  /*
   * Get list of categories
   * Loop through categories and get posts
   */
  $args = array(
      'type'		=> 'post',
      'child_of'	=> '5',
      'exclude'     => array('240','241'),
      'parent'		=> '',
      'orderby'		=> 'name',
      'order'		=> 'ASC',
      'hide_empty'	=> 0
  );
  $categories = get_categories($args);

  $cat_counter = 0;
  $lastCatDepth = 0;

  foreach ($categories as $category):

    $cats_str = get_category_parents($category, false, '%#%');
    $cats_array = explode('%#%', $cats_str);
    $cat_depth = sizeof($cats_array)-2;

    if ($cat_depth != $lastCatDepth){
      // the level has changed
      if ($cat_depth > $lastCatDepth){
        ?>
        <ul>
          <li>
        <?php
      }
      if ($cat_depth < $lastCatDepth){
        ?>
          </li>
        </ul>
      </li>
      <li>
        <?php
      }
    }
    else {
      ?>
      <li>
      <?php
    }
    ?>

      <a href="<?php echo get_category_link($category->cat_ID) ?>"><?php echo $category->name; ?></a>

    <?php
    if ($cat_depth == $lastCatDepth){
      ?>
      </li>
      <?php
    }
    $lastCatDepth = $cat_depth;
    $cat_counter++;
  endforeach;
  ?>
  </ul>
</div>
