<?php

class Validacao
{

    public $validacoes;

    public static function validar($regras, $dados)
    {

        $validacao = new self;

        foreach ($regras as $campo => $regrasDoCampo) {

            foreach ($regrasDoCampo as $regra) {

                $valordoCampo = $dados[$campo];

                if ($regra == 'confirmed') {
                    $validacao->$regra($campo, $valordoCampo, $dados["{$campo}_confirm"]);
                } else if (str_contains($regra, ':')) {
                    $temp = explode(':', $regra);

                    $regra = $temp[0];
                    $regraAr = $temp[1];

                    $validacao->$regra($regraAr, $campo, $valordoCampo);
                } else {
                    $validacao->$regra($campo, $valordoCampo);
                }
            }
        }

        return $validacao;
    }

    private function required($campo, $valor)
    {
        if (strlen($valor) == 0) {
            $this->validacoes[] = "O $campo é obrigatório.";
        }
    }


    private function email($campo, $valor)
    {
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->validacoes[] = "O $campo é INVÁLIDO.";
        }
    }

    private function confirmed($campo, $valor, $valor_confirmacao)
    {
        if ($valor != $valor_confirmacao) {
            $this->validacoes[] = "O $campo de confirmação esta diferente";
        }
    }

    private function min($min, $campo, $valor)
    {
        if (strlen($valor) < $min) {
            $this->validacoes[] = "O campo $campo precisa ter no mínimo $min caracteres.";
        }
    }

    private function max($max, $campo, $valor)
    {
        if (strlen($valor) > $max) {
            $this->validacoes[] = "O campo $campo pode ter no máximo $max caracteres.";
        }
    }

    private function strong($campo, $valor)
    {
        // Verifica se a senha contém letras maiúsculas, minúsculas, números e caracteres especiais
        if (!preg_match('/[A-Z]/', $valor) || !preg_match('/[a-z]/', $valor) || !preg_match('/[0-9]/', $valor) || !preg_match('/[!@#$%¨&*()_]/', $valor)) {
            $this->validacoes[] = "O campo $campo precisa ter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.";
        }
    }

    private function unique($tabela, $campo, $valor)
    {
        if (strlen($valor) == 0) {
            return;
        }

        $db = new DB(config('database'));

        $resultado = $db->query(
            query: "select * from $tabela where $campo = :valor",
            params: ['valor' => $valor]
        )->fetch();

        // dd($resultado);

        if ($resultado) {
            $this->validacoes[] = "O campo $campo já esta sendo usado.";
        }
    }


    public function naoPassou($formLocation = '')
    {

        $validacao = 'validacoes';

        if ($formLocation) {
            $validacao .= "_" . $formLocation;
        }
        flash()->push($validacao, $this->validacoes);
        // $_SESSION['validacoes'] = $this->validacoes;
        return is_array($this->validacoes) && count($this->validacoes) > 0;
    }
}
