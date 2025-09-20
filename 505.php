<?php
// 505 HTTP Version Not Supported template
http_response_code(505);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>505 HTTP Version Not Supported</title>
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/errors.css' ); ?>">
</head>
<body <?php body_class(); ?>>
  <main class="px-4 py-10">
    <img class="error-illustration" src="<?php echo esc_url( get_template_directory_uri() . '/errors/505zekktech.png' ); ?>" alt="505 HTTP Version Not Supported">
    <h1>505 - Website ZekkTech HTTP Version Not Supported</h1>
    <p>Versi HTTP tidak didukung oleh server.</p>
    <p><a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">Kembali ke Beranda</a></p>
  </main>
  <?php wp_footer(); ?>
</body>
</html>
