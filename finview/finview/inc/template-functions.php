<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package finview
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function finview_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    if (function_exists('tutor')) {
        $user_name = sanitize_text_field(get_query_var('tutor_student_username'));
        $get_user = tutor_utils()->get_user_by_login($user_name);
    }

    if (!empty($get_user)) {
        $classes[] = 'profile-breadcrumb';
    }

    return $classes;
}
add_filter('body_class', 'finview_body_classes');

/**
 * Get tags.
 */
// function finview_get_tag() {
//     $html = '';
//     if ( has_tag() ) {
//         $html .= '<div class="tp-post-tag"><span>' . esc_html__( 'Post Tags : ', 'finview' ) . '</span>';
//         $html .= get_the_tag_list( '', ' ', '' );
//         $html .= '</div>';
//     }
//     return $html;
// }

function finview_get_tag()
{
    $html = '';
    if (has_tag()) {
        $html .= '<div class="tp-post-tag"><span>' . esc_html__('Post Tags : ', 'finview') . '</span>';
        $tag_list = get_the_tag_list('', ' ', '');
        $tag_list_with_classes = str_replace('<a ', '<a class="btn_theme btn_alt" ', $tag_list);

        $html .= $tag_list_with_classes;
        $html .= '</div>';
    }
    return $html;
}




/**
 * Get categories.
 */
function finview_get_category()
{

    $categories = get_the_category(get_the_ID());
    $x = 0;
    foreach ($categories as $category) {

        if ($x == 2) {
            break;
        }
        $x++;
        print '<a class="news-tag" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>';
    }
}
function finview_get_social()
{ ?>

    <div class="social flex-wrap">
        <p class="share_title flex-shrink-0 mb-0"><?php echo esc_html__('Share -', 'finview') ?></p>
        <a href="http://www.facebook.com/sharer/sharer.php?u=" class="box_8 p-0 btn_theme btn_alt "><i class="bi bi-facebook"></i></a>
        <a href="http://www.twitter.com/share?url=" class="box_8 p-0 btn_theme btn_alt "><i class="bi bi-twitter"></i></a>
        <a href="https://pinterest.com/pin/create/button/?url=" class="box_8 p-0 btn_theme btn_alt "><i class="bi bi-pinterest"></i></a>
        <a href="http://www.twitch.com/share?url=" class="box_8 p-0 btn_theme btn_alt "><i class="bi bi-twitch"></i></a>
        <a href="https://skype.com/pin/create/button/?url=" class="box_8 p-0 btn_theme btn_alt "><i class="bi bi-skype"></i></a>
    </div>

<?php
}



/** img alt-text **/
function finview_img_alt_text($img_er_id = null)
{
    $image_id = $img_er_id;
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', false);
    $image_title = get_the_title($image_id);

    if (!empty($image_id)) {
        if ($image_alt) {
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', false);
        } else {
            $alt_text = get_the_title($image_id);
        }
    } else {
        $alt_text = esc_html__('Image Alt Text', 'finview');
    }

    return $alt_text;
}

// finview_ofer_sidebar_func
function finview_offer_sidebar_func()
{
    if (is_active_sidebar('offer-sidebar')) {

        dynamic_sidebar('offer-sidebar');
    }
}
add_action('finview_offer_sidebar', 'finview_offer_sidebar_func', 20);

// finview_service_sidebar
function finview_service_sidebar_func()
{
    if (is_active_sidebar('services-sidebar')) {

        dynamic_sidebar('services-sidebar');
    }
}
add_action('finview_service_sidebar', 'finview_service_sidebar_func', 20);

// finview_portfolio_sidebar
function finview_portfolio_sidebar_func()
{
    if (is_active_sidebar('portfolio-sidebar')) {

        dynamic_sidebar('portfolio-sidebar');
    }
}
add_action('finview_portfolio_sidebar', 'finview_portfolio_sidebar_func', 20);

// finview_faq_sidebar
function finview_faq_sidebar_func()
{
    if (is_active_sidebar('faq-sidebar')) {

        dynamic_sidebar('faq-sidebar');
    }
}
add_action('finview_faq_sidebar', 'finview_faq_sidebar_func', 20);