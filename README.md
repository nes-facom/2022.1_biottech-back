# BiotTech - Back-End
Esse repositório abriga o código responsável pelo front-end da aplicação BiotTech.

## Configurando o Ambiente:
Para Iniciar o sistema localmente é necessário a instalação de algumas dependências:
1. [XAMPP](https://www.apachefriends.org/pt_br/download.html): Pacote com os principais servidores que irão permitir rodar o sistema. (versão utilizada: 8.1.6)  
2. [Composer](https://getcomposer.org): gerenciador de dependências. (versão utilizada 2.3.7)
		Obs: É recomendado setar o *path* do PHP já na opção que o Composer oferece durante a instalação caso isso não seja feito a instruções para adicionar o *path* estão descritas abaixo no passo 6 da execução.

Após a instalação correta das ferramentas podemos ir para a execução.

## Execução:

1. Remova todos os arquivos instalados por padrão do diretório **~/xampp/htdocs** e então realize o clone desse repositório ,  com o seguinte comando :
```
git clone ~link do repo~
```
2. Inicialize o XAMPP e clique na opção **Config** e depois em **PHP (php.ini)**, o bloco de notas abrirá procure então por 'intl' e remova o ';' da linha que contiver :
```
extension=intl
```
3. Salve o arquivo e feche o bloco de notas.

4.  Clique em 'Start' no Apache e MySQL. Após iniciados vá em Admin do MySQL. O seu browser padrão deverá abrir em [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).

5. Clique então para criar um novo banco no canto superior esquerdo. Em '*Nome da base de dados*' inserir *my_app* e selecionar ‘*utf8mb4_general_ci*’ no campo ao lado (**Collation**).

6. Agora é necessário configurar o PHP nas variáveis de ambiente (Sistema Windows). Vá em variáveis do sistema localizar *PATH* e editar inserindo então o seguinte diretório: C:\xampp\php ou o diretório em que o XAMPP foi instalado.

7. Nos arquivos do back-end abrir o arquivo *app-local.php* (**~\htdocs\biottech-back\config\app_local.php**) e certifique-se de que Default tenha esteja:
```
‘username’ =>‘root’,
‘password’ => ‘’,
```
8.  Abra o terminal na pasta onde encontra-se o back-end do sistema e execute os seguintes comandos:
```
php bin/cake.php migrations migrate
php bin/cake.php migrations seed --seed=DatabaseSeed
```
Dessa forma o back já estará rodando localmente.

## Observações

1. O usuário padrão do tipo administrador registrado é:
```
login: admin@admin.com
senha: 123
```
2. Para fazer requisições acesse a documentação da [API](https://app.swaggerhub.com/apis-docs/UFMS/biot/1.0.0#/).

3. Caso deseje alterar as informações do usuário padrão, modifique a variável ‘*$users*’ em: **~config/Seeds/DatabaseSeed.php**. Essa alteração deve ser feita antes de executar os comandos do passo 8 da execução.
```
$users = [
	[
	'name'  =>  'Admin',
	'username'  =>  'admin@admin.com',
	'password'  =>  $hasher->hash('123'),
	'type'  =>  0 
	]
];
```
> (**Type** -> 0: admin; 1: user comum)

4. Caso queira acessar a API no [Postman](https://www.postman.com/downloads/) realize a instalação da ferramenta para desktop para conseguir realizar as requisições.

5. A *base url* do back localmente é:
```
API_ENDPOINT = 'http://localhost/biottech-back/api'
```

## Documentação

[Documentação do projeto](https://github.com/BiotTech-PDS-I-T5/biottech-docs.git)

## Stack utilizada

| Ferramenta | Versão | License |
| ----------- | ----------- | ----------- |
| CakePHP | 4.1.6 | [MIT License](https://github.com/cakephp/cakephp/blob/4.x/LICENSE)|
| Composer | 2.3.7| [MIT License](https://github.com/composer/composer/blob/main/LICENSE)|
| XAMPP | 8.1.6| [GNU License](https://www.apachefriends.org/about.html)|
| MySQL (Maria DB) | 10.4.24| [GPL License](https://mariadb.com/kb/en/licensing-faq/)|
