# STARTER THEME - Wordpress
Desenvolvido em Wordpress utilizando roots/sage

## Configurações - .ENV
Na raiz do repositório possui um arquivo chamado `.env.example`, onde possui todas informações importantes em variáveis globais do arquivo `wp-config.php`, agora copie e cole as informações do arquivo `.env.example` em outro arquivo chamado `.env`, também na raiz do projeto.

## Instalação de Dependências Globais
Siga as intruções antes começar a desenvolver no proejto:

### Linux
Passo 1 - instalar `docker-compose` em sua maquina local
```sh
sudo curl -L https://github.com/docker/compose/releases/download/1.29.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

Passo 2 - Ver logs do Yarn com browsersync
```sh
docker logs yarn -f
```

Passo 3 - Instalar composer em sua maquina local
```sh
sudo apt-get update
sudo apt-get install curl
sudo curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Windows
Passo 1 - Faça o donwload do Docker Desktop on Windows no site oficial: 
- [Docker Desktop](https://docs.docker.com/docker-for-windows/install/)

Passo 2 - Utilize um emulador de console no Windows para ter a melhor experiência possivel no desenvolvimento do projeto como alguns exemplos abaixo:
- [Cmder](https://cmder.net/)
- [Git bash](https://gitforwindows.org/)
- [Visual Studio Code](https://code.visualstudio.com/Download)

## Iniciando o PROJETO
Pronto, após ter instalado todas as dependências globais em sua maquina, ja podemos inicializar o projeto utilizando os seguintes passos:

#### Iniciando o projeto - Windows
Passo 1 - Na raiz do repositório, utilize o comando `docker-compose up -d` para criar os containers nas portas `:80` e `:3306` e também baixar o wordpress e os plugins do projeto.
```sh
docker-compose up -d
```
Passo 2 - Agora dentro do programa Docker Desktop você pode acompanhar o container `yarn` para ver as renderizações do Browsersync que foi iniciado com o comando `yarn start`.

#### Iniciando o projeto - Linux
Passo 1 - Na raiz do repositório, utilize o comando `docker-compose up` para criar os containers nas portas `:80` e `:3306` e também baixar o wordpress e os plugins do projeto.
```sh
sudo docker-compose up
```
Passo 2 - Agora você irá precisar aguardar ele rodar todos os comandos inseridos em `docker-compose.yml` para que o `yarn start` seja carregado por ultimo na fila e assim poder acompanhar todas as renderizações do Browsersync.

Aguarde no terminal pela resposta:
```sh
[Browsersync] Proxying: http://wordpress
[Browsersync] Access URLs:
 -----------------------------------
       Local: http://localhost:3000
    External: http://172.18.0.5:3000
 -----------------------------------
          UI: http://localhost:3001
 UI External: http://localhost:3001
 -----------------------------------
[Browsersync] Watching files...
```
## Acesso ao Wordpress
- Site: http://localhost/
- Site com hot reload: http://localhost:3000/
- Browsersync dashboard: http://localhost:3001/
- Ngrok dashboard: http://localhost:4040/
- Painel: http://localhost/wp-admin/
- - Login: admin
- - Senha: LWpass2021

## Fazer a instalação do banco de dados
para gerar a restauração do banco de dados utilize o comando a seguir para descompactar o .sql na raiz do repositório ja com o container db online
```sh
tar zxvf dump.tgz
cat dump.sql | docker exec -i db mysql -u root --password=root wp
```
espere alguns minutos para que o banco de dados seja restaurado.

## Fazer o backup do Banco de dados
Caso queira salvar o `banco de dados` no repositório como `dump.sql` utilize o comando a baixo na raiz do projeto que o backup irá ser atualizado: (se estiver utilizando windows, cuidado para não exportar no formato ASCII)
```sh
docker exec db mysqldump -u root --password=root wp > dump.sql
tar -cvzf dump.tgz dump.sql
```

## Fazer Instalação da pasta `uploads.tgz`
Para instalar as imagens de Backup, pois alguns projeto não utilizam nenhum storage para realizar o upload de imagens
```sh
docker cp ./uploads.tgz wordpress:/var/www/html/uploads.tgz
docker exec wordpress tar zxvf uploads.tgz
```

## Fazer Backup da pasta `uploads.tgz`
Para criar um Backup de imagens, pois alguns projeto não utilizam nenhum storage para realizar o upload de imagens
```sh
docker exec wordpress tar -cvzf uploads.tgz wp-content/uploads/
docker cp wordpress:/var/www/html/uploads.tgz ./uploads.tgz
```

## Criando blocos no `Gutenberg`
O bloco é criado tanto em back-end `/app/Blocks` quanto no front-end `/resources/view/blocks`

### `Back-end`
- Crie uma Classe do seu novo Bloco extendendo a Classe `Block`, para criar os campos
- Defina o nome do bloco dentro da sua classe utilizando a variável `protected $blockName`
- Crie os campos utilizando [wordplate/extended-acf](https://github.com/wordplate/extended-acf) dentro da função createFields(){ ... }

### `Front-end`
- Crie o arquivo de template `.blade.php`
- Insira os comentários de configuração do bloco, como no exemplo `article.blade.php`
- Os campos criados estarão disponíveis na variável `$block['data']` do seu template

## Bibliotecas utilizadas
- [PHP v7.4](https://getbootstrap.com/docs/4.5)
- [MariaDB v10.5.9](https://getbootstrap.com/docs/4.5)
- [Jquery v3.5.0](https://getbootstrap.com/docs/4.5)
- [Bootstrap v5.0.0](https://getbootstrap.com/docs/4.5)
- [vanilla-lazyload ^17.1.2](https://www.andreaverlicchi.eu/vanilla-lazyload)
- [Popper ^1.16.1](https://popper.js.org)
