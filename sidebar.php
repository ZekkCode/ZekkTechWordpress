<aside class="w-full lg:w-1/3">
    <div class="space-y-8">
        <div class="card rounded-xl p-4 sm:p-6 sidebar-card">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--text-primary);">Kategori</h3>
            <div class="space-y-2">
                <?php
                $categories = get_categories(['hide_empty' => true]);
                foreach ($categories as $cat): ?>
                    <a href="<?php echo esc_url(get_category_link($cat)); ?>" class="flex items-center justify-between p-2 sm:p-3 rounded-lg transition-all duration-200 hover:shadow-md min-h-10" style="color: var(--text-secondary); background-color: var(--bg-secondary);">
                        <span class="font-medium text-sm sm:text-base"><?php echo esc_html($cat->name); ?></span>
                        <span class="text-xs px-2 py-1 rounded-full" style="background-color: var(--border-color);"><?php echo intval($cat->count); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="card rounded-xl p-4 sm:p-6 sidebar-card">
            <h3 class="text-lg font-semibold mb-4" style="color: var(--text-primary);">Postingan Terbaru</h3>
            <div class="space-y-3 sm:space-y-4">
                <?php
                $recent = new WP_Query([
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true
                ]);
                if ($recent->have_posts()):
                    while ($recent->have_posts()): $recent->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="block group min-h-10">
                            <div class="flex gap-3">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('thumbnail', ['class' => 'w-12 h-12 sm:w-16 sm:h-16 object-cover rounded-lg flex-shrink-0']); ?>
                                <?php endif; ?>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm leading-tight mb-1 group-hover:opacity-80 transition-opacity" style="color: var(--text-primary); "><?php echo wp_trim_words(get_the_title(), 12, '...'); ?></h4>
                                    <p class="text-xs" style="color: var(--text-secondary); "><?php echo esc_html(get_the_date('M d, Y')); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata();
                else: ?>
                    <p class="text-sm" style="color: var(--text-secondary);">Belum ada postingan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</aside>
