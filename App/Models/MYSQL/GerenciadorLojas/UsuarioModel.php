<?php

// Para o psr4
namespace App\Models\MYSQL\GerenciadorLojas;
//Atributos que estão no banco de dados

//Criar os getters(retirar) e setters(redefinir)
//Funções para retirar os valores deles e definir novos valores 
final class UsuarioModel{
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
    private $email;
    
    /**
     * @var string
     */
    private $senha;

    //GET E SETTERS ID
    /**
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }
    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    //GETTER E SETTERS NOME
    /**
     * @return string
     */
    public function getNome(): string{
        return $this->nome;
    }
    /**
     * @param string $nome
     * @return self
     */
    public function setNome(string $nome): self{
        $this->nome = $nome;
        return $this;
    }
    
    //GETTER E SETTERS EMAIL
    /**
     * @return string
     */
    public function getEmail(): string{
        return $this->email;
    }
    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self{
        $this->email = $email;
        return $this;
    }
    //GETTER E SETTERS SENHA
    /**
     * @return string
     */
    public function getSenha(): string{
        return $this->senha;
    }
    /**
     * @param string $senha
     * @return self
     */
    public function setSenha(string $senha): self{
        $this->senha = $senha;
        return $this;
    }
}



