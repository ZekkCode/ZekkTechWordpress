<?php get_header(); ?>

<article <?php post_class('card rounded-xl p-6'); ?>>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="mb-6">
            <h1 class="text-3xl md:text-4xl font-bold mb-3"><?php the_title(); ?></h1>
            <div class="flex flex-wrap items-center gap-3 text-sm" style="color: var(--text-secondary);">
                <span><?php echo esc_html(get_the_date('M d, Y')); ?></span>
                <span>•</span>
                <span><?php the_author_posts_link(); ?></span>
                <span>•</span>
                <span><?php echo get_the_category_list(', '); ?></span>
            </div>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="mb-6">
                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
            </div>
        <?php endif; ?>

        <div class="post-content prose max-w-none">
            <?php the_content(); ?>
        </div>

        <footer class="mt-8 flex flex-wrap gap-2">
            <?php the_tags('<span class="category-tag">', '</span><span class="category-tag">', '</span>'); ?>
        </footer>

        <?php comments_template(); ?>
    <?php endwhile; endif; ?>
</article>

<div class="mt-8">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
