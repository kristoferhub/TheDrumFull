<?php
// Para o psr4
namespace App\Models\MYSQL\GerenciadorLojas;

final class LojaModel{
    /**
    * @var int
    */
    public $id;
    /**
    * @var string
    */
    public $nome;
    /**
    * @var string
    */
    public $telefone;
    /**
    * @var string
    */
    public $endereco;

    //Função contrusct;
    public function __construct($id, $nome, $telefone, $endereco){
        $this->id=$id;
        $this->nome=$nome;
        $this->telefone=$telefone;
        $this->endereco=$endereco;
    }
    
    //Criar os getters(retirar) e setters(redefinir)
    //Funções para retirar os valores deles e definir novos valores 
    /**
    * @return int
    */
    public function getId(): int{
        return $this->id;
    }
    //Setter ID
    /**
     * @param int $id
     * @return LojaModel
     */
    public function setId(int $id): LojaModel{
        $this->id = $id;
        return $this;
    }

    /**
    * @return string
    */
    public function getNome(): string{
        return $this->nome;
    }

    /**
    * @param string $nome
    * @return LojaModel
    */
    public function setNome(string $nome): LojaModel{
        $this->nome = $nome;
        return $this;// retornar ele mesmo
    }

    /**
    * @return string
    */
    public function getTelefone(): string{
        return $this->telefone;
    }
    /**
    * @param string $telefone
    * @return LojaModel
    */
    public function setTelefone(string $telefone): LojaModel{
        $this->telefone = $telefone;
        return $this;// retornar ele mesmo, pois se a gente retorna ele mesmo, da pra acessar os metodos dele denovo.
    }
    /**
    * @return string
    */
    public function getEndereco(): string{
        return $this->endereco;
    }
    /**
    * @param string $endereco
    * @return LojaModel
    */
    public function setEndereco(string $endereco): LojaModel{
        $this->endereco = $endereco;
        return $this;// retornar ele mesmo, pois
    }
    
}