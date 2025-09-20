<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      // Apply saved theme as early as possible to avoid flash
      (function () {
        try {
                    var t = localStorage.getItem('zekktech-theme') || 'light';
                      var html = document.documentElement;
                      var body = document.body || null;
                      html.classList.remove('light','dark','warm');
                      if (body) body.classList.remove('light','dark','warm');
                      if (t === 'dark') { html.classList.add('dark'); if(body) body.classList.add('dark'); }
                      else if (t === 'warm') { html.classList.add('warm'); if(body) body.classList.add('warm'); }
                      else { html.classList.add('light'); if(body) body.classList.add('light'); }
        } catch (e) {}
      })();
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>
<header class="header-container px-4 py-4">
    <div class="max-w-5xl mx-auto">
    <nav class="header-nav-desktop header-shell flex items-center justify-between pl-0 pr-4 py-2 relative">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link flex items-center gap-1">
                <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                    <span class="logo-img shrink-0"><?php the_custom_logo(); ?></span>
                    <span class="logo-text site-title text-lg font-bold leading-none"><?php bloginfo('name'); ?></span>
                <?php else : ?>
                    <div class="logo-img rounded-full bg-[var(--accent-color)] w-8 h-8"></div>
                    <span class="logo-text site-title text-xl font-bold"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>
            <div class="nav-links-desktop flex items-center gap-4">
                <div class="nav-menu" id="navMenu" role="menu" aria-hidden="false">
                <?php if (has_nav_menu('primary')) {
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex items-center gap-4',
                        'fallback_cb' => false,
                        'depth' => 1
                    ]);
                } else { ?>
                    <ul class="flex items-center gap-4">
                        <li><a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>">Beranda</a></li>
                        <?php if (is_user_logged_in()) : ?>
                            <li><a class="nav-link" href="<?php echo esc_url(admin_url()); ?>">Dasbor</a></li>
                        <?php else : ?>
                            <li><a class="nav-link" href="<?php echo esc_url(wp_login_url()); ?>">Masuk</a></li>
                        <?php endif; ?>
                        <li><a class="nav-link" href="<?php echo esc_url(zekktech_get_tentang_url()); ?>">Tentang</a></li>
                        <li><a class="nav-link" href="<?php echo esc_url(zekktech_get_github_url()); ?>" target="_blank" rel="noopener">GitHub ↗</a></li>
                    </ul>
                <?php } ?>
                </div>
                <div class="search-area flex items-center gap-2">
                    <div class="search-container w-full md:w-auto">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <button id="themeToggle" type="button" class="theme-toggle ml-2 px-3 py-2 rounded-full border" title="Ganti tema" aria-label="Ganti tema" style="touch-action: manipulation;">🌙</button>
                <button id="navToggle" type="button" class="nav-toggle ml-2 px-3 py-2 rounded-full border lg:hidden" aria-label="Menu" aria-controls="navMenu" aria-expanded="false" style="touch-action: manipulation;">☰</button>
            </div>
        </nav>
    </div>
</header>
<main id="content" class="px-4">
    <div class="max-w-5xl mx-auto py-6">
