<?php
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

$duplicated_site = get_post_meta(get_the_ID(), 'duplicated_from', true);
$duplicated_site_id = get_post_meta(get_the_ID(), 'duplicated_from_id', true);
if (!empty($duplicated_site) && !empty($duplicated_site_id)){
    switch_to_blog($duplicated_site);
    $context['fields'] = get_fields($duplicated_site_id);
    restore_current_blog();
}

Timber::render('single.twig', $context);
