<?php

class Movie{
    private $id;
    private $name;
    private $date;
    private $author;
    private $gender;
    private $desc;

    public function __construct($id = 0, $name, $date, $author, $gender,$desc="", $img=""){
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->author = $author;
        $this->gender = $gender;
        $this->desc = $desc;
    }

    public function render(){
        echo <<<EOT
        <li id="{$this->id}" class="list-inline-item card" style="width:20rem;">
            <img class="card-img-top" src="https://c7.uihere.com/files/881/56/853/film-computer-icons-screenwriter-download-png-movie-icon.jpg" alt="Card image cap">
            <section class="card-body">
                <a class="btn float-right" href="src/delete.php?id={$this->id}" onclick="return confirm('Etes-vous sûr de vouloir le supprimer ?');">
                    <i class="far fa-trash-alt"></i>
                </a>    
                <a type="button" class="btn float-right" href="src/editForm.php?id={$this->id}" method="get" >
                    <i class="fas fa-edit"></i>
                </a>
                <h5 class="card-title" >{$this->name} </h5>
                <p class="card-text"> {$this->date}</p>
                <p class="card-text"> {$this->desc}</p>
            </section>
        </li>
        EOT;
    }

    public function getName(){
    return $this-> name;
    }
}


?>