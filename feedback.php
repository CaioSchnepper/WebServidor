<?php
require_once "vendor/autoload.php";
$feedback = new \App\Models\Feedback();
if(isset($_POST['btn-cadastrar'])){
    $feedback->lerFeedback($_POST['id']);
    $feedback->setTipoFeedback($_POST['tipo']);
    $feedback->setDescricaoFeedback($_POST['descricao']);
    $feedback->setTituloFeedback($_POST['titulo']);
    $feedback->setStatusFeedback($_POST['status']);
    $feedback->atualizarFeedback();
}
if(isset($_GET['id'])){
    $page = new \App\Controllers\PageCompiler('feedback',$_GET['id']);
} elseif (isset($_POST['id'])){
    $page = new \App\Controllers\PageCompiler('feedback',$_POST['id']);
}
