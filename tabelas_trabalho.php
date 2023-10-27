<?php

function filmes_select (){
    global $conn;
    $sth = $conn ->prepare("SELECT CD_FILME, NM_GENERO FROM TB_GENERO_FILME");
    $sth->execute ();
    return $sth->fetchAll();
}
