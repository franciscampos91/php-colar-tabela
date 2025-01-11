<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do textarea
    $dados = $_POST['dados'];

    // Divide os dados em um array, separando por quebras de linha
    $linhas = explode(PHP_EOL, $dados);

    // Remove possíveis espaços em branco no início/fim de cada linha
    $linhas = array_map('trim', $linhas);

    // Remove linhas vazias (se existirem)
    $linhas = array_filter($linhas);

    /*// Exibe o array processado (para testes)
    echo '<pre>';
    print_r($linhas);
    echo '</pre>';*/

    foreach($linhas as $nome)
    {
        echo $nome . '<br>';
    }

    // Aqui você pode continuar a processar os dados conforme sua necessidade
} else {
    echo "Método de requisição inválido.";
}
