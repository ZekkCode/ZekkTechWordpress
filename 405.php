<?php
// 405 Method Not Allowed template
http_response_code(405);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>405 Method Not Allowed</title>
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/errors.css' ); ?>">
</head>
<body <?php body_class(); ?>>
  <main class="px-4 py-10">
    <img class="error-illustration" src="<?php echo esc_url( get_template_directory_uri() . '/errors/405zekktech.png' ); ?>" alt="405 Method Not Allowed">
    <h1>405 - Website ZekkTech Method Not Allowed</h1>
    <p>Metode permintaan tidak diizinkan untuk halaman ini.</p>
    <p><a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">Kembali ke Beranda</a></p>
  </main>
  <?php wp_footer(); ?>
</body>
</html>
