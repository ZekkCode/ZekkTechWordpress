<?php get_header(); ?>

<h1 class="text-2xl font-bold mb-6">Hasil Pencarian: <?php echo get_search_query(); ?></h1>

<?php if (have_posts()) : ?>
    <div class="space-y-6">
        <?php while (have_posts()) : the_post(); ?>
            <article class="card rounded-xl p-6">
                <h2 class="text-xl font-semibold mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
            </article>
        <?php endwhile; ?>
    </div>

    <div class="mt-8">
        <?php the_posts_pagination(); ?>
    </div>
<?php else: ?>
    <p>Tidak ada hasil ditemukan.</p>
<?php endif; ?>

<?php get_footer(); ?>
