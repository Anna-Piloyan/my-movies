<?php

namespace App\UserModule\Forms;

use Nette\Application\UI\Form;

class FormFactory
{
    public function createForm()
    {
        $form = new Form();
        $form->addText('name', 'Username')->setRequired(true);
        $form->addEmail('email', 'Email')->setRequired(false);
        $form->addPassword('password', 'Password:')
            ->setRequired(true)
            ->addRule($form::MIN_LENGTH, 'Password has to be at least %d characters long', 4)
            ->addRule($form::PATTERN, 'Password must contain a number', '.*[0-9].*');
        $form->addSubmit('submit', 'Register')->setHtmlAttribute("class", "btn-success");
        return $form;
    }
}
