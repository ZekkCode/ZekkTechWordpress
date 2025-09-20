<?php
// 500 Internal Server Error template
http_response_code(500);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>500 Internal Server Error</title>
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/errors.css' ); ?>">
</head>
<body <?php body_class(); ?>>
  <main class="px-4 py-10">
    <img class="error-illustration" src="<?php echo esc_url( get_template_directory_uri() . '/errors/500zekktech.png' ); ?>" alt="500 Internal Server Error">
    <h1>500 - Website ZekkTech Internal Server Error</h1>
    <p>Terjadi kesalahan pada server. Silakan coba beberapa saat lagi.</p>
    <p><a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">Kembali ke Beranda</a></p>
  </main>
  <?php wp_footer(); ?>
</body>
</html>
