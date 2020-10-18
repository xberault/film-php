<?php

class Person{
    private $id;
    private $nom;
    private $prenom;
    private $sexe;
    private $dateNais;
    private $bio;

    public function __construct($id, $nom, $prenom, $sexe, $dateNais,$bio,$role){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->dateNais = $dateNais;
        $this->bio = $bio;
        $this->role = $role;
    }

    public function render(){   // fix heredox iut bug
        echo <<<EOF
        <li id="{$this->id}" class="column card m-2" style="width:17rem;">
            <section class="card-body">
                <a class="btn float-right" href="src/delete.php?id={$this->id}" onclick="return confirm('Etes-vous sûr de vouloir le supprimer ?');">
                    <i class="far fa-trash-alt"></i>
                </a>
                <a type="button" class="btn float-right" href="src/editForm.php?id={$this->id}" method="get" >
                    <i class="fas fa-edit"></i>
                </a>
                <h5 class="card-title" ><b>{$this->nom} {$this->prenom}</b> </h5>
                <p class="card-text">was born on {$this->dateNais}</p>
                <p class="card-text"> {$this->bio}</p>
        EOF;
                if($this->role == 'producer'){
                    echo <<<EOF
                    <a type="button" class="btn float-right" href="../pagesweb/filmby.php?id={$this->id}" method="get" >
                        <i class="fas fa-edit"></i>
                    </a>
                    EOF;
                }
                else{
                    echo <<<EOF
                    <a type="button" class="btn float-right" href="../pagesweb/filmwith.php?id={$this->id}" method="get" >
                        <i class="fas fa-edit"></i>
                    </a>
                    EOF;
                }

                echo <<<EOF
            </section>
        </li>
EOF;
    }

    // public function getTitle()
    // {
    //     return $this-> title;
    // }

    // /**
    //  * @return int
    //  */
    // public function getDate()
    // {
    //     return $this->date;
    // }

    // /**
    //  * @return mixed
    //  */
    // public function getAuthor()
    // {
    //     return $this->author;
    // }

    // /**
    //  * @return mixed
    //  */
    // public function getGender()
    // {
    //     return $this->gender;
    // }

    // /**
    //  * @return string
    //  */
    // public function getDesc()
    // {
    //     return $this->desc;
    // }

    // /**
    //  * @return int
    //  */
    // public function getId()
    // {
    //     return $this->id;
    // }
}
?>