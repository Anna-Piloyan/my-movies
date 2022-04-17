<?php

declare(strict_types=1);

namespace App\Presenters;
use App\Presenters\Model\AllMoviesModel;
use Nette\Application\UI\Template;


use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $movies;
   
    public function __construct(AllMoviesModel $movies)
    {
        parent::__construct();
        $this->movies = $movies;   
    }
   
    public function renderDefault()
    {    
         $this->template->list = $this->isAjax()
             ? []
             : $this->movies->getAllMovies();
    } 
}
