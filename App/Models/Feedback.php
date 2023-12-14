<?php

namespace App\Models;

class Feedback
{
    public $tituloFeedback, $descricaoFeedback, $tipoFeedback, $statusFeedback;
    public $idFeedback;
    static private $tabelaFeedback = 'Feedback';
    public $dbFeedback;

    public function __construct($id = NULL)
    {
        $this->dbFeedback = Conexao::get_instance();
        if ($id != NULL) {
            $this->lerFeedback($id);
        }
    }

    public function criarFeedback()
    {
        $Feedback = [
            'titulo' => $this->getTituloFeedback(),
            'descricao' => $this->getDescricaoFeedback(),
            'tipo' => $this->getTipoFeedback(),
            'status' => $this->getStatusFeedback()
        ];
        $this->dbFeedback->insert($this::$tabelaFeedback, $Feedback);
        $this->setIdFeedback($this->dbFeedback->get_lastInsertID());
    }


    public function atualizarFeedback()
    {
        $Feedback = [
            'titulo' => $this->getTituloFeedback(),
            'descricao' => $this->getDescricaoFeedback(),
            'tipo' => $this->getTipoFeedback(),
            'status' => $this->getStatusFeedback()
        ];
        $this->dbFeedback->update($this::$tabelaFeedback, $this->getIdFeedback(), $Feedback);
    }

    public function deletarFeedback()
    {
        $this->dbFeedback->delete($this::$tabelaFeedback, $this->getIdFeedback());
    }

    public function lerFeedback($id)
    {
        $this->setIdFeedback($id);
        $parametros = [
            'conditions' => ['id = ?'],
            'bind' => [$this->getIdFeedback()]
        ];
        $consulta = $this->dbFeedback->findFirst($this::$tabelaFeedback, $parametros);
        $this->setTituloFeedback($consulta->titulo);
        $this->setDescricaoFeedback($consulta->descricao);
        $this->setTipoFeedback($consulta->tipo);
        $this->setStatusFeedback($consulta->status);


    }

    public function getIdFeedback()
    {
        return $this->idFeedback;
    }

    public function setIdFeedback($idFeedback)
    {
        $this->idFeedback = $idFeedback;
    }

    public function getTituloFeedback()
    {
        return $this->tituloFeedback;
    }

    public function setTipoFeedback($tipoFeedback)
    {
        $this->tipoFeedback = $tipoFeedback;
    }

    public function getTipoFeedback()
    {
        return $this->tipoFeedback;
    }

    public function setTituloFeedback($tituloFeedback)
    {
        $this->tituloFeedback = $tituloFeedback;
    }

    public function getStatusFeedback()
    {
        return $this->statusFeedback;
    }

    public function setStatusFeedback($statusFeedback)
    {
        $this->statusFeedback = $statusFeedback;
    }

    public function getDescricaoFeedback()
    {
        return $this->descricaoFeedback;
    }

    public function setDescricaoFeedback($descricaoFeedback)
    {
        $this->descricaoFeedback = $descricaoFeedback;
    }


}
