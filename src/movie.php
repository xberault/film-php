<?php

class Movie{
    private $name;
    private $date;
    private $author;
    private $gender;
    private $desc;

    public function __construct($name, $date, $author, $gender,$desc="", $img=""){
        $this->name = $name;
        $this->date = $date;
        $this->author = $author;
        $this->gender = $gender;
        $this->desc = $desc;
    }

    public function render(){
        echo <<<EOT
        <li class="list-inline-item card" style="width:14rem;">
            <img class="card-img-top" src="https://c7.uihere.com/files/881/56/853/film-computer-icons-screenwriter-download-png-movie-icon.jpg" alt="Card image cap">
            <section class="card-body">
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