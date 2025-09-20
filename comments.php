<?php
if (post_password_required()) return;
?>
<div id="comments" class="mt-10 card rounded-xl p-6">
    <?php if (have_comments()) : ?>
        <h2 class="text-xl font-semibold mb-4">
            <?php
            $count = get_comments_number();
            echo esc_html($count . ' Komentar');
            ?>
        </h2>

        <ol class="comment-list list-none m-0 p-0">
            <?php
            wp_list_comments([
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 40,
                'callback'   => function ($comment, $args, $depth) {
                    $tag = ($args['style'] === 'div') ? 'div' : 'li';
                        echo '<' . $tag . ' ';
                        // Output class attribute properly
                        comment_class('comment-body', $comment);
                        echo ' id="comment-' . get_comment_ID() . '">';
                    echo '<div class="flex gap-3">';
                    echo get_avatar($comment, 40, '', '', ['class' => 'rounded-full']);
                    echo '<div class="flex-1">';
                    echo '<div class="comment-meta mb-1">';
                    echo '<strong>' . get_comment_author_link($comment) . '</strong> · ';
                    echo '<a href="' . esc_url(get_comment_link($comment)) . '">' . get_comment_date('', $comment) . '</a>';
                    echo '</div>';
                    if ($comment->comment_approved == '0') {
                        echo '<em class="comment-awaiting-moderation">Komentar menunggu moderasi.</em>';
                    }
                    comment_text($comment);
                    echo '<div class="mt-2">';
                    comment_reply_link(array_merge($args, [
                        'reply_text' => __('Balas', 'zekktech'),
                        'depth' => $depth,
                        'max_depth' => $args['max_depth']
                    ]));
                    echo '</div>';
                    echo '</div></div>';
                    echo '</' . $tag . '>';
                }
            ]);
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation mt-4">
                <div class="nav-previous float-left"><?php previous_comments_link(__('← Komentar Lama', 'zekktech')); ?></div>
                <div class="nav-next float-right"><?php next_comments_link(__('Komentar Baru →', 'zekktech')); ?></div>
                <div class="clear-both"></div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (comments_open()) : ?>
        <div id="respond" class="mt-6">
            <?php comment_form([ 'class_submit' => 'btn-primary' ]); ?>
        </div>
    <?php endif; ?>
</div>
