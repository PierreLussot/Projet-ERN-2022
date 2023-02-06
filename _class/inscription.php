<?php

class Inscription
{
    private $valid;
    private $err_pseudo;
    private $err_mail;
    private $err_password;



    public function verifivation_inscription($pseudo, $mail, $confmail, $password, $confpassword)
    {
        global $DB;
        // Variable d'entrées
        $pseudo = (string) ucfirst(trim($pseudo));
        $mail = (string) trim($mail);
        $confmail = (string) trim($confmail);
        $password = (string) trim($password);
        $confpassword = (string) trim($confpassword);

        // Variable declarés
        $this->err_pseudo = (string) '';
        $this->err_mail = (string) '';
        $this->err_password = (string) '';
        $this->valid = (bool) true;

        $this->verification_pseudo($pseudo);
        $this->verification_mail($mail, $confmail);
        $this->verification_password($password, $confpassword);

        //insertion bdd

        if ($this->valid) {

            $crypt_password = password_hash($password, PASSWORD_DEFAULT);
            echo $crypt_password;

            if (password_verify($password, $crypt_password)) {
                echo 'Le mot de passe est valide !';
            } else {
                echo ' invalide.';
            }
            $date_creation = date('Y-m-d H:i:s');
            $req = $DB->prepare('INSERT INTO utilisateur( pseudo, mail, mdp, date_creation, date_connexion) 
            VALUES (?, ?, ?, ?, ?)');
            $req->execute([$pseudo, $mail, $crypt_password, $date_creation, $date_creation]);

            header('Location: connexion.php');
            exit;
        }
        return [$this->err_pseudo, $this->err_mail, $this->err_password];
    }

    private function verification_pseudo($pseudo)
    {
        global $DB;
        if (empty($pseudo)) {
            $this->valid = false;
            $this->err_pseudo = "Le champ pseudo ne peut pas etre vide";
        } elseif (strlen($pseudo) < 4) {
            $this->valid = false;
            $this->err_pseudo = "Le pseudo doit faire plus de 4 caractére";
        } elseif (strlen($pseudo) >=  25) {
            $this->valid = false;
            $this->err_pseudo = "Le pseudo doit faire mois de 26 caractére (" . strlen($pseudo) . "/25)";
        } else {
            $req = $DB->prepare('SELECT id FROM utilisateur WHERE pseudo = ?');

            $req->execute([$pseudo]);

            $req = $req->fetch();
            if (isset($req['id'])) {
                $this->valid = false;
                $this->err_pseudo = 'Ce pseudo est déja pris';
            }
        }
        return true;
    }

    private function verification_mail($mail, $confmail)
    {
        global $DB;
        if (empty($mail)) {
            $this->valid = false;
            $this->err_mail = "Le champ email ne peut pas etre vide";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->valid = false;
            $this->err_mail = "Format invalide pour ce mail";

        } elseif ($mail !== $confmail) {
            $this->valid = false;
            $this->err_mail = "Le mail est différent de la confirmation";
        } else {
            $req = $DB->prepare('SELECT id FROM utilisateur WHERE mail = ?');

            $req->execute([$mail]);

            $req = $req->fetch();
            if (isset($req['id'])) {
                $this->valid = false;
                $this->err_mail = 'Ce mail est déja pris';
            }
        }
        return true;
    }

    private function verification_password($password, $confpassword)
    {
        global $DB;
        if (empty($password)) {
            $this->valid = false;
            $this->err_password = "Le champ mot de passe ne peut pas etre vide";
        } elseif ($password !== $confpassword) {
            $this->valid = false;
            $this->err_password = "Le mot de passe est différent de la confirmation";
        } else {
            $req = $DB->prepare('SELECT id FROM utilisateur WHERE mdp = ?');

            $req->execute([$password]);

            $req = $req->fetch();
            if (isset($req['id'])) {
                $this->valid = false;
                $this->err_password = 'Ce mot de passe est déja pris';
            }
        }
    }
}
