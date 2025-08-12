<?php
/*
Template name: Contact Template
*/

use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

Timber::render('template-contact.twig', $context);
