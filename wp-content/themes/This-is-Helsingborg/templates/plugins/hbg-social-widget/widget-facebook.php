<!-- Facebook feed -->
<?php echo $before_widget; ?>
    <?php if (in_array($args['id'], array('left-sidebar', 'left-sidebar-bottom', 'right-sidebar'))) get_template_part('templates/partials/stripe'); ?>
    <h3 class="box-title"><i class="fa fa-facebook-square"></i> <?php echo (isset($instance['title']) && strlen($instance['title']) > 0) ? $instance['title'] : 'Facebook'; ?></h3>

    <div class="box-content hbg-social-feed hbg-social-feed-facebook">
        <?php if ($feed && count($feed) > 0) : ?>
        <ul>
            <?php
                $int = 0;
                foreach ($feed as $post) :

                $date = new DateTime($post->created_time);
                $timeZone = new DateTimeZone('Europe/Stockholm');
                $date->setTimezone($timeZone);
            ?>
            <li>
                <?php
                    if (isset($post->full_picture)) :
                ?>
                    <div class="hbg-social-feed-image" style="background-image: url(<?php echo $post->full_picture; ?>);"></div>
                <?php endif; ?>
                <div class="hbg-social-feed-post-content">
                    <span class="hbg-social-feed-post-date"><?php echo $date->format('Y-m-d H:i'); ?></span>
                    <article>
                        <?php echo wp_trim_words($post->message, 30, $more = '…<br><a href="' . $post->link . '" target="_blank" class="read-more">Läs mer</a>'); ?>
                    </article>
                    <?php if ($post->status_type == 'shared_story') : ?>
                    <a href="<?php echo $post->link; ?>" target="_blank" class="hbg-social-feed-post-attachment">
                        <span class="hbg-social-feed-post-attachment-title"><?php echo $post->name; ?></span>
                        <span class="hbg-social-feed-post-attachment-description"><?php echo wp_trim_words($post->description, 10, $more = '…'); ?></span>
                        <span class="hbg-social-feed-post-attachment-caption"><?php echo $post->caption; ?></span>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </li>
            <?php $int++; if ($int == $instance['show_count']) break; endforeach; ?>
        </ul>
        <?php else : ?>
            <p>Inga bilder att visa</p>
        <?php endif; ?>
        <div class="clearfix"></div>

        <?php if (isset($instance['show_visit_button']) && $instance['show_visit_button'] == 'on') : ?>
        <div class="text-center hbg-social-feed-actions">
            <a href="https://www.facebook.com/<?php echo $instance['username']; ?>" target="_blank" class="list-more">Besök oss på Facebook</a>
        </div>
        <?php endif; ?>
    </div>
<?php echo $after_widget; ?>