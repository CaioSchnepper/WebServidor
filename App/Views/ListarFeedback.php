<?php

namespace App\Views;

class ListarFeedback
{
    public function __construct($dataArray)
    {
        echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Lista de feedbacks</title>
        <link rel='stylesheet' href='assets/bootstrap/css/bootstrap.min.css'>
        <link rel='stylesheet' href='assets/css/Features-Boxed.css'>
        <link rel='stylesheet' href='assets/css/styles.css'>
    </head>
</head>
<body style='background-color:rgb(238,244,247);'>
<div id='main' class='container-fluid'>
    <div>
        <a href='index.php'><button type='button' class='btn btn-secondary' style='margin:16px 0px;'>Inicio</button></a>
        <a href='cadastrar-feedback.php'><button type='button' class='btn btn-success' style='margin:16px 0px;'>Novo</button></a>
    </div>
    <div id='list' class='row'>
        <div class='table-responsive col-md-12'>
            <table class='table table-striped' cellspacing='0' cellpadding='0'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Opções</th>
                </tr>
                </thead>
        ";

        foreach ($dataArray as $data) {
            echo "

                <tr>
                    <tbody>
                    <td>$data->id</td>
                    <td>$data->titulo</td>
                    <td>$data->descricao</td>
                    <td>$data->tipo</td>
                    <td>$data->status</td>
                    <td>
                        <a href='feedback.php?id=$data->id'><button type='button' class='btn btn-primary'>Atualizar status</button></a>
                        <a href='remover-feedback.php?id=$data->id'><button type='button' class='btn btn-danger'>Excluir</button></a>
                    </td>
                </tr>
                </tbody>
            ";
        }

        echo "
        </table>
        </div>
    </div> <!-- /#list -->
</div>  <!-- /#main -->
<script src='assets/js/jquery.min.js'></script>
<script src='assets/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>
        ";
    }
}