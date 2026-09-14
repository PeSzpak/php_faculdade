# PHP Class

Repositório de estudos da disciplina de Programação (PHP), com aplicações
executadas pelo terminal. Reúne os exercícios de cada aula, os desafios da
noite e um glossário explicando as tags e os termos de TI usados no código.

## Como executar qualquer arquivo

```bash
php nome_do_arquivo.php
```

Os programas leem dados digitados pelo usuário com `readline()`, então
rode sempre pelo terminal (não pelo navegador).

## Módulos do curso e onde cada um está neste repositório

| Módulo | Conteúdo | Arquivo(s) |
|---|---|---|
| Aquecimento da noite — Senac Tour | Orçamento de viagem: entrada, processamento e saída organizados em funções | `orcamento_viagem.php` |
| Exercício 2 — AutoTech | Orçamento de serviço automotivo (mão de obra, peça, materiais, parcelamento em 3x) | `orcamento_autotech.php` (`AutoTech_Etapas_1_2.docx` é o enunciado com a interpretação das Etapas 1 e 2) |
| Exercício 3 — Missões da Noite (condicionais) | Estruturas condicionais, operadores relacionais e lógicos, validação de dados | `missao01_classificacao.php`, `missao02_situacao_academica.php`, `missao03_estacionamento.php`, `missao04_emprestimo.php`, `missao05_pedido_delivery.php` |
| Exercício 4 — Repetição | Contador, acumulador, condição de parada, `for` e `while` | `exercicio1_contagem.php`, `exercicio2_tabuada.php`, `exercicio3_soma.php`, `exercicio4_media.php`, `exercicio5_analise_turma.php` |
| Exercício 5 — Desafio da Noite (arrays, foreach, funções) | Arrays indexados e associativos, `foreach`, modularização em funções | pasta `ExercicioArraysForeach/` (10 missões, de lista de funcionários a mini sistema de vendas) |
| Desafio Final do 1º Bimestre — SENAC Market | Sistema de venda completo: cadastro de produtos, descontos cumulativos, parcelamento e relatório gerencial | `senac_market.php` (código) e `senac_market_documentacao.md` (interpretação do problema) |

Os arquivos `hello_world.php`, `cartao_apresentacao.php` e
`calculadora_media_notas.php` são exercícios introdutórios de aulas
anteriores a essa lista e não fazem parte de nenhum dos módulos acima.

## Glossário de tags, expressões e termos de TI

### Tags e estrutura do arquivo

- **`<?php ... ?>`** — delimitadores que dizem ao interpretador onde começa
  e onde termina o código PHP. Como estes arquivos são scripts inteiros em
  PHP, a tag de fechamento `?>` costuma ser omitida no final do arquivo.
- **`//` e `/* */`** — comentários de uma linha e de várias linhas. Não são
  executados; servem para explicar decisões que não são óbvias só de ler
  o código.
- **`;`** — fecha cada instrução. Esquecer o `;` é a causa mais comum de
  erro de sintaxe em PHP.

### Entrada e saída

- **`readline()`** — lê uma linha digitada pelo usuário no terminal e
  devolve como texto (string). Sem argumento, precisa de um `echo` antes
  para mostrar a pergunta; com argumento (`readline("Nome: ")`), ele
  mesmo exibe o texto antes de esperar a digitação.
- **`echo`** — imprime um valor no terminal.
- **`PHP_EOL`** — quebra de linha correta para o sistema operacional onde
  o script está rodando (`\n` no Linux/Mac, `\r\n` no Windows). Preferível
  a escrever `"\n"` na mão.
- **Interpolação de variáveis** — colocar uma variável direto dentro de
  uma string com aspas duplas (`"Nome: $nome"` ou `"Nome: {$nome}"`) em
  vez de concatenar com `.`.

### Tipos e conversão

