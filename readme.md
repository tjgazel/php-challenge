# PHP Challenge

### Instalando o projeto
Clone o repositório ou baixe o arquivo zip.

```bash
git clone https://github.com/tjgazel/php-challenge.git
```
Acesse o diretório do projeto e use o composer para baixar as dependências do projeto.

```bash
composer update
```

<br>

### Configurando ambiente local.

O projeto foi feito com Laravel. Os arquivos `.env` e `.env.testing` já estão previamente configurados.

Use o Doker e o Docker-compose para subir os container previamentes configurados no arquivo `docker-compose.yml`

```bash
docker-compose up -d
```

Depois que o docker criar os containers você deve configurar no container do servico `db`, o usuário para o banco 
 `php_challenge`.

```bash
docker-compose exec db bash

// Ao conectar no container acesse o mysql com a senha root
mysql -uroot -p

GRANT ALL ON php_challenge.* TO 'laravel'@'%' IDENTIFIED BY 'root';
GRANT ALL ON php_challenge.* TO 'laravel'@'localhost' IDENTIFIED BY 'root';

flush privileges;

exit;
exit;
```

Rodar as migrações e seeders
```bash
docker-compose exec app php artisan migrate --seed
```

O container `webserver` irá mapear a porta 8080 para o serviço Web. `localhost:8080`.

<br>

### Rotas API

| Method   | URI                           | Descrição                                           |
| -------- | ----------------------------- | --------------------------------------------------- |
|   GET    | /api/pagamentos               | Retorna lista de todas as transações de pag.        |
|   GET    | /api/pagamentos/{transacaoId} | Retorna dados de uma transação.                     |
|   POST   | /api/pagamentos               | Cria uma nova transação. Parametros:                |
|          |                               | cliente_id, plano_id, status_transacao_id,          |
|          |                               | titular, numero_cartao, ccv, mes, ano               |
|   GET    | /api/pagamentos/retorno       | Recebe uma query com os parâmetros de atualização   |           |
|          |                               | de status da transação vindo da operadora de cartão:|           |
|          |                               | transacao_id, status                                |


<br>

### Cartão de Crédito teste

`1010 1010 1010 1010` - válido <br>
`2020 2020 2020 2020` - inválido <br>
`3030 3030 3030 3030` - randômico
