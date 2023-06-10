<?php
$args = [
    'posts_per_page' => -1,
    'post_type'      => 'products',
];

$post_query = new WP_Query($args);

?>

<div class="wp-block-group is-layout-constrained wp-block-group-is-layout-constrained " style="padding-top:2rem;padding-bottom:2rem">
    <div class="wp-block-group is-layout-constrained wp-container-38 wp-block-group-is-layout-constrained" style="margin-top:2rem;margin-bottom:2rem">
        <div class="wp-block-group is-layout-constrained wp-container-23 wp-block-group-is-layout-constrained" style="padding-bottom:30px">
            <h2 class="has-text-align-center wp-block-heading">Our Products</h2>
            <p class="has-text-align-center has-text-color" style="color:#666666;font-size:0.8rem;letter-spacing:1px;text-transform:uppercase">This is your awesome sub title</p>
        </div>



        <div class="container">
            <div class="row">
                <?php
                if ($post_query->have_posts()) :
                    $i = 0;
                    while ($post_query->have_posts()) :
                        $post_query->the_post();
                ?>
                        <div class="col col-4">
                            <div class="bg-light my-3 text-dark text-center">
                                <h3 class="p-2">
                                    <a class="text-dark text-decoration-none py-5" href="<?php the_permalink(); ?>" title="Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="d-flex flex-row-reverse py-3">
                                    <figure class="wp-block-image size-full"><img decoding="async" loading="lazy" width="500" height="333" src="<?= get_image_src() ?>" alt="product-8" class="wp-image-15" srcset="<?= get_image_src() ?> 500w, <?= get_image_src() ?> 300w" sizes="(max-width: 500px) 100vw, 500px">
                                        <figcaption class="wp-element-caption"><?php get_image_alt(); ?></figcaption>
                                    </figure>
                                </div>
                            </div>

                        </div>


                <?php
                        $i++;
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>