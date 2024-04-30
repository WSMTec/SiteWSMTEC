<?php

/**
 * AdminServico.class [ MODEL ADMIN ]
 * Responável por gerenciar as servicos no admin do sistema!
 * 
 * @copyright (c) Jefferson Androcles
 */
class AdminServicos {

    private $Data;
    private $Servico;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'tb_servicos';

    /**
     * <b>Cadastrar a Servico:</b> Envelope os dados da servico em um array atribuitivo e execute esse método
     * para cadastrar a mesma no banco.
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        $this->setData();
        $this->checkData();
        if ($this->Result):
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar a Servico:</b> Envelope os dados em uma array atribuitivo e informe o id de uma servico
     * para atualiza-la no banco de dados!
     * @param INT $ServicoId = Id da Servico
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($ServicoId, array $Data) {
        $this->Servico = (int) $ServicoId;
        $this->Data = $Data;

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Deleta Servicos:</b> Informe o ID da servico a ser removida para que esse método realize uma
     * checagem excluinto todos os dados nessesários e removendo a servico do banco!
     * @param INT $ServicoId = Id da servico!
     */
    public function ExeDelete($ServicoId) {
        $this->Servico = (int) $ServicoId;

        $Read = new Read;
        $Read->ExeRead(self::Entity, "WHERE IdServico = :s", "s={$this->Servico}");
        if (!$Read->getResult()):
            $this->Error = ["A serviço que você tentou deletar não existe!", 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE IdServico = :s", "s={$this->Servico}");

            $this->Error = ["O servico foi removido com sucesso do sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    /**
     * <b>Verificar Ação:</b> Retorna TRUE se ação for efetuada ou FALSE se não. Para verificar erros
     * execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um erro e um tipo.
     * @return ARRAY $Error = Array associativo com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Valida e cria os dados para realizar o cadastro. Realiza Upload da Capa!
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", 'blue', 'lnr lnr-warning', 5000];
            $this->Result = false;
        else:
            $this->setName();
        endif;
    }

    //Verifica o NAME da servico. Se existir adiciona um pós-fix +1
    private function setName() {
        $Where = (isset($this->Servico) ? "AND IdServico != {$this->Servico}" : "");
        $ReadName = new Read;
        $ReadName->ExeRead(self::Entity, "WHERE (NomeServico = :t OR CodServico = :c) {$Where}", "t={$this->Data['NomeServico']}&c={$this->Data['CodServico']}");
        if ($ReadName->getResult()):
            $this->Error = ['Oppsss, esse serviço já está cadastrado no sistema!', 'red', 'lnr lnr-warning', 4000];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Cadastra a servico no banco!
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Error = ["Serviço <b>{$this->Data['NomeServico']}</b> cadastrado com sucesso no sistema!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

    //Atualiza a servico no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE IdServico = :id", "id={$this->Servico}");
        if ($Update->getResult()):
            $this->Error = ["O Serviço <b>{$this->Data['NomeServico']}</b> foi atualizado com sucesso!", 'green', 'lnr lnr-smile', 4000];
            $this->Result = true;
        endif;
    }

}
