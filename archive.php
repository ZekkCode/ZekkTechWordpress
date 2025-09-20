<?php get_header(); ?>

<header class="mb-6">
    <h1 class="text-3xl font-bold"><?php the_archive_title(); ?></h1>
    <div class="text-[color:var(--text-secondary)]"><?php the_archive_description(); ?></div>
</header>

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
    <p>Tidak ada postingan.</p>
<?php endif; ?>

<?php get_footer(); ?>
