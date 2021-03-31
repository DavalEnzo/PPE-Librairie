<?php
function insertEcrit(){
            $requete=getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES ((SELECT max(idAuteur) FROM auteurs),(SELECT max(idLivre) FROM bibliotheque))");
            $requete->execute();
            }