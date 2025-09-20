<?php
// 403 Forbidden template
http_response_code(403);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>403 Forbidden</title>
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/errors.css' ); ?>">
</head>
<body <?php body_class(); ?>>
  <main class="px-4 py-10">
    <img class="error-illustration" src="<?php echo esc_url( get_template_directory_uri() . '/errors/403zekktech.png' ); ?>" alt="403 Forbidden">
    <h1>403 - Website ZekkTech Forbidden</h1>
    <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <p><a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">Kembali ke Beranda</a></p>
  </main>
  <?php wp_footer(); ?>
</body>
</html>