- **`(int)`** — converte o valor para número inteiro, descartando qualquer
  parte decimal. Necessário porque `readline()` sempre devolve texto.
- **`(float)`** — converte o valor para número decimal (ponto flutuante).
- **`number_format($valor, $decimais, $separadorDecimal, $separadorMilhar)`**
  — formata um número para exibição. No Brasil, `number_format($valor, 2, ',', '.')`
  transforma `1234.5` em `"1.234,50"`.

### Operadores

- **Relacionais** — `==` (igual, compara só o valor), `===` (idêntico,
  compara valor **e** tipo), `!=`/`!==`, `<`, `>`, `<=`, `>=`. O curso pede
  `===` sempre que o valor comparado precisa ser exatamente aquele texto
  (por exemplo, verificar se a forma de pagamento é exatamente `"pix"`).
- **Lógicos** — `&&` (E: as duas condições precisam ser verdadeiras),
  `||` (OU: pelo menos uma precisa ser verdadeira), `!` (NÃO: inverte o
  valor lógico).
- **Ternário** — `condicao ? valorSeVerdadeiro : valorSeFalso`, um jeito
  curto de escrever um `if/else` que só define o valor de uma variável.

### Estruturas condicionais e de repetição

- **`if` / `elseif` / `else`** — executa um bloco de código só quando a
  condição é verdadeira. A ordem dos `elseif` importa: o primeiro que for
  verdadeiro "ganha", os de baixo nem são avaliados.
- **`for ($i = 1; $i <= $n; $i++)`** — repetição usada quando já se sabe
  quantas vezes o laço vai rodar (por exemplo, cadastrar exatamente 5
  produtos).
- **`while (condicao)`** — repetição usada quando não se sabe de antemão
  quantas vezes vai rodar; continua até a condição ficar falsa (ou até um
  `break`, como no cadastro de produtos do SENAC Market que só termina
  quando o atendente digita `ENCERRAR`).
- **Contador** — variável que aumenta a cada repetição (`$i++`), usada
  para saber "em qual repetição eu estou".
- **Acumulador** — variável que guarda a soma (ou outro total) conforme o
  laço avança (`$soma += $valor`), usada para chegar num total ou numa
  média ao final da repetição.

### Arrays e foreach

- **Array indexado** — lista de valores acessados por posição numérica:
  `$notas = [8, 6, 9]`, e `$notas[0]` é `8`.
- **Array associativo** — valores acessados por uma chave de texto em vez
  de posição: `$aluno = ["nome" => "Ana", "nota" => 8.5]`, e
  `$aluno["nome"]` é `"Ana"`.
- **Array multidimensional** — um array cujos valores também são arrays,
  como uma lista de produtos em que cada produto é um array associativo
  (`nome`, `preco`, `quantidade`).
- **`foreach ($array as $item)`** — percorre cada posição de um array sem
  precisar controlar um índice manualmente. Para arrays associativos,
  `foreach ($array as $chave => $valor)` dá acesso à chave e ao valor.
- **`count($array)`** — quantidade de itens em um array.

### Funções

- **Função** — um bloco de código nomeado que agrupa uma responsabilidade
  (ler dados, calcular um valor, exibir um relatório) para não repetir o
  mesmo código em vários lugares.
- **Parâmetro** — o valor que a função recebe entre parênteses na hora de
  ser chamada (`function calcularTotal($produtos)`, aqui `$produtos` é o
  parâmetro).
- **`return`** — devolve um valor para quem chamou a função, encerrando a
  execução da função naquele ponto.

### Geração automática de dados

- **`rand($min, $max)`** — gera um número inteiro aleatório entre `$min`
  e `$max`, usado para criar códigos de orçamento, pedido ou venda.
- **`date($formato)`** — devolve a data (e hora, se pedido no formato)
  atual do sistema. `date('d/m/Y')` devolve algo como `14/09/2026`;
  `date('d/m/Y H:i')` inclui também hora e minuto.
