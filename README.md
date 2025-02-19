# Quiz-Capitais

## Descrição

O **Countries & Capitals | Quiz-Capitais** é um quiz online onde você precisa acertar a capital de um respectivo país. Utilizando funções do laravel e de PHP puro, criamos um array com todas as capitais do mundo para alimentar os dados das questões e sorteamos a informação que irá aparecer na tela.
Com o uso de componentes, criamos um código limpo, leve e reutilizável. 

## Imagem do Projeto 📸

![Capital-Quiz](public/assets/images/Capital-Countries.png)

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes pré-requisitos instalados em sua máquina:

- **PHP** (versão 7.4 ou superior) - [Download PHP](https://www.php.net/downloads) Esse projeto foi feito utilizando a versão 8.2.24

- **Composer** (para gerenciar dependências do PHP) - [Download Composer](https://getcomposer.org/download/)  Não há necessidade de nenhuma alteração na configuração padrão 

- **Laragon** (para ambiente local) - [Download Laragon](https://laragon.org/download/) Não há necessidade de nenhuma alteração na configuração padrão 


## Instalação

Siga os passos abaixo para configurar o projeto em sua máquina local:

1. **Clone o repositório**

   - Abra o terminal e execute:
     ```bash
     git clone https://github.com/Gugaluis/Quiz-Capitais
     cd Quiz-Capitais
     ```

2. **Instale as dependências com Composer**

   - Execute o seguinte comando na pasta do projeto:
     ```bash
     composer install
     ```
          
3. **Configuração do Ambiente**

   - Renomeie o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env
     ```
   - Abra o arquivo `.env` e configure as informações da sessão, como:
     ```env
      APP_NAME="Países e Capitais"
      APP_ENV=local
      SESSION_DRIVER=file
     ```
     
4. **Gere a chave de aplicativo**

   - Execute o comando a seguir para gerar uma chave única para o aplicativo:
     ```bash
     php artisan key:generate
     ```
     
5. **Inicie o servidor**

   - Você pode iniciar o servidor integrado do Laravel com o seguinte comando:
     ```bash
     php artisan serve
     ```
   - O aplicativo estará disponível em `http://localhost:8000`.

## Utilização

1. **Acessando o Aplicativo**

  - Abra o navegador e vá para `http://localhost:8000`.

2. **Escolhendo Quantidade de questões**

  - Escolha a quantidade de questões que deseja ter no quiz e clique em iniciar questionário
  - Selecione uma das 4 opções que irá aparecer na tela 
  - No final se você acertar mais de 50% das questões o seu resultado será verde e você ganha

## Contribuição

Se você deseja contribuir para o projeto, sinta-se à vontade para abrir uma issue ou enviar um pull request.
