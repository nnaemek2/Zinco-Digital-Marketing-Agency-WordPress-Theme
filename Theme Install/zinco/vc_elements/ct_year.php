<?php
vc_map(array(
    'name' => 'Year',
    'base' => 'ct_year',
));

class WPBakeryShortCode_ct_year extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>