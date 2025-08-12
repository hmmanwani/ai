<?php

namespace App\FormBuilder;

use Spindogs\Platform\Form;
use App\FormBuilder\Response;
use Spindogs\Platform\CampaignMonitor;
use Spindogs\Platform\Mailchimp;

class Output
{

    public $form_id;
    public $confirmation_field;
    public $confirmation_email;
    public $confirmation_email_subject;
    public $confirmation_email_message;
    public $form;
    public $selected_recaptcha;

    /**
     * Constructor with Form ID
     * 
     * @param int $form_id the Form ID
     */
    public function __construct($form_id)
    {
        $this->form_id = $form_id;
    }

    /**
     * Prepare the form for display and run validation
     * 
     * @return void
     */
    public function prepare()
    {

        $form_id = $this->form_id;

        $form_fields = get_field('form_builder', $form_id);
        $form_emails = get_field('email_receivers', $form_id);
        $button_text = get_field('button_text', $form_id);
        $redirect_url = get_field('redirect_url', $form_id) ?: home_url();
        $email_subject = get_field('email_subject', $form_id);
        $form_title = get_field('form_title', $form_id);
        $use_mailchimp = get_field('use_mailchimp', $form_id);
        $use_campaignmonitor = get_field('use_campaign_monitor', $form_id);
        $mailchimp_list_id = get_field('mailchimp_list_id', $form_id);
        $campaign_monitor_list_id = get_field('campaign_monitor_list_id', $form_id);
        $use_recaptcha = get_field('use_recaptcha', $form_id);

        $show_recaptcha = false;
        $mailchimp_integration = false;
        $campaign_monitor_integration = false;

        if (!empty($use_recaptcha)) {
            $recaptcha_secret = get_field('recaptcha_site_secret', 'option');
            $recaptcha_site_key = get_field('recaptcha_site_key', 'option');
        }

        if (!empty($use_recaptcha) && !empty($recaptcha_secret) && !empty($recaptcha_site_key)) {
            $show_recaptcha = true;
        }

        if (!empty($use_mailchimp)) {
            $maichimp_api_key = get_field('mailchimp_api_key', 'option');
            if (!empty($maichimp_api_key) && !empty($mailchimp_list_id)) {
                $mailchimp_integration = true;
            }
        }

        if (!empty($use_campaignmonitor)) {
            $campaignmonitor_api_key = get_field('campaign_monitor_api_key', 'option');
            if (!empty($campaign_monitor_list_id) && !empty($campaignmonitor_api_key)) {
                $campaign_monitor_integration = true;
            }
        }

        $this->form = new Form('FormBuilder' . str_replace(' ', '_', $form_title));
        $this->form->placeholder_all = true;
        $this->form->require_all = true;

        $this->form->hidden('form_name', $form_title);
        $this->form->hidden('form_id', $form_id);

        foreach ($form_fields as $key => $value) {
            switch ($value['acf_fc_layout']) {
            case 'text_input':
                $this->form->text('_' . str_replace(' ', '_', $value['name']), $value['label'], '', $value['required'], array('placeholder' => $value['placeholder']));
                break;
            case 'textarea_input':
                $this->form->textarea('_' . str_replace(' ', '_', $value['name']), $value['label'], '', $value['required'], array('placeholder' => $value['placeholder']));
                break;
            case 'email_input':
                $this->form->email('_' . str_replace(' ', '_', $value['name']), $value['label'], '', $value['required'], array('placeholder' => $value['placeholder']));
                break;
            case 'select_box':
                $select_values = array();
                foreach ($value['values'] as $key => $inner_value) {
                    $select_values[$inner_value['value']] =  $inner_value['value'];
                }
                $this->form->select('_' . preg_replace("#[[:punct:]]#", "", str_replace(' ', '_', $value['name'])), $value['label'], $select_values, '', $value['required'], array('first_option' => $value['placeholder']));
                break;
            case 'radiobuttons':
                $select_values = array();
                foreach ($value['values'] as $key => $inner_value) {
                    $select_values[$inner_value['value']] =  $inner_value['value'];
                }
                $this->form->radio('_' . preg_replace("#[[:punct:]]#", "", str_replace(' ', '_', $value['name'])), $value['label'], $select_values, '', $value['required']);
                break;
            case 'checkboxes':
                $select_values = array();
                foreach ($value['values'] as $key => $inner_value) {
                    $select_values[$inner_value['value']] =  $inner_value['value'];
                }
                $this->form->checkboxes('_' . preg_replace("#[[:punct:]]#", "", str_replace(' ', '_', $value['name'])), $value['label'], $select_values, '', $value['required']);
                break;
            case 'file_input':
                $this->form->file('_' . str_replace(' ', '_', $value['name']), $value['label'], '', $value['required']);
                break;
            }
        }

        if ($show_recaptcha) {
            $this->form->recaptcha2($recaptcha_site_key, $recaptcha_secret);
        }

        $this->form->submit($button_text);


        if ($this->form->success()) {
            $response = new Response();
            $response->name =  $this->form->values['form_name'];
            $response->form_id = $form_id;
            $response->data = json_encode($this->form->values);
            $response->save();

            $subject = $email_subject;
            $message = '';

            foreach ($this->form->values as $key => $value) {
                if (in_array($key, array('form_id', 'submit'))) {
                    continue;
                }

                if (is_array($value)) {
                    foreach ($value as $value_key => $value_value) {
                        $message .= str_replace('_', ' ', $value_key). ': ' . $value_value . "<br>";
                    }
                } else {
                    $message .= str_replace('_', ' ', $key). ': ' . $value . "<br>";
                }
            }

            $headers = array('Content-Type: text/html; charset=UTF-8');
            foreach ($form_emails as $email_value) {
                wp_mail($email_value['email'], $subject, $message, $headers);
            }

            wp_redirect($redirect_url);
            exit;
        }

    }

    /**
     * Displays the form 
     * 
     * @return void
     */
    public function display()
    {
        $this->form->display();
    }

}
