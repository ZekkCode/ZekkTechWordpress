<?php get_header(); ?>

<?php $hero = get_header_image(); ?>
<section class="hero-section relative w-full h-52 md:h-64 overflow-hidden rounded-lg mb-8 card z-10 flex items-center" style="<?php if($hero){ echo 'background-image:url('.esc_url($hero).'); background-size:cover; background-position:center;'; } ?>">
    <div class="absolute inset-0 <?php echo $hero ? 'bg-black/50' : 'bg-gradient-to-r from-black/50 to-black/20'; ?>"></div>
    <div class="relative z-10 p-8">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2"><?php bloginfo('name'); ?></h1>
        <p class="text-white/90"><?php bloginfo('description'); ?></p>
    </div>
</section>

<div class="flex flex-col lg:flex-row gap-8">
    <div class="w-full lg:w-2/3">
        <?php if (have_posts()) : ?>
            <div class="space-y-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('card rounded-xl p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1'); ?>>
                        <div class="flex flex-col md:flex-row gap-6">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="md:w-48 md:flex-shrink-0">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 md:h-32 object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-105', 'loading' => 'lazy']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="flex-1">
                                <div class="published-date">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>Dipublikasi <?php echo esc_html(get_the_date('M d, Y')); ?></span>
                                </div>
                                <div class="category-tags">
                                    <?php $cats = get_the_category(); foreach ($cats as $cat): ?>
                                        <a class="category-tag" href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                                <h2 class="post-title text-xl md:text-2xl font-bold mb-3">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-excerpt text-base mb-4 leading-relaxed">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-0">
                                    <div class="author-info flex items-center gap-2 text-sm">
                                        <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white" style="background-color: var(--accent-color);">
                                            <?php echo strtoupper(substr(get_the_author(), 0, 1)); ?>
                                        </span>
                                        <span class="text-sm font-medium" style="color: var(--text-secondary);"> <?php the_author(); ?> </span>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn-primary text-sm font-medium w-full sm:w-auto">Baca Selengkapnya
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-12">
                <?php the_posts_pagination([
                    'mid_size' => 2,
                    'prev_text' => __('\u2190 Sebelumnya', 'zekktech'),
                    'next_text' => __('Berikutnya \u2192', 'zekktech'),
                ]); ?>
            </div>
        <?php else: ?>
            <div class="card rounded-xl p-12 text-center">
                <h3 class="text-xl font-semibold mb-2" style="color: var(--text-primary);">TIDAK ADA POSTINGAN</h3>
                <p style="color: var(--text-secondary);">Belum ada post yang dipublikasi.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
