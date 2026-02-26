<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/css/main.css?counter=<?php echo time(); ?>">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
        <?php
          function acronym($str, $as_space = array('-')) {
            $str = str_replace($as_space, ' ', trim($str));
            $ret = '';
            foreach(explode(' ', $str) as $word){
              $ret .= strtoupper($word[0]);
            }
            return $ret;
          }
          ?>
        <div class="logo">
          <a href="/" class="name"><?php echo acronym(get_bloginfo('name')); ?></div>
        </div>
        <div class="header-menu">
          <a href="/">Home</a>
          <a href="/#services-section">Services</a>
          <a href="/#portfolio-section">Portfolio</a>
          <a href="/#experience-section">Experience</a>
          <a href="/#blog-section">Blog</a>
          <a href="/#testimonials-section">Testimonials</a>
        </div>
        <div class="menu-btn">
          <i class="fas fa-bars"></i>
        </div>
    </header>
    <div class="mobile-menu">
      <a href="/">Home</a>
      <a href="/#services-section">Services</a>
      <a href="/#portfolio-section">Portfolio</a>
      <a href="/#experience-section">Experience</a>
      <a href="/#blog-section">Blog</a>
      <a href="/#testimonials-section">Testimonials</a>
    </div>
