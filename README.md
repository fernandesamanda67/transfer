<h1>Transfer</h1> 

### Tópicos 

:small_blue_diamond: [Descrição do projeto](#descrição-do-projeto)

:small_blue_diamond: [Tecnologia](#tecnologia)

:small_blue_diamond: [Como rodar a aplicação](#Como-rodar-a-aplicação)

:small_blue_diamond: [Como rodar os testes](#Como-rodar-os-testes)

:small_blue_diamond: [Documentação](#Documentação)

... 

## Descrição do projeto

API com simulação de transferência de dinheiro entre dois usuários.

## Tecnologia

Laravel 8.12.

## Como rodar a aplicação :arrow_forward:

- Duplicar o arquivo .env.example para .env e realizar as alterações do banco de dados.

- Executar os comandos
```
composer install
php artisan key:generate
php artisan migrate
```

## Como rodar os testes :arrow_forward:
```
vendor/bin/phpunit
```

## Documentação 
http://localhost:8000/api/documentation
