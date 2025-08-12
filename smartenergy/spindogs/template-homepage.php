<?php
/*
Template name: Homepage Template
*/

use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

Timber::render('template-homepage.twig', $context);
