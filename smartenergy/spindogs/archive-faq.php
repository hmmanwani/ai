<?php
/*
Template name: FAQ List Template
*/
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields(get_option('faq_archive'));

//Gets Post Categories
$args = array(
    'taxonomy' => 'faq_category',
    'hide_empty' => true,
);

$context['categories'] = Timber::get_terms($args);
$context['tabbed_data'] = [];
if (!empty($context['categories'])){
    foreach ($context['categories'] as $key => $value){
        $context['tabbed_data'][$value->term_id]['name'] = $value->name;

        $category_posts = get_posts(array(
            'post_type' => 'faq',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'faq_category',
                    'field'     => 'term_id',
                    'terms'     => $value->term_id,
                ),
            )
        ));

        if (!empty($category_posts)){
            $context['tabbed_data'][$value->term_id]['posts'] = $category_posts;
        }

    }
}

Timber::render('archive-faq.twig', $context);
