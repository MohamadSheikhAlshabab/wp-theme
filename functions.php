<?php

function alshabab_add_styles()
{

    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/assets/css/all.min.css');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
}


function alshabab_add_scripts()
{

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('fontawesome-js', get_template_directory_uri() . '/assets/js/all.min.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'alshabab_add_styles');
add_action('wp_enqueue_scripts', 'alshabab_add_scripts');


add_theme_support('post-thumbnails');
function products_custom_post_type()
{
    register_post_type(
        'products',
        array(
            'labels' => array(
                'name' => __('Products'),
                'singular_name' => __('product')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'products'),
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt', 'revisions', 'custom-fields'),
            'taxonomies' => array('category', 'tags'),
        )
    );
};

add_action('init', 'products_custom_post_type');
add_action('after_setup_theme', 'products_custom_post_type');


function reg_tag()
{
    register_taxonomy_for_object_type('post_tag', 'products');
}
add_action('init', 'reg_tag');


function add_featured_image_support()
{
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'add_featured_image_support');


function get_image_src()
{
    $post_content = get_the_content();

    preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/', $post_content, $matches);

    if (isset($matches[1])) {
        return $image_source = $matches[1];
        //echo 'Image URL: ' . $image_source;
    } else {
        echo 'No image found in the post content.';
    }
}

function get_image_alt()
{
    $post_content = get_the_content();

    preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/', $post_content, $matches);

    if (isset($matches[0])) {
        $image_tag = $matches[0];
        preg_match('/alt=[\'"]([^\'"]+)[\'"]/', $image_tag, $alt_matches);
        if (isset($alt_matches[1])) {
            echo $alt_text = $alt_matches[1];
        } else {
            echo 'Alt Text not found.';
        }
    } else {
        echo 'No image found in the post content.';
    }
}


function mytheme_comment($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    } ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>"><?php
                                                                                                                                        if ('div' != $args['style']) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
                                                                                                                                        } ?>
            <div class="comment-author vcard"><?php
                                                if ($args['avatar_size'] != 0) {
                                                    echo get_avatar($comment, $args['avatar_size']);
                                                }
                                                printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
            </div><?php
                    if ($comment->comment_approved == '0') { ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br /><?php
                                                                                                                        } ?>
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php
                                                                                                        /* translators: 1: date, 2: time */
                                                                                                        printf(
                                                                                                            __('%1$s at %2$s'),
                                                                                                            get_comment_date(),
                                                                                                            get_comment_time()
                                                                                                        ); ?>
                </a><?php
                    edit_comment_link(__('(Edit)'), '  ', ''); ?>
            </div>

            <?php comment_text(); ?>

            <div class="reply"><?php
                                comment_reply_link(
                                    array_merge(
                                        $args,
                                        array(
                                            'add_below' => $add_below,
                                            'depth'     => $depth,
                                            'max_depth' => $args['max_depth']
                                        )
                                    )
                                ); ?>
            </div><?php
                    if ('div' != $args['style']) : ?>
            </div><?php
                    endif;
                }
