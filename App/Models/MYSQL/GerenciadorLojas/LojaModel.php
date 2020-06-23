<?php
// Para o psr4
namespace App\Models\MYSQL\GerenciadorLojas;

final class LojaModel{
    /**
    * @var int
    */
    private $id;
    /**
    * @var string
    */
    private $nome;
    /**
    * @var string
    */
    private $telefone;
    /**
    * @var string
    */
    private $endereco;

    //Criar os getters(retirar) e setters(redefinir)
    //Funções para retirar os valores deles e definir novos valores 
    /**
    * @return int
    */
    public function getId(): int{
        return $this->id;
    }

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