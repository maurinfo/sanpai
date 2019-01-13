<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagination_Utility
{
    public function get_config($controller)
    {
        return array(
            'base_url' => $controller->config->base_url() . get_class($controller),
            'per_page' => DEFAULT_PAGE_LIMIT,
            'num_links' => 10,

            'use_page_numbers' => true,
            'attributes' => array('class' => 'page-link'),

            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',

            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',

            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',

            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',

            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',

            'cur_tag_open' => '<li class="page-item active" aria-current="page"><a class="page-link" href="#">',
            'cur_tag_close' => '</a></li>',
        );
    }
}
