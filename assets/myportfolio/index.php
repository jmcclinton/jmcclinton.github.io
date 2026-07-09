<?php get_header(); ?>
    <section id="top">
      <div class="container">
        <div class="info">
          <div class="blue-square"></div>
          <h1><?php echo get_bloginfo('name'); ?></h1>
          <p>Web Developer</p>
          <a href="#portfolio-section">Latest Works</a>
        </div>
        <div class="img">
          <div class="background-img">

          </div>
        </div>
      </div>
    </section>
    <section id="services-section">
      <div class="container">
        <div class="title">
          <div class="circle"></div>
          <h1>services</h1>
        </div>
        <div class="services-container">
          <?php
            $mypod = pods('service');
            $mypod->find('name ASC');
          ?>
          <?php while ( $mypod->fetch() ) : ?>
            <?php
            // set our variables
            $name= $mypod->field('name');
            $content= $mypod->field('content');
            $permalink= $mypod->field('permalink');
            $icon_class= $mypod->field('icon_class');
            $border_color= $mypod->field('border_color');
            ?>
            <div class="box <?php echo $border_color ?>">
              <i class="<?php echo $icon_class ?>"></i>
              <h5><?php echo $name ?></h5>
              <p><?php echo $content ?></p>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
    <section id="portfolio-section">
      <div class="container">
        <div class="title">
          <div class="square"></div>
          <h1>portfolio</h1>
        </div>
        <div class="portfolio-container">
          <?php
            $mypod = pods('project');
            $mypod->find('name ASC');
            $loopIndex = 0;
          ?>
          <?php while ( $mypod->fetch() ) : ?>
            <?php
            // set our variables
            $name= $mypod->field('name');
            $type_of_project= $mypod->field('type_of_project');
            $permalink= $mypod->field('permalink');
            $loopIndex += 1;

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
          <a href="<?php echo $permalink; ?>" class="box image<?php echo $loopIndex; ?>" >
            <div class="image" style='background: url("<?php echo $image_properties[url]; ?>");
            height: 100%;
            width: 100%;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;'>
              <div class="hover-bg">
                <div class="title">
                  <div class="text"><?php echo $type_of_project; ?></div>
                </div>
              </div>
            </div>
          </a>
        <?php endwhile; ?>

        </div>
      </div>
    </section>
    <section id="experience-section">
      <div class="container">
        <div class="large-title">
          Experience
        </div>
        <div class="experience-container">
          <div class="large-icons">
            <div class="square">
              <div class="blue-box">
                Experience
              </div>
            </div>
            <div class="circle">
              <div class="white-box">
                AWARDS
              </div>
            </div>
            <div class="triangle">
              <div class="triangle-box">
                <div class="text">Work</div>
              </div>
            </div>
          </div>
          <div class="info">
            <?php
              $mypod = pods('experience');
              $mypod->find('start_end_date ASC');
            ?>
            <?php while ( $mypod->fetch() ) : ?>
              <?php
              // set our variables
              $name= $mypod->field('name');
              $content= $mypod->field('content');
              $start_end_date= $mypod->field('start_end_date');
              $location= $mypod->field('location');
              $permalink= $mypod->field('permalink');

              ?>
              <div class="info-box">
                <h4><?php echo $name ?> - <?php echo $location ?> </h4>
                <span class="date"><?php echo $start_end_date ?></span>
                <p><?php echo $content ?></p>
              </div>
            <?php endwhile; ?>

          </div>
        </div>
      </div>
    </section>
    <section id="blog-section">
      <div class="container">
        <div class="title">
          <h1>Blog</h1>
        </div>
        <div class="blog-container">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- start of post -->
            <a href="<?php the_permalink(); ?>" class="post post-<?php the_ID(); ?>">
              <div class="post-img" style="background: url('<?php the_post_thumbnail_url( 'medium' ); ?>');"></div>
              <div class="details">
                <h4><?php the_title(); ?></h4>
                <p><?php the_excerpt(); ?></p>
              </div>
              <div class="more">
                <div class="button">
                  Read More
                </div>
              </div>
            </a>
            <!-- end of post -->
          <?php endwhile; ?>
          <?php else : ?>
            <div>
              <h1>Blogs Comming Soon</h1>
            </div>
          <?php endif; ?>


        </div>
      </div>
    </section>
    <section id="testimonials-section">
      <div class="container">
        <div class="title">
          <div class="square"></div>
          <h1>Testimonials</h1>
        </div>
        <div id="testimonials-app">
          <div class="spinner">

          </div>
          <h3>Loading</h3>
        </div>

      </div>
    </section>
<?php get_footer(); ?>
