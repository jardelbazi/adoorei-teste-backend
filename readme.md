# API

Para iniciar o projeto, entrar na pasta Api.

## Pré requisitos
Você deve possuir as seguintes ferramentas instaladas/disponíveis em sua máquina **Host**:
- Docker

Desta forma toda a stack de desenvolvimento será executada via Docker, não sendo necessário instalar diretamente na máquina Host, ferramentas como o PHP, MySQL, Composer, etc.


#### Configuração do alias Sail

Para facilitar a utilização do **Sail**, vá para a pasta do seu usuário (na máquina **Host**) e edite o arquivo de configuração, seja ele Bash: **.bashrc** ou ZSH: **.zshrc**.

    cd ~
    vim .zshrc

Dentro do arquivo de configuração, crie um alias para o **sail**, adicionando o conteúdo abaixo no arquivo de configuração *(ao final do arquivo)*:

    alias sail='bash vendor/bin/sail'

### Instalação do Composer/Sail
Entrar na pasta **Api**

O **Sail** é instalado através do **Composer** e ambos são executados através de uma imagem **Docker**.

Acesse via terminal, a pasta do projeto e efetue a instalação das dependências utilizando o Docker, com o comando:

    docker run --rm \
      -u "$(id -u):$(id -g)" \
      -v "$(pwd):/var/www/html" \
      -w /var/www/html \
      laravelsail/php83-composer:latest \
      composer install --ignore-platform-reqs

Efetue a criação de um arquivo **.env** com base no **.env.example**

Efetue a criação da chave do Laravel, rodando o comando:

    sail artisan key:generate

Rodar as migrations + seeders

    sail artisan migrate
    sail artisan db:seed


Link da Documentação: https://documenter.getpostman.com/view/14324027/2sA2xcaaEc


