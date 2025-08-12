<?php
/*
Template name: Service List Template
*/
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields(get_option('service_archive'));

//Gets Post Categories
$args = array(
    'taxonomy' => 'service_category',
    'hide_empty' => true,
);

$context['categories'] = Timber::get_terms($args);
$context['archive_url'] = get_post_type_archive_link('service');
if (!empty($_GET['category_id'])){
    $context['selected_category'] = $_GET['category_id'];
}

Timber::render('archive-service.twig', $context);
