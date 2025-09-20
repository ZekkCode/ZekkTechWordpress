<?php
// 400 Bad Request template
http_response_code(400);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>400 Bad Request</title>
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/errors.css' ); ?>">
</head>
<body <?php body_class(); ?>>
  <main class="px-4 py-10">
    <img class="error-illustration" src="<?php echo esc_url( get_template_directory_uri() . '/errors/400zekktech.png' ); ?>" alt="400 Bad Request">
    <h1>400 - Website ZekkTech Bad Request</h1>
    <p>Permintaan tidak valid atau terjadi kesalahan pada permintaan Anda.</p>
    <p><a class="btn" href="<?php echo esc_url( home_url('/') ); ?>">Kembali ke Beranda</a></p>
  </main>
  <?php wp_footer(); ?>
</body>
</html>
