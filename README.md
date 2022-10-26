Antes de executar o programa é necessário instalar o gerenciador de depências composer e o compilador de PHP

Após instalado faça o clone do repositório para sua máquina local com o comando

´https://github.com/Henriquenascimento01/cinema-laravel.git´

Abra o terminal na pasta raiz do projeto e instale as depencências necessárias para utilização do programa com o comando

composer install

Depois copie o arquivo .env.example e crie um novo .env e gere a chave da aplicação executando os comandos

cp .env.example .env
php artisan key:generate

Crie um novo banco de dados e altere o arquivo .env gerado atualizando os seguintes campos

DB_DATABASE={Nome do banco criado}
DB_USERNAME={Úsuário para conexão com o banco}
DB_PASSWORD={Senha para conexão com o banco}

Crie as tabelas para a aplicação no banco criado com o comando

php artisan migrate

Inicie o servidor artisan do Laravel com o comando abaixo e já pode utilizar o sistema no endereço fornecido.

php artisan serve

Para poder utilizar o CRUD completo será necessário criar um novo login de admin diretamente no banco, pode inserir manualmente na interface ou utilizar o seguinte comando SQL

INSERT INTO users (name, email, password) VALUES ('nomeusuario','emailusuario', 'senha em hash')


Obs. para validar será necessário que a senha a ser inserida no banco esteja convertida em hash, para gerar uma chave pela aplicação, ao final da view homepage está comentado um HashMaker, você pode descomentar e incluir dentro da função make uma string com a senha desejada, e após salvar e atualizar a página inicial, no topo será exibido a senha em hash.