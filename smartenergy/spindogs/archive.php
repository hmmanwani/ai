<?php

use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

//Gets Post Categories
$args = array(
    'taxonomy' => 'category',
    'hide_empty' => true,
);

$context['categories'] = Timber::get_terms($args);
$context['archive_url'] = get_post_type_archive_link('post');
if (!empty($_GET['category_id'])){
    $context['selected_category'] = $_GET['category_id'];
}

Timber::render('archive.twig', $context);
