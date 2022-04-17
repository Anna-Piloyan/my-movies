<?php

namespace App\CreatorModule\presenters;

use Nette;
use App\CreatorModule\Forms\CreatorForm;
use App\CreatorModule\Model\CreatorModel;
use App\CreatorModule\Model\Creator\Creator;
use Nette\Application\UI\Form;
use Tracy\OutputDebugger;
use Nette\Application\UI\Template;

class CreatorPresenter extends Nette\Application\UI\Presenter
{
    private $creatorFactory;
    private $creatorModel;

    public function __construct(CreatorModel $creatorModel, CreatorForm $creatorFactory)
    {
        parent::__construct();
        $this->creatorModel = $creatorModel;
        $this->creatorFactory = $creatorFactory;
    }
    public function createComponentAddForm(): Form
    {
        $f = $this->creatorFactory->createForm();
        $f->onSuccess[] = [$this, 'formSucceedAdd'];
        return $f;
    }
    public function formSucceedAdd(Form $form, array $value)
    {
         OutputDebugger::enable();
        $creator = Creator::createFromInput($value);
        $result = $this->creatorModel->insert($value);
        $this->redirect(':Creator');
    }
    public function actionDelete(int $id): void
    {
        OutputDebugger::enable();
        $result = $this->creatorModel->delete($id);
        $this->redirect(':Creator');
    }
    public function actionUpdate(int $id, array $value): void
    {
         OutputDebugger::enable();
         $result = $this->creatorModel->update($id, $value);
         $this->redirect(':Creator');
    }

    public function renderDefault()
    {    
         $this->template->list = $this->isAjax()
             ? []
             : $this->creatorModel->getCreators();
    }
    public function startup()
    {
        parent::startup();
        $this->template->setFile(__DIR__ . '\templates\home.latte');
    }
}
