<?php
use Timber\Timber;
use Timber\Post;

$context = Timber::context();
$context['password_form'] = get_the_password_form();

Timber::render('password-protected.twig', $context);
