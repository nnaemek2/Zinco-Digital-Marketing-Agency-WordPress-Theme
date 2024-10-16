<?php
$term_list = cms_get_grid_term_list('post');
vc_map(
    array(
        'name'     => esc_html__('Blog Grid', 'zinco'),
        'base'     => 'ct_blog_grid',
        'class'    => 'ct-icon-element',
        'description' => esc_html__( 'Posts in masonry grid', 'zinco' ),
        'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'ct_blog_grid',
                'heading' => esc_html__('Shortcode Template', 'zinco'),
                'admin_label' => true,
                'std' => 'ct_blog_grid.php',
                'group' => esc_html__('Template', 'zinco'),
            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__('Custom Source', 'zinco'),
                'param_name' => 'custom_source',
                'value'      => '1',
                'description'        => 'Check here if you want custom source',
                'group'      => esc_html__('Source Settings', 'zinco')
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__('Select Categories', 'zinco'),
                'param_name' => 'source',
                'description' => esc_html__('Leave blank to select all category', 'zinco'),
                'settings'   => array(
                    'multiple' => true,
                    'values'   => $term_list['auto_complete'],
                ),
                'dependency' => array(
                    'element'=>'custom_source',
                    'value'=>array(
                        'true',
                    )
                ),
                'group'      => esc_html__('Source Settings', 'zinco'),
            ),
            array(
                'type'       => 'autocomplete',
                'class'      => '',
                'heading'    => esc_html__('Select Post Name', 'zinco'),
                'param_name' => 'post_ids',
                'description' => esc_html__('Leave blank to show all post', 'zinco'),
                'settings'   => array(
                    'multiple' => true,
                    'values'   => cms_get_type_posts_data('post')
                ),
                'dependency' => array(
                    'element'=>'custom_source',
                    'value'=>array(
                        'true',
                    )
                ),
                'group'      => esc_html__('Source Settings', 'zinco'),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Order by', 'zinco'),
                'param_name' => 'orderby',
                'value'      => array(
                    'Date'   => 'date',
                    'ID'     => 'ID',
                    'Author' => 'author',
                    'Title'  => 'title',
                    'Random' => 'rand',
                ),
                'std'        => 'date',
                'group'      => esc_html__('Source Settings', 'zinco')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Sort order', 'zinco'),
                'param_name' => 'order',
                'value'      => array(
                    'Ascending'  => 'ASC',
                    'Descending' => 'DESC',
                ),
                'std'        => 'DESC',
                'group'      => esc_html__('Source Settings', 'zinco')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Total items', 'zinco'),
                'param_name' => 'limit',
                'value'      => '6',
                'group'      => esc_html__('Source Settings', 'zinco'),
                'description' => esc_html__('Set max limit for items in grid. Enter number only', 'zinco'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Length of excerpt', 'zinco' ),
                'param_name' => 'length_excerpt',
                'value' => '',
                'group'      => esc_html__('Source Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image size', 'zinco' ),
                'param_name' => 'img_size',
                'value' => '',
                'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height). Enter multiple sizes (Example: 100x100,200x200,300x300)).', 'zinco' ),
                'group'      => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Type', 'zinco'),
                'param_name' => 'layout',
                'value'      => array(
                    'Masonry' => 'masonry',
                    'Basic'   => 'basic',
                ),
                'group'      => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Filter on Masonry', 'zinco'),
                'param_name' => 'filter',
                'value'      => array(
                    'Disable' => 'false',
                    'Enable'  => 'true',
                ),
                'dependency' => array(
                    'element' => 'layout',
                    'value'   => 'masonry'
                ),
                'group'      => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Pagination Type', 'zinco'),
                'param_name' => 'pagination_type',
                'value'      => array(
                    'Pagination'  => 'pagination',
                    'Loadmore' => 'loadmore',
                    'Disable' => 'false',
                ),
                'dependency' => array(
                    'element' => 'layout',
                    'value'   => 'masonry'
                ),
                'group'      => esc_html__('Grid Settings', 'zinco'),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Default Title', 'zinco'),
                'param_name' => 'filter_default_title',
                'value'      => 'All',
                'group'      => esc_html__('Filter', 'zinco'),
                'description' => esc_html__('Enter default title for filter option display, empty: All', 'zinco'),
                'dependency' => array(
                    'element' => 'filter',
                    'value'   => 'true'
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Item Gap', 'zinco'),
                'param_name' => 'gap',
                'value'      => '30',
                'group'      => esc_html__('Grid Settings', 'zinco'),
                'description' => esc_html__('Select gap between grid elements. Enter number only', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns XS', 'zinco'),
                'param_name'       => 'col_xs',
                'edit_field_class' => 'vc_col-sm-1/5 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 1,
                'group'            => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns SM', 'zinco'),
                'param_name'       => 'col_sm',
                'edit_field_class' => 'vc_col-sm-1/5 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 2,
                'group'            => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns MD', 'zinco'),
                'param_name'       => 'col_md',
                'edit_field_class' => 'vc_col-sm-1/5 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 3,
                'group'            => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns LG', 'zinco'),
                'param_name'       => 'col_lg',
                'edit_field_class' => 'vc_col-sm-1/5 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 4,
                'group'            => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type'             => 'dropdown',
                'heading'          => esc_html__('Columns XL', 'zinco'),
                'param_name'       => 'col_xl',
                'edit_field_class' => 'vc_col-sm-1/5 vc_column',
                'value'            => array(1, 2, 3, 4, 6, 12),
                'std'              => 4,
                'group'            => esc_html__('Grid Settings', 'zinco'),
                'dependency' => array(
                    'element'=>'cms_template',
                    'value'=>array(
                        'ct_blog_grid.php',
                    )
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra class name', 'zinco' ),
                'param_name' => 'el_class',
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
                'group'            => esc_html__('Extra', 'zinco')
            ),
        )
    )
);

class WPBakeryShortCode_ct_blog_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('ct-blog-grid');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>