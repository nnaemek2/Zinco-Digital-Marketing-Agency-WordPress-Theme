<?php
/**
 * @Template: cms-template-functions.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 19-Jan-18
 */

function cms_get_grid_term_list($post_type, $taxonomy = array())
{
    if (empty($taxonomy)) {
        $taxonomy = get_object_taxonomies($post_type, 'names');
    }
    $term_list = array();
    $term_list['terms'] = array();
    $term_list['auto_complete'] = array();
    foreach ($taxonomy as $tax) {
        $terms = get_terms(
            array(
                'taxonomy' => $tax,
                'hide_empty' => true,
            )
        );
        foreach ($terms as $term) {
            $term_list['terms'][] = $term->slug . '|' . $tax;
            $term_list['auto_complete'][] = array(
                'value' => $term->slug . '|' . $tax,
                'label' => $term->name,
            );
        }
    }

    return $term_list;
}

function cms_get_type_posts_data($post_type = 'post')
{
    $posts = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $result = array();
    foreach ($posts as $post) {
        $result[] = array(
            'value' => $post->ID,
            'label' => $post->post_title,
        );
    }

    return $result;
}

function cms_get_term_of_post_to_class($post_id, $tax = array())
{
    $term_list = array();
    foreach ($tax as $taxo) {
        $term_of_post = wp_get_post_terms($post_id, $taxo);
        foreach ($term_of_post as $term) {
            $term_list[] = $term->slug;
        }
    }

    return implode(' ', $term_list);
}

function cms_get_posts_of_grid($post_type = 'post', $atts = array(), $taxonomy = array(), $args_extra = array())
{
    extract($atts);
    if (!empty($post_ids)) {
        $args = array(
            'post_type' => $post_type,
            'numberposts' => !empty($limit) ? intval($limit) : 6,
            'order' => !empty($order) ? $order : 'DESC',
            'orderby' => !empty($orderby) ? $orderby : 'date',
            'post__in' => array_map('intval', explode(',', $post_ids))
        );
        if (get_query_var('paged')) {
            $cms_paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $cms_paged = get_query_var('page');
        } else {
            $cms_paged = 1;
        }
        $args['paged'] = intval($cms_paged);
        $posts = get_posts($args);
        $args['posts_per_page'] = !empty($limit) ? intval($limit) : 6;
        $cms_query = new WP_Query($args);
        $cms_query->set('paged', intval($cms_paged));
    } else {
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => !empty($limit) ? intval($limit) : 6,
            'order' => !empty($order) ? $order : 'DESC',
            'orderby' => !empty($orderby) ? $orderby : 'date',
            'tax_query' => array(
                'relation' => 'OR',
            )
        );
        $args = array_merge($args, $args_extra);
        //default categories selected
        $source = !empty($source) ? $source : '';
        // if select term on custom post type, move term item to cat.
        if (!empty($source)) {
            $source_a = explode(',', $source);
            foreach ($source_a as $terms) {
                $tmp = explode('|', $terms);
                if (isset($tmp[0]) && isset($tmp[1])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => $tmp[1],
                        'field' => 'slug',
                        'operator' => 'IN',
                        'terms' => array($tmp[0]),
                    );
                }
            }
        }
        if (get_query_var('paged')) {
            $cms_paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $cms_paged = get_query_var('page');
        } else {
            $cms_paged = 1;
        }
        $cms_query = new WP_Query($args);
        $cms_query->set('paged', intval($cms_paged));
        $cms_query->set('posts_per_page', !empty($limit) ? intval($limit) : 6);
        $query = $cms_query->query($cms_query->query_vars);
        $posts = $query;
    }

    if (!empty($source)) {
        $categories = explode(',', $source);
    } else {
        $source_new = cms_get_grid_term_list($post_type, $taxonomy);
        $categories = $source_new['terms'];
    }
    global $wp_query;
    $wp_query = $cms_query;
    $pagination = get_the_posts_pagination(array(
        'screen_reader_text' => '',
        'mid_size' => 2,
        'prev_text' => esc_html__('Back', 'cryptech'),
        'next_text' => esc_html__('Next', 'cryptech'),
    ));
    global $paged;
    $paged = $cms_paged;
    $categories = is_array($categories) ? $categories : array();

    return array(
        'posts' => $posts,
        'categories' => $categories,
        'query' => $cms_query,
        'paged' => $paged,
        'max' => $cms_query->max_num_pages,
        'next_link' => next_posts($cms_query->max_num_pages, false),
        'total' => $cms_query->found_posts,
        'pagination' => $pagination
    );
}

function cms_get_filter_grid($posts = array(), $post_type = 'post', $categories = array())
{
    if (empty($categories)) {
        $categories = get_object_taxonomies($post_type, 'names');
    }
    $filters = array();
    $term_list = array();
    foreach ($posts as $post) {
        $list = array();
        foreach ($categories as $tax) {
            $term_ids = wp_get_post_terms($post->ID, $tax, array('fields' => 'ids'));
            $term_slug = array();
            foreach ($term_ids as $term) {
                $_t = get_term($term, $tax);
                $term_list[$_t->slug] = $_t->name;
                $term_slug[] = $_t->slug;
            }
            $list = array_merge($list, $term_slug);
        }
        $filters[$post->ID] = $list;
    }

    return array(
        'terms' => $term_list,
        'filters' => $filters
    );
}