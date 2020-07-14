<?php

// Para o psr4
namespace App\Models\MYSQL\GerenciadorLojas;

final class ProdutoModel{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $loja_id;
    /**
     * @var string
     */
    public $nome;
    /**
     * @var float
     */
    public $preco;
    /**
     * @var int
     */
    public $quantidade;

    //Função contrusct;
    public function __construct($id, Loja $loja_id, $nome, $telefone, $endereco){
        $this->id=$id;
        $this->loja_id=$loja_id;
        $this->nome=$nome;
        $this->preco=$preco;
        $this->quantidade=$quantidade;
    }

    /**
     * @return int
     */

    public function getId(): int{
        return $this->id;
    }
    /**
     * @param int $id
     * @return ProdutoModel
     */
    public function setId(int $id): ProdutoModel{
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */

    public function getLojaId(): int{
        return $this->loja_id;
    }
    /**
     * @param int $id
     * @return ProdutoModel
     */
    public function setLojaId(int $loja_id): ProdutoModel{
        $this->loja_id = $loja_id;
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
    * @return ProdutoModel
    */
    public function setNome(string $nome): ProdutoModel{
        $this->nome = $nome;
        return $this;// retornar ele mesmo
    }

    
    /**
     * @return float
     */

    public function getPreco(): float{
        return $this->preco;
    }
    /**
     * @param float $preco
     * @return ProdutoModel
     */
    public function setPreco(float $preco): ProdutoModel{
        $this->preco = $preco;
        return $this;
    }

     /**
     * @return int
     */

    public function getQuantidade(): int{
        return $this->quantidade;
    }
    /**
     * @param int $quantidade
     * @return ProdutoModel
     */
    public function setQuantidade(int $quantidade): ProdutoModel{
        $this->quantidade = $quantidade;
        return $this;
    }
}