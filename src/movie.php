<?php

class Movie{
    private $id;
    private $title;
    private $date;
    private $author;
    private $gender;
    private $desc;
    private $img;

    public function __construct($id, $title, $date, $author, $gender,$desc="", $img="https://c7.uihere.com/files/881/56/853/film-computer-icons-screenwriter-download-png-movie-icon.jpg"){
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->author = $author;
        $this->gender = $gender;
        $this->desc = $desc;
        $this->img = $img;
    }

    public function render(){   // fix heredox iut bug
        echo <<<EOF
        <li id="{$this->id}" class="column card m-2" style="width:17rem;">
            <img class="card-img-top" src="{$this->img}" alt="Card image cap">
            <section class="card-body">
                <a class="btn float-right" href="src/delete.php?id={$this->id}" onclick="return confirm('Etes-vous sûr de vouloir le supprimer ?');">
                    <i class="far fa-trash-alt"></i>
                </a>
                <a type="button" class="btn float-right" href="src/editForm.php?id={$this->id}" method="get" >
                    <i class="fas fa-edit"></i>
                </a>
                <h5 class="card-title" ><b>{$this->title}</b> </h5>
                <p class="card-text">by <em>{$this->author}</em> published in {$this->date}</p>
                <p class="card-text"> {$this->gender}</p>
                <p class="card-text"> {$this->desc}</p>
            </section>
        </li>
EOF;
    }

    public function getTitle()
    {
        return $this-> title;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
?>