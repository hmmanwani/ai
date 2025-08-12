<?php

namespace App\FormBuilder;

use Spindogs\Platform\CSV;
use Spindogs\Platform\OptionsPage;
use Timber\Timber;

class Service
{
    /**
     * Setup the Form Builder
     *
     * @return void
     */
    public static function setup()
    {
        PostType::setup();
       
        if (isset($_REQUEST['form_type']) && strlen($_REQUEST['form_type']) > 0 && !empty($_REQUEST['export'])) {
            self::exportForm();
        } elseif (isset($_REQUEST['response_id']) && strlen($_REQUEST['response_id']) > 0 && !empty($_REQUEST['export'])) {
            self::exportForm([self::getById($_REQUEST['response_id'])]);
        }
        add_action('admin_menu', array(__CLASS__, 'addFormMenu'));
        add_action('acf/init', array(__CLASS__, 'addFieldGroups'));
    }

    /**
     * Add the Form Builder menu
     *
     * @return void
     */
    public static function addFormMenu()
    {
        add_submenu_page(
            'edit.php?post_type=form',
            'Form Submissions',
            'Form Submissions',
            'publish_pages',
            'formbuilder',
            array(__CLASS__, 'listAll'),
            33
        );
    }

    /**
     * Gets all form Responses
     *
     * @param int $form_type The form-ID to get.
     * 
     * @return object[]
     */
    public static function getFormResponses($form_type = null)
    {
        if ($form_type === null 
            && isset($_REQUEST['form_type']) 
            && strlen($_REQUEST['form_type']) > 0 
            && $_REQUEST['form_type'] != 'All'
        ) {
            $form_type = sanitize_text_field($_REQUEST['form_type']);
        }
        try {
            if ($form_type) {
                return Response::where('form_id', $form_type)->get();
            } else {
                return Response::all();
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get a single response by ID
     *
     * @param int $id The ID
     * 
     * @return object
     */
    public static function getByID($id)
    {   
        try {
            return Response::find($id);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Gets all Form post-types in ID -> Title format
     * 
     * @return array
     */
    public static function getFormTypes()
    {
        $args = array(
            'post_type' => 'form',
            'posts_per_page' => -1
        );
        $posts = get_posts($args);
        if (empty($posts)) {
            return array();
        }
        return wp_list_pluck($posts, 'post_title', 'ID');
    }

    /**
     * Exports a given form to a CSV file
     *
     * @param array $responses The responses to export
     * 
     * @return void Exits
     */
    public static function exportForm($responses = null)
    {
        if ($responses === null) {
            $responses = self::getFormResponses();
        }

        if (empty($responses)) {
            return;
        }

        $headings = array();
        $rows = array();

        foreach ($responses as $value) {
            $form_data = json_decode($value->data);
            $rows[$value->id] = array();

            foreach ($form_data as $data_key => $data_value) {
                if (in_array($data_key, ['form_id', 'submit'])) {
                    continue;
                }

                if (!in_array($data_key, $headings)) {
                    $headings[] = $data_key;
                }

                $rows[$value->id][$data_key] = is_array($data_value) ? implode(', ', $data_value) : $data_value;
                
            }
        }
        CSV::export('export.csv', $rows, $headings);
    }

    /**
     * Outputs all form submissions
     *
     * @return void
     */
    public static function listAll()
    {
        Timber::$locations = array(
            __DIR__ . '/views/'
        );
        $data = Timber::context();

        if (!empty($_REQUEST['form_response_id'])) {
            $data['form'] = self::getById($_REQUEST['form_response_id']);
            Timber::render('single.twig', $data);
        } else {
            $data = array_merge(
                $data,
                array(
                    'responses' => self::getFormResponses(),
                    'form_types' => self::getFormTypes(),
                    'action_url' => admin_url('edit.php'),
                )
            );

            Timber::render('list.twig', $data);
        }
    }

    /**
     * Adds the field groups for form builder integrations
     *
     * @return void
     */
    public static function addFieldGroups() {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(
                array(
                    'key' => 'form_integrations',
                    'title' => 'Form Integrations',
                    'fields' => array(
                        array(
                            'key' => 'mailchimp_api_key',
                            'label' => 'Mailchimp API Key',
                            'name' => 'mailchimp_api_key',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'campaign_monitor_api_key',
                            'label' => 'Campaign Monitor API Key',
                            'name' => 'campaign_monitor_api_key',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'recaptcha_site_key',
                            'label' => 'ReCAPTCHA Site Key',
                            'name' => 'recaptcha_site_key',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                        array(
                            'key' => 'recaptcha_site_secret',
                            'label' => 'ReCAPTCHA Secret Key',
                            'name' => 'recaptcha_site_secret',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                        ),
                    ),
                    'location' => array(
                        array(
                            array(
                                'param' => 'options_page',
                                'operator' => '==',
                                'value' => OptionsPage::getParentMenuSlug(),
                            ),
                        ),
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => '',
                )
            );

        }
    }
}
