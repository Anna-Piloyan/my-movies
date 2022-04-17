<?php

namespace App\MovieModule\Model\Movie;

use Nette\Http\FileUpload;

class Movie
{
    public $id;
    public $name;
    public $image;
    public $year;
    public $length;
    public $genre;
    public $creators_id;
    public function __construct()
    {
    }
   
    // creating object from input
    public static function createFromInput(array $value): Movie
    {
        $image = NULL;
        $m = new Movie();
        $m->name = $value['name'];
        // $m->image = $value['image'];

        // adding file to folder

        if (isset($_FILES['image']['name']))
            $m->image = $_FILES['image']['name'];
        else
           $m->image = $image;

        if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
             move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/images/{$m->image}");
        }
        $m->year = $value['year'];
        $m->length = $value['length'];
        $m->genre = $value['genre'];
        $m->creators_id = $value['creators_id'];
        return $m;
    }
}
