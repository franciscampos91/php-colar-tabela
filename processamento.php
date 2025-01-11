<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = $_POST['dados'];

    $linhas = explode(PHP_EOL, $dados);
    $resultado = [];

    foreach ($linhas as $linha) {
        $linha = trim($linha);

        if (empty($linha)) {
            continue;
        }

        $colunas = explode("\t", $linha);

        // Verifica e corrige o nome para evitar repetição do último sobrenome
        $nomeCorrigido = corrigirNome($colunas[0] ?? '');

        // Garante que todas as colunas estejam definidas ou preenche com valores padrão
        $resultado[] = [
            'nome'        => $nomeCorrigido,
            'video'       => $colunas[1] ?? '',
            'data_video'  => $colunas[2] ?? '',
            'enquete'     => $colunas[3] ?? '',
            'data_enquete'=> $colunas[4] ?? '',
        ];
    }

    echo '<pre>';
    print_r($resultado);
    echo '</pre>';
} else {
    echo "Método de requisição inválido.";
}

/**
 * Corrige nomes com último sobrenome duplicado (sem diferenciar maiúsculas/minúsculas).
 *
 * @param string $nome O nome a ser corrigido.
 * @return string O nome corrigido.
 */
function corrigirNome(string $nome): string
{
    $partes = explode(' ', $nome);
    $totalPartes = count($partes);

    if ($totalPartes > 1 && strtolower($partes[$totalPartes - 1]) === strtolower($partes[$totalPartes - 2])) {
        // Remove o último nome duplicado
        array_pop($partes);
    }

    return implode(' ', $partes);
}