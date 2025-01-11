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

        // Adiciona ao resultado
        $resultado[] = $colunas;
    }

    // Exibe o array processado (para testes)
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';

    // Agora você tem um array multidimensional com as linhas e colunas!
} else {
    echo "Método de requisição inválido.";
}
