<?php

namespace App\MovieModule\Forms;

use Nette\Application\UI\Form;

class MovieForm
{

    public function createForm()
    {
        $form = new Form();
        $form->setHtmlAttribute("enctype", "multipart/form-data");
        $form->addText('name', 'Movie name')->setRequired(true);
        //$form->addText('image', 'Image')->setRequired(true);

        /* trouble with adding image which I couldn't solve 
               SQL translate error: Unexpected Nette\Http\FileUpload
        
        */
        $form->addUpload('image', 'Image:')->setRequired(false)
            ->addRule($form::IMAGE, 'Avatar must be JPEG, PNG, GIF or WebP')
            ->addRule($form::MAX_FILE_SIZE, 'Maximum size is 1 MB', 1024 * 1024);
        $form->addText('year', 'Year')->setRequired(true);
        $form->addText('length', 'Length')->setRequired(false);
        $form->addText('genre', 'Genre')->setRequired(true);
        $form->addText('creators_id', 'Creators')->setRequired(false);
        $form->addSubmit('submit', 'Add movie');
        return $form;
    }
}
