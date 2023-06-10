<?php
get_header();
?>
<div class="bg-light my-3 text-dark text-center">
    <div class="d-flex  py-3">
        <figure class="wp-block-image size-full d-flex justify-content-start m-5">
            <img decoding="async" loading="lazy" width="500" height="333" src="<?= get_image_src() ?>" alt="product-8" class="wp-image-15 mx-5" srcset="<?= get_image_src() ?> 500w, <?= get_image_src() ?> 300w" sizes="(max-width: 500px) 100vw, 500px">
        </figure>
        <div>
            <h3 class="mx-5 fs-1">
                <a class="text-dark text-decoration-none py-5 fw-bolder" href="<?php the_permalink(); ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>">
                    <?= the_title(); ?>
                </a>
            </h3>
            <a href="javascript:void(0)" role="button" class="a-popover-trigger a-declarative"> <span class="a-size-base a-color-base"> 4.0 </span> <i class="a-icon a-icon-star a-star-4 cm-cr-review-stars-spacing-big"><span class="a-icon-alt">4.0 out of 5 stars</span></i> <i class="a-icon a-icon-popover"></i></a>
            <span style="display: inline-block;width: 0.385em;"></span>
            <span class="a-declarative" data-action="acrLink-click-metrics" data-csa-c-type="widget" data-csa-c-func-deps="aui-da-acrLink-click-metrics" data-acrlink-click-metrics="{}" data-csa-c-id="kdiogu-nnscnv-xq5uq4-4us325"> <a id="acrCustomerReviewLink" class="a-link-normal" href="#customerReviews"> <span id="acrCustomerReviewText" class="a-size-base">101,960 ratings</span> </a> </span>
            <hr>
            <figcaption class="wp-element-caption px-5"><?php get_image_alt(); ?></figcaption>
        </div>
    </div>

    <hr class="w-75 mx-auto" size="5" noshade>
    <h3 class="comments-number">
        Total Comments : <?php comments_number(); ?>
    </h3>
    <hr class="w-75 mx-auto" size="5" noshade>

    <div class="comments-template">

        <?php //comments_template(); 
        wp_list_comments(
            array(
                'avatar_size'       => 120,
                'short_ping'        => true,
                'type'              => 'comment',
                'style'             => 'div',
                'callback'          => '',
                'per_page'          => get_option('comments_per_page'),
                'page'              => $cpage,
                'reverse_top_level' => get_option('default_comments_page') === 'oldest' ? false : true,
            )
        );
        $comments_args = array(
            // Change the title of send button 
            'label_submit' => __('Send', 'textdomain'),
            // Change the title of the reply section
            'title_reply' => __('Write a Review', 'textdomain'),
            // Remove "Text or HTML to be displayed after the set of comment fields".
            'comment_notes_after' => '',
            // Redefine your own textarea (the comment body).
            'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
        );
        comment_form($comments_args);
        ?>
        <hr>
        <!-- <?php //comment_form(); 
                ?> -->
    </div>

</div>
<?php get_footer(); ?>