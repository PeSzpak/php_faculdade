# Exercício da noite: Cadastro de Produtos no Banco de Dados

Página em PHP que cadastra produtos numa tabela MySQL usando PDO.
A regra principal: **primeiro validar, depois gravar**. Nenhum dado inválido chega ao banco.

## Arquivos

| Arquivo | Para que serve |
|---|---|
| `banco.sql` | Cria o banco `loja` e a tabela `produtos` (id gerado pelo banco) |
| `conexao.php` | Cria a conexão PDO com o MySQL |
| `index.php` | Formulário, recebimento, validação e gravação com `INSERT` |

## Como rodar

```bash
mysql -u root -p < banco.sql        # cria o banco e a tabela (uma vez só)
php -S localhost:8000               # dentro desta pasta
```

Abra `http://localhost:8000` no navegador. Se o seu MySQL tiver senha,
ajuste `$senha` em `conexao.php` (ou rode com `DB_PASS=suasenha php -S localhost:8000`).

## Análise antes do código

**1. Quais dados chegam pelo formulário?**
Pelo `POST` chegam quatro textos: `nome`, `categoria`, `preco` e `quantidade`.
Tudo que vem do formulário chega como string, inclusive os números.

**2. Quais campos são obrigatórios?**
Todos os quatro. `nome` e `categoria` não podem ficar vazios; `preco` e
`quantidade` precisam ter um valor numérico válido.

**3. Quais valores precisam ser convertidos?**
- `preco`: string para número decimal. Antes troca a vírgula por ponto, para aceitar `250,00` e `250.00`.
- `quantidade`: string para número inteiro, com `filter_var(..., FILTER_VALIDATE_INT)`, que recusa `2.5` ou `abc`.
- `nome` e `categoria` passam por `trim()` para tirar espaços do começo e do fim.

**4. Quais regras são validadas antes da gravação?**
- nome não pode ficar vazio (depois do `trim`);
- categoria não pode ficar vazia (depois do `trim`);
- preço precisa ser numérico e maior que zero;
- quantidade precisa ser inteira e não pode ser negativa (zero é permitido).

Cada regra que falha adiciona uma mensagem ao array `$erros`, então o usuário
vê de uma vez todos os campos que estão errados.

**5. Quais dados continuam aparecendo no formulário em caso de erro?**
Todos os quatro campos voltam preenchidos com o que o usuário digitou
(`value="<?= h($nome) ?>"`). A função `h()` usa `htmlspecialchars` para que
um texto com `"` ou `<script>` não quebre a página. Depois de um cadastro
com sucesso o formulário é limpo para o próximo produto.

**6. Quais são os parâmetros nomeados do INSERT?**

```sql
INSERT INTO produtos (nome, categoria, preco, quantidade)
VALUES (:nome, :categoria, :preco, :quantidade)
```

Os valores entram com `bindValue()`, nunca concatenados dentro do SQL. O `id`
não aparece no `INSERT` porque o banco gera sozinho (`AUTO_INCREMENT`).

**7. Em qual momento o banco é acessado?**
Só depois da validação, e só se `$erros` estiver vazio. A conexão
(`conectar()`) é aberta dentro desse `if`, então um envio inválido nem chega
a conectar no banco.

## Fluxo

```
FORMULÁRIO → POST → RECEBER (trim) → TRATAR NÚMEROS → VALIDAR
                                                        │
                              ┌──── erros? ─────────────┤
                              ▼ sim                     ▼ não
                    MOSTRAR ERROS +            PREPARE → BIND → EXECUTE
                    manter valores                      │
                                                        ▼
                                          INSERT no banco → "Produto cadastrado com sucesso!"
```

## Testes feitos

| Entrada | Resultado |
|---|---|
| nome `"  "`, preço `0`, quantidade `-1` | 3 erros na tela, nada gravado, valores mantidos |
| categoria vazia, preço `abc`, quantidade `2.5` | 3 erros na tela, nada gravado |
| nome com `"><script>` | aparece escapado no campo, sem quebrar a página |
| `  Teclado Mecânico `, `Informática`, `250,00`, `10` | "Produto cadastrado com sucesso!" e registro gravado como `Teclado Mecânico / Informática / 250.00 / 10` |
