# desafio_horizon


## Pré-requisitos

Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina.

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Como Iniciar

Siga os passos abaixo para configurar e iniciar o projeto localmente.

### 1. Subindo o ambiente Docker

Execute o seguinte comando para iniciar os contêineres Docker em segundo plano:

```
docker compose up -d
```

### 2. Acessando o container

```
docker compose exec app bash
```

### 3. Comandos importantes

```
composer install
```

```
php artisan migrate --seed
```

```
php artisan key:generate
```

### 4. Testando a aplicação

- [http://localhost:8989/](http://localhost:8989/)

