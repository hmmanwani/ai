<?php

namespace App\Forms;

use Spindogs\Platform\Form;

/**
 * App Form Class
 */
class ExampleForm
{
    /**
     * The form object
     * 
     * @var Form
     */
    public $form;

    /**
     * Prepares the form for display
     * 
     * @return void
     */
    public function prepare()
    {
        //Sets Here incase of multisite where translations needed
        $label_name = 'Name';
        $label_email = 'Email';
        $label_phone = 'Contact Number';
        $label_message = 'Message';
        $label_button = 'Submit';


        $options = array(
            1 => "One",
            2 => "Two",
            3 => "Three"
        );
        $initial = null;
        $required = true;
        $attrs = array(
            "test" => "test",
        );


        $this->form = new Form('ContactForm');
        
        $this->form->placeholder_all = true;
        $this->form->require_all = true;
        $this->form->inline_errors = true;

        $this->form->text('_name', $label_name);
        $this->form->email('_email', $label_email);
        $this->form->tel('_phone', $label_phone);
        $this->form->textarea('_message', $label_message);

        // $this->form->hidden("test", "test1");
        // $this->form->select('select', 'select', $options, $initial, $required, $attrs);
        // $this->form->multiselect('multiselect', 'multiselect', $options, $initial, $required, $attrs);
        // $this->form->radio('radio', 'radio', $options, $initial, $required, $attrs);
        // $this->form->checkboxes('checkboxes', 'checkboxes', $options, $initial, $required);
        // $this->form->checkbox('checkbox', 'checkbox', $initial, $attrs);
        // $this->form->range('range', 'range', $initial, $attrs);
        // $this->form->date('date', 'date', $initial, $required, $attrs);
        // $this->form->time('time', 'time', $initial, $required, $attrs);
        // $this->form->confirm('confirm', 'confirm', "Confirm Error Message", true);
        // $this->form->password('password', 'password', $initial, $required, $attrs);
        // $this->form->email('email', 'email', $initial, $required, $attrs);
        // $this->form->emailConfirm('emailconfirm', 'emailconfirm', 'emailconfirm2', $initial, $required, $attrs);
        // $this->form->url('url', 'url', $initial, $required, $attrs);
        // $this->form->number('number', 'number', $initial, $required, $attrs);
        // $this->form->tel('tel', 'tel', $initial, $required, $attrs);
        // $this->form->settings('settings', 'settings', $options, $attrs);
        // $this->form->file('file', 'file', false, $required, $attrs);
        // $this->form->multipleFile('multifile', 'multifile', false, $required, $attrs);
        $this->form->csrf();


        $this->form->submit($label_button);

        if ($this->form->submitted()) {
            // validate the input if you need to!
        }

        if ($this->form->success()) {
            var_dump($this->form->values);
            exit;

            $message = 'Name: '.$this->form->values['_name']."\n";
            $message .= 'Phone: '. $this->form->values['_phone']."\n";
            $message .= 'Email: '.$this->form->values['_email']."\n";
            $message .= 'Message: '.$this->form->values['_message']."\n" ;

            $to = 'developers@spindogs.com';
            $subject = 'Contact Form on ' . get_home_url();
            wp_mail($to, $subject, $message);
           

            //redirects to a page on the site, will need to be setup
            $redirect = get_home_url();
            wp_redirect($redirect);
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
