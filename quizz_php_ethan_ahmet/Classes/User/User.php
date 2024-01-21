<?php
namespace User;

/**
 * Class User
 * @package User
 */
class User
{
    private string $pseudo;

    private string $mdp;

    public function __construct(string $pseudo, string $mdp) {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getMdp(){
        return $this->mdp;
    }

}
?>