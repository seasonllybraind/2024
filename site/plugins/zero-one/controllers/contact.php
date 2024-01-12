<?php

return function ($kirby, $site, $pages, $page) {
    $alert = null;

    if ($kirby->request()->is('POST') && get('submit')) {
        // check the honeypot
        if (empty(get('contact_me_by_fax_only')) === false) {
            go($page->url());
            exit;
        }

        // Import fields data
        $data = [
            'name'  => get('name'),
            'email' => get('email'),
            'text'  => get('text')
        ];

        // Field rules
        $rules = [
            'name'  => ['required', 'min' => 3],
            'email' => ['required', 'email'],
            'text'  => ['required', 'min' => 3, 'max' => 3000],
        ];

        // Alert messages for the rules
        $messages = [
            'name'  => esc($site->labelAlertName()->or('Please enter a valid name')),
            'email' => esc($site->labelAlertEmail()->or('Please enter a valid email address')),
            'text'  => esc($site->labelAlertMessage()->or('Please enter a text between 3 and 3000 characters'))
        ];

        // some of the data is invalid
        if ($invalid = invalid($data, $rules, $messages)) {
            $alert = $invalid;

        // the data is fine, let's send the email
        } else {
            try {
                $kirby->email([
                    'template' => 'email',
                    'from'     => esc($site->email()),
                    'replyTo'  => $data['email'],
                    'to'       => esc($site->email()),
                    'subject'  => esc($data['name']) . ' ' . esc($site->labelEmailSubject()->or('sent you a message from your contact form')),
                    'data'     => [
                        'text'   => esc($data['text']),
                        'sender' => esc($data['name'])
                    ]
                ]);
            } catch (Exception $error) {
                $alert['error'] = esc($site->labelFormError()->or('The form could not be sent'));
            }

            // no exception occured, let's send a success message
            if (empty($alert) === true) {
                $success = esc($site->labelFormSuccess()->or('Your message has been sent, thank you. We will get back to you soon!'));
                $data = [];
            }
        }
    }

    return [
        'alert'   => $alert,
        'data'    => $data ?? false,
        'success' => $success ?? false
    ];
};
