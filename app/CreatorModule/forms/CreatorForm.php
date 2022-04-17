<?php
namespace App\CreatorModule\Forms;

use Nette\Application\UI\Form;


class CreatorForm{
    
    public function createForm(){
        
        $form = new Form();
         $form->addText('creatorName', 'Name')->setRequired(true);
         $form->addText('surname', 'Surname')->setRequired(false);
         $form->addText('dateOfBirth', 'Date of birth (yyyy-mm-dd)')->setRequired(false);
         $form->addText('country', 'Country')->setRequired(false);
         $form->addSubmit('submit', 'Add Creator');
        return $form;
    }
}