Gestão de Cidadãos
==================

Aplicação web para cadastro, listagem e pesquisa de cidadãos com interface em HTML, JavaScript (DataTables) e backend PHP + MySQL, executada via Docker.

Pré-requisitos
--------------

- Docker instalado (https://docs.docker.com/get-docker/)
- Docker Compose instalado (https://docs.docker.com/compose/install/)

Estrutura do projeto
--------------------

- ``docker-compose.yml`` — Orquestração dos serviços PHP (Apache) e MySQL
- ``docker/php/Dockerfile`` — Imagem personalizada PHP + Apache com extensões necessárias
- ``/public`` — Diretório público servido pelo Apache
- Scripts PHP para cadastro, listagem, exclusão e pesquisa
- Frontend com modais e DataTables para interação

Como executar
-------------

1. Clone este repositório:

   .. code-block:: bash

      git clone <url-do-repositorio>
      cd projeto_cidadao

2. (Opcional) Ajuste variáveis de ambiente e credenciais no ``docker-compose.yml`` se necessário.

3. Inicie os containers:

   .. code-block:: bash

      docker-compose up -d --build

   Isto irá:

   - Construir a imagem PHP personalizada
   - Criar e iniciar os containers ``projeto_cidadao_app`` (PHP + Apache) e ``projeto_cidadao_db`` (MySQL 8.0)
   - Mapear a porta 8000 do host para a porta 80 do container web

4. Aguarde os containers iniciarem. Acompanhe logs com:

   .. code-block:: bash

      docker-compose logs -f

5. Acesse no navegador:

   http://localhost:8000

Banco de dados
--------------

- Banco criado automaticamente: ``projeto_cidadao_db``
- Usuário: ``user``
- Senha: ``secret``
- Root password: ``root``
- Porta: 3306

Importante
----------

- Código fonte está mapeado via volume para ``/var/www/html`` dentro do container PHP, permitindo atualização instantânea.
- Diretório público para Apache: ``/var/www/html/public``
- Garanta que arquivos PHP e públicos estejam dentro de ``/public``.

Comandos úteis
--------------

- Parar containers:

  .. code-block:: bash

     docker-compose down

- Ver logs do container PHP:

  .. code-block:: bash

     docker logs -f projeto_cidadao_app

- Acessar container PHP para depuração:

  .. code-block:: bash

     docker exec -it projeto_cidadao_app bash

Endpoints PHP usados
--------------------

- ``cadastrar.php`` — Recebe POST com nome, retorna JSON com sucesso e NIS gerado
- ``listar.php`` — Retorna JSON com lista de cidadãos para DataTables
- ``pesquisar.php`` — Recebe POST com NIS, retorna JSON com dados do cidadão

---
