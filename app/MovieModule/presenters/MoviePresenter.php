<?php

namespace App\MovieModule\presenters;

use Nette;
use App\MovieModule\Forms\MovieForm;
use App\MovieModule\Model\MovieModel;
use App\MovieModule\Model\Movie\Movie;
use Nette\Application\UI\Form;
use Tracy\OutputDebugger;
use Nette\Application\UI\Template;

class MoviePresenter extends Nette\Application\UI\Presenter
{
    private $movieFactory;
    private $movieModel;

    public function __construct(MovieModel $movieModel, MovieForm $movieFactory)
    {
        parent::__construct();
        $this->movieModel = $movieModel;
        $this->movieFactory = $movieFactory;
    }
    public function createComponentAddForm(): Form
    {
        $f = $this->movieFactory->createForm();
        $f->onSuccess[] = [$this, 'formSucceedAdd'];
        return $f;
    }
    public function formSucceedAdd(Form $form, array $value)
    {
         OutputDebugger::enable();
        $movie = Movie::createFromInput($value);
        $result = $this->movieModel->insert($value);
        $this->redirect(':Movie');
    }
    public function actionDelete(int $id): void
    {
        OutputDebugger::enable();
        $result = $this->movieModel->delete($id);
        $this->redirect(':Movie');
    }
    public function actionUpdate(int $id, array $value): void
    {
         OutputDebugger::enable();
         $result = $this->movieModel->update($id, $value);
         $this->redirect(':Movie');
    }

    public function renderDefault()
    {    
         $this->template->list = $this->isAjax()
             ? []
             : $this->movieModel->getMovies();
    }
    public function startup()
    {
        parent::startup();
        $this->template->setFile(__DIR__ . '\templates\home.latte');
    }
}
