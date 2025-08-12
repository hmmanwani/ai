<?php
use Timber\Timber;

$context = Timber::context();

Timber::render('search.twig', $context);
