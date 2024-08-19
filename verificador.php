<?php
session_start();

if (!isset($_SESSION['verificacao'])) {
    $_SESSION['verificacao'] = [];
}

// Função para verificar se a cadeia pertence à linguagem a^(n-1) b^n e calcular o valor de N
function iniciarVerificacao($cadeia)
{
    // Inicializar a pilha, string de saída e variável para marcar a primeira ocorrência de 'b'
    $pilha = [];
    $saida = [];
    $primeiroB = true;
    $passo = 1;

    // Contar o número de 'a's e 'b's
    $numA = substr_count($cadeia, 'a');
    $numB = substr_count($cadeia, 'b');

    // Função para formatar o estado da pilha
    function estadoPilha($pilha)
    {
        return empty($pilha) ? "Vazia" : implode('', $pilha);
    }

    // Processar cada caractere da cadeia
    for ($i = 0; $i < strlen($cadeia); $i++) {
        $char = $cadeia[$i];

        if ($char === 'a') {
            // Empilhar 'a' na pilha
            array_push($pilha, 'X');
            $saida[] = "Passo $passo: Empilhando 'X' - <strong>Estado da pilha</strong>: " . estadoPilha($pilha);
            $passo++;
        } elseif ($char === 'b') {
            if ($primeiroB) {
                // Para a primeira ocorrência de 'b', não removemos nada da pilha
                $primeiroB = false;
                $saida[] = "Passo $passo: Primeiro 'b' encontrado<br>Nenhum 'X' é removido. <strong>Estado da pilha</strong>: " . estadoPilha($pilha);
                $passo++;
            } else {
                // Para ocorrências subsequentes de 'b', removemos 'X' da pilha
                if (!empty($pilha)) {
                    array_pop($pilha);
                    $saida[] = "Passo $passo: Desempilhando 'X' para 'b' - <strong>Estado da pilha</strong>: " . estadoPilha($pilha);
                    $passo++;
                } else {
                    $saida[] = "Passo $passo: Erro: pilha vazia ao tentar desempilhar para 'b'";
                    return $saida;
                }
            }
        } else {
            $saida[] = "Passo $passo: Erro: caractere inválido encontrado '$char'";
            return $saida;
        }
    }

    // Verificar a condição final da pilha
    if (!empty($pilha)) {
        $saida[] = "Passo $passo: Erro: A pilha não está vazia após o processamento. <strong>Estado final da pilha</strong>: " . estadoPilha($pilha);
        return $saida;
    }

    // Verificar se a cadeia está na linguagem e calcular N
    if ($numB === $numA + 1) {
        $N = $numB; // Porque o número de 'b's é igual a N
        $saida[] = "Passo $passo: A cadeia '$cadeia' pertence à linguagem \( a^{(n-1)} b^n \), com \( n > 0 \).";
        $passo++;
        $saida[] = "Passo $passo: O valor de \( N \) é $N.";
    } else {
        $saida[] = "Passo $passo: A cadeia '$cadeia' não pertence à linguagem \( a^{(n-1)} b^n \), com \( n > 0 \).";
    }

    return $saida;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["entrada"])) {

        $entrada = $_POST["entrada"];
        $_SESSION['verificacao'] = iniciarVerificacao($entrada);
        $_SESSION['indice'] = 0;
    } elseif (isset($_POST["proximo"])) {
        // Mostrar próximo passo
        if (isset($_SESSION['verificacao'][$_SESSION['indice']])) {
            $saida = $_SESSION['verificacao'][$_SESSION['indice']];
            $_SESSION['indice']++;
            echo $saida;
        } else {
            echo "Nenhum passo adicional.";
        }
    }
}
