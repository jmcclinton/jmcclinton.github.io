<?php
/*
Template Name: Single Project Template
*/

get_header();
?>

<?php
     //get the current slug
     $slug = pods_v( 'last', 'url' );

     //get pods object
     $mypod = pods( 'project', $slug );

     // set our variables
     $name= $mypod->field('name');
     $permalink= $mypod->field('permalink');
     $description= $mypod->field('content');
     $project_url= $mypod->field('project_url');
     $github_url= $mypod->field('github_url');
     $tech_icon1= $mypod->field('tech_icon_1');
     $tech_icon2= $mypod->field('tech_icon_2');
     $tech_icon3= $mypod->field('tech_icon_3');
     $tech_icon4= $mypod->field('tech_icon_4');
     $youtube_url= $mypod->field('youtube_url');


     $row = $mypod->row();
     $post_id = $row['ID'];
     if (!function_exists('get_post_featured_image')) {
         function get_post_featured_image($post_id, $size) {
           $return_array = [];
           $image_id = get_post_thumbnail_id($post_id);
           $image = wp_get_attachment_image_src($image_id, $size);
           $image_url = $image[0];
           $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
           $image_post = get_post($image_id);
           $image_caption = $image_post->post_excerpt;
           $image_description = $image_post->post_content;
           $return_array['id'] = $image_id;
           $return_array['url'] = $image_url;
           $return_array['alt'] = $image_alt;
           $return_array['caption'] = $image_caption;
           $return_array['description'] = $image_description;
           return $return_array;
         }
       }
     $image_properties = get_post_featured_image($post_id, 'full');

   ?>



<section id="portfolio-projects">
  <div class="container">
    <div class="project-image">
      <div class="img" style="background: url('<?php echo $image_properties[url]; ?>')"></div>
    </div>
    <h1><?php echo $name; ?> </h1>
    <div class="info">
      <div class="buttons">
        <a href="<?php echo $project_url; ?>"><i class="fas fa-desktop"></i> View Project</a>
        <a href="<?php echo $github_url; ?>"><i class="fas fa-code"></i> View Code</a>
      </div>
    </div>
    <?php echo $description; ?>

    <div class="technologies">
      <h3>Technologies</h3>

      <div class="icons">
        <div class="icon">
          <img src="<?php echo $tech_icon1; ?>">
        </div>
        <div class="icon">
          <img src="<?php echo $tech_icon2; ?>">
        </div>
        <div class="icon">
          <img src="<?php echo $tech_icon3; ?>">
        </div>
        <div class="icon">
          <img src="<?php echo $tech_icon4; ?>">
        </div>
      </div>
    </div>
    <div class="video">
      <h3>Video Walkthrough</h3>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_url; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  </div>
</section>

<?php get_footer(); ?>
