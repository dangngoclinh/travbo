<div id="comments">
    <?php if (have_comments()) : ?>
        <h3 class="main-block-title">
            <?php $comment_count = wp_count_comments(get_the_ID()); ?>
            <span><span class="number-comments"><?php echo $comment_count->approved; ?></span> Comments</span>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
                'reply_text' => 'Reply <i class="fa fa-reply"></i>',
            ));
            ?>
        </ul>
        <?php if (!comments_open()): ?>
            <p class="no-comments"><?php _e('Comments are closed.', 'travbo'); ?></p>
        <?php endif; // comments don't open ?>

        <div class="comment-navigation clearfix">
            <?php
            if ($prev_link = get_previous_comments_link(__('<i class="fa fa-angle-left"></i> Older Comments', 'travbo'))) :
                printf('<div class="nav-button nav-previous fl-left">%s</div>', $prev_link);
            endif;

            if ($next_link = get_next_comments_link(__('Newer Comments <i class="fa fa-angle-right"></i>', 'travbo'))) :
                printf('<div class="nav-button nav-next fl-right">%s</div>', $next_link);
            endif;
            ?>
        </div>

    <?php endif; // have comments ?>

    <?php if (comments_open()) : ?>
        <div class="comment-respond">
            <?php comment_form(
                array(
                    'title_reply_before' => '<h3 class="main-block-title">',
                    'title_reply_after' => '</h3>',
                    'title_reply' => '<span>Leave your comment</span>',

                ));
            ?>
        </div>
    <?php endif; // Comments Open?>
</div>