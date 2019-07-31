<?php

    class Contatos {
        public $conexão;
        public $contato;
        public $contatos = array();
        public $mysqli;

        function __construct($novo_db)
        {
            $this->mysqli = $novo_db;
        }

        # busca de dados.

        function exibir_contatos($conexao) {

            $sqliBusca = 'SELECT * FROM contatos';
            $resultado = mysqli_query($conexao, $sqliBusca);
    
            $contatos = array();
    
            while ($contato = mysqli_fetch_assoc($resultado)) {
                $contatos[] = $contato;
            }
    
            return $contatos;
        }

        # Grava dados no banco.

        function gravar_contatos($conexao, $contato)
        {
            $nome = $this->mysqli->escape_string($contato['nome']);
            $telefone = $this->mysqli->escape_string($contato['telefone']);
            $email = $this->mysqli->escape_string($contato['email']);
            $descricao = $this->mysqli->escape_string($contato['descricao']);
            $nasc = $this->mysqli->escape_string($contato['nasc']);
            $favoritos = $this->mysqli->escape_string($contato['concluida']);

            $sqlGravar = "
            
            INSERT INTO contatos
                (nome, telefone, email, descricao, nasc, concluida)
            VALUES
                (
                    '{$nome}',
                    '{$telefone}',
                    '{$email}',
                    '{$descricao}',
                    '{$nasc}',
                    {$favoritos}
                )
            ";
            mysqli_query($conexao, $sqlGravar);
        }

        # mostrar a edição

        function exibir_contato($conexao, $id) {

            $sqlBusca = 'SELECT * FROM contatos WHERE id = ' . $id;

            $resultado = mysqli_query($conexao, $sqlBusca);

            return mysqli_fetch_assoc($resultado);
        }

        # Edita contato

        function editar_contato($conexao, $contato)
        {
            $sqlEditar = "
                UPDATE contatos SET
                    nome = 		'{$contato['nome']}',
                    telefone = 	'{$contato['telefone']}',
                    email = 	'{$contato['email']}',
                    descricao = '{$contato['descricao']}',
                    nasc = 		'{$contato['nasc']}',
                    concluida = '{$contato['concluida']}'
                WHERE id = {$contato['id']}
                ";
            mysqli_query($conexao, $sqlEditar);
        }


        function remover_tarefa($conexao, $id)
        {
            $sqlRemover = "DELETE FROM contatos WHERE id = {$id}";

            mysqli_query($conexao, $sqlRemover);
        }

        
        function exibir_favoritos($conexao)
        {
            $sqlConcluida = " SELECT * FROM contatos WHERE concluida *1";
            $resultado = mysqli_query($conexao, $sqlConcluida);

            $contatos = array();

            while ($contato = mysqli_fetch_assoc($resultado)) {
                $contatos[] = $contato;
            }

            return $contatos;
        } 


        function gravar_anexo($conexao, $anexo)
        {
            $sqlGravar = "
                INSERT INTO anexos
                (contato_id, nome, arquivo)
                VALUES
                (
                    {$anexo['contato_id']},
                    '{$anexo['nome']}',
                    '{$anexo['arquivo']}'
                )
            ";

            mysqli_query($conexao, $sqlGravar);
        }


        function buscar_anexos($conexao, $contato_id)
        {
            $sql = "SELECT * FROM anexos WHERE contato_id = {$contato_id}";
            $resultado = mysqli_query($conexao, $sql);

            $anexos = array();

            while ($anexo = mysqli_fetch_assoc($resultado)) {
                $anexos[] = $anexo;
            }

            return $anexos;
        }


        function remover_anexo($conexao, $id)
        {
            $sqlRemover = "DELETE FROM anexos WHERE id = {$id}";

            mysqli_query($conexao, $sqlRemover);
        }

    }

?>