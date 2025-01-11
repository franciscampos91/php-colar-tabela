<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do textarea
    $dados = $_POST['dados'];

    // Divide os dados em linhas
    $linhas = explode(PHP_EOL, $dados);

    // Processa cada linha
    $resultado = [];
    foreach ($linhas as $linha) {
        // Remove espaços em branco ao redor
        $linha = trim($linha);

        // Ignora linhas vazias
        if (empty($linha)) {
            continue;
        }

        // Divide a linha em colunas usando tabulação como delimitador
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

    // Exibe o array processado (para testes)
   /* echo '<pre>';
    print_r($resultado);
    echo '</pre>';*/

    foreach($resultado as $pessoa)
    {
        echo $pessoa['nome'] . '<br>';
    }

    // Agora você tem um array multidimensional com as linhas e colunas!
} else {
    echo "Método de requisição inválido.";
}


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