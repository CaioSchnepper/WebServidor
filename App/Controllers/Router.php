<?php

namespace App\Controllers;

use App\Models\Conexao;
use App\Models\Feedback;
use App\Views\CadastrarFeedback;
use App\Views\ListarFeedback;
use App\Views\Main;

class Router
{
    public $page;

    public function __construct($page = NULL, $id = NULL)
    {
        switch ($page) {
            case 'cadastrar-feedback':
                $this->$page = new CadastrarFeedback($_SERVER['PHP_SELF']);
                break;
            case 'lista-feedback':
                $db = Conexao::get_instance();
                $data = $db->find('feedback');
                $this->$page = new ListarFeedback($data);
                break;
            case 'feedback':
                $feedback = new Feedback($id);
                $this->page = new \App\Views\Feedback($_SERVER['PHP_SELF'], $feedback);
                break;
            default:
                $this->$page = new Main();
                break;
        }
    }
}