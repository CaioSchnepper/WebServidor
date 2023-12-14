<?php

namespace App\Views;

class CadastrarFeedback
{
    public function __construct($origin)
    {
        echo "
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Cadastrar feedback</title>
    <link rel='stylesheet' href='assets/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/css/Features-Boxed.css'>
    <link rel='stylesheet' href='assets/css/styles.css'>
</head>

<body style='background-color:rgb(238,244,247);'>
    <div class='features-boxed'>
        <div class='container'>
            <div class='intro'>
                <h2 class='text-center'>Cadastrar feedbacks</h2>
                <form action='$origin' method='POST'>
                    <small>Titulo:</small>
                    <input class='form-control' type='text' name='titulo'>
                    <small>Descrição:</small>
                    <input class='form-control' type='text' name='descricao'>
                    <small>Tipo:</small>
                    <input class='form-control' type='text' name='tipo'>
                    <small>Status:</small>                    
                    <select class='form-control form-select' name='status'>
                        <option value='Recebido'>Recebido</option>
                        <option value='Analise'>Analise</option>
                        <option value='Desenvolvimento'>Desenvolvimento</option>
                        <option value='Finalizado'>Finalizado</option>
                    </select>

                    <button class='btn btn-primary w-100' type='submit' name='btn-cadastrar' style='margin:16px 0px;'>Salvar</button> 
                </form>
                <a href='index.php'><button class='btn btn-secondary w-100' style='margin:-16px 0px;'>Inicio</button></a> 
            </div>
        </div>
    </div>
    <script src='assets/js/jquery.min.js'></script>
    <script src='assets/bootstrap/js/bootstrap.min.js'></script>
</body>

</html>
        ";
    }
}