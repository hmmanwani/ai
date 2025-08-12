<?php

use Timber\Timber;

$context = Timber::context();
$context['fields'] = get_fields();

if (isset($context['fields']['flex_blocks']) && is_array($context['fields']['flex_blocks'])) {
    foreach ($context['fields']['flex_blocks'] as $key => $block) {
        if ($block['acf_fc_layout'] == 'form' && !empty($block['form'])) {
            $context['fields']['flex_blocks'][$key]['form'] = new App\FormBuilder\Output($block['form']);
            $context['fields']['flex_blocks'][$key]['form']->prepare();
        }
    }
}

Timber::render('page.twig', $context);
