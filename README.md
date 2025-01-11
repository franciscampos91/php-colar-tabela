# Processamento de Dados de Tabelas Copiadas do Excel para PHP

Este projeto permite processar dados copiados de uma tabela do Excel e colados em uma `textarea` HTML. Os dados são enviados via `POST` e processados no backend PHP, convertendo cada linha em um array associativo. O script também lida com nomes duplicados e múltiplas colunas.

## Funcionalidades

- Processamento de múltiplas colunas separadas por tabulação.
- Detecção e remoção de repetição do último sobrenome no campo "nome", ignorando diferenças de maiúsculas e minúsculas.
- Suporte para preenchimento automático de colunas ausentes.

## Pré-requisitos

- PHP >= 7.4
- Navegador para executar o frontend
- Servidor local (como XAMPP ou WAMP) para processar o PHP

## Como Usar

1. **Adicione o Formulário HTML**  
   Crie um arquivo `index.html` contendo o seguinte código. Este formulário permite ao usuário colar os dados copiados do Excel:

```html
<form action="processamento.php" method="post">
    <p>Cole a tabela abaixo:</p>
    <textarea name="dados" id="dados" rows="20" style="width:600px"></textarea>
    <button type="submit">Enviar</button>
</form>
```

2. **Crie o Arquivo PHP para Processar os Dados**
Crie o arquivo `processamento.php` e insira o código abaixo. Ele processa os dados recebidos, convertendo cada linha em um array associativo e corrigindo repetições no campo "nome":

```php
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
```

3. **Cole os Dados no Formulário**
Copie as linhas e colunas de sua tabela no Excel e cole na textarea. Certifique-se de que as colunas estão separadas por tabulação.

Envie o Formulário
Clique no botão "Enviar" para processar os dados. A saída será exibida no formato de um array associativo.

Exemplo de Entrada e Saída

Entrada no Formulário:
```
João Silva Silva	Video1	2025-01-01	Enquete1	2025-01-02
Maria Oliveira Lima Lima	Video2	2025-01-03
Carlos Eduardo
```

Saída no Navegador:

```
Array
(
    [0] => Array
        (
            [nome] => João Silva
            [video] => Video1
            [data_video] => 2025-01-01
            [enquete] => Enquete1
            [data_enquete] => 2025-01-02
        )

    [1] => Array
        (
            [nome] => Maria Oliveira Lima
            [video] => Video2
            [data_video] => 2025-01-03
            [enquete] => 
            [data_enquete] => 
        )

    [2] => Array
        (
            [nome] => Carlos Eduardo
            [video] => 
            [data_video] => 
            [enquete] => 
            [data_enquete] => 
        )
)
```

## Contribuições

Se você encontrar algum problema ou quiser sugerir melhorias, fique à vontade para abrir um issue ou enviar um pull request no [GitHub](https://github.com/franciscampos91).



🚀 **Desenvolvido por [Francis Campos](https://github.com/franciscampos91)** 🚀  
🔧 *Melhorando cada linha de código com paixão e dedicação!* 💻

