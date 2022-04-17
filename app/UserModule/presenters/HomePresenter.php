<?php

namespace App\UserModule\presenters;

use Nette;
use App\UserModule\Forms\FormFactory;
use App\UserModule\Model\UserModel;
use App\UserModule\Model\User\User;
use Nette\Application\UI\Form;
use Tracy\OutputDebugger;
use Nette\Application\UI\ITemplate;
use Nette\Utils\Html;

class HomePresenter extends Nette\Application\UI\Presenter
{
    private $factory;
    private $userModel;

    public function __construct(UserModel $userModel, FormFactory $factory)
    {
        parent::__construct();
        $this->userModel = $userModel;
        $this->factory = $factory;
    }
    public function createComponentAddForm(): Form
    {
       
        $f = $this->factory->createForm();
        $f->onSuccess[] = [$this, 'formSucceedAdd'];
        return $f;
    }
    public function formSucceedAdd(array $value)
    {
       
        OutputDebugger::enable();
        $user = User::createFromInput($value);
        $result = $this->userModel->register($value);
      
        $this->flashMessage('You are register!!!', 'success');
       
        $this->redirect(':Home');
    }
    public function renderDefault()
    {  
        $this->template->lists = $this->isAjax()
				? []
				: $this->userModel->getUsers();
               
    }
    public function startup()
    {
        parent::startup();
        $this->template->setFile(__DIR__ . '\templates\home.latte');
    }
}
