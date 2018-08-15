
    <li class="classic post-<?php the_ID() ?> product type-product status-publish">
        <h2 class="my-ac-course-title"><?php the_title() ?></h2>
        <div class="product-wrap">
            <a href="<?php the_permalink() ?>" target="_blank">
                <?php if(has_post_thumbnail()):?>
                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="Placeholder" class="woocommerce-placeholder wp-post-image">
                <?php endif ?>
            </a>
        </div>
        <div class="button-course">
            <a href="<?php the_permalink() ?>" target="_blank">
                <button class=" btn btn-primary btn-large">
                    <?php _e("Go to Course","mt_companion") ?> <i class="fas fa-arrow-right"></i>
                </button>
            </a>
        </div>
    </li>
