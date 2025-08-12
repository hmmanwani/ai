<?php
use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

Timber::render('single-study.twig', $context);
