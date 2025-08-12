<?php
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

Timber::render('single-service.twig', $context);
