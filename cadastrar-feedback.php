<?php

require_once "vendor/autoload.php";

$compiler = new \App\Controllers\PageCompiler('cadastrar-feedback');
$feedback = new \App\Models\Feedback();

if(isset($_POST['btn-cadastrar'])){

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $status = $_POST['status'];
    $feedback->tituloFeedback = $titulo;
    $feedback->tipoFeedback = $descricao;
    $feedback->descricaoFeedback = $tipo;
    $feedback->statusFeedback = $status;
    $feedback->criarFeedback();
}