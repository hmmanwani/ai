<?php
/*
Template name: Study List Template
*/
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields(get_option('study_archive'));

//Gets Post Categories
$args = array(
    'taxonomy' => 'study_category',
    'hide_empty' => true,
);

$context['categories'] = Timber::get_terms($args);
$context['archive_url'] = get_post_type_archive_link('study');
if (!empty($_GET['category_id'])){
    $context['selected_category'] = $_GET['category_id'];
}

Timber::render('archive-study.twig', $context);
