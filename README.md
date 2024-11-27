# Projecto de Estágio
## Proposta de um sistema de gestão de cursos online - Luro

# Descrição

O uso de tecologias no nosso país tende a ganhar mais aceitação 
no meio da comunidade como na educação, saúde e demais sectores. 
Na área educacional, concretamente no ensino á distância tem se 
enfrentado alguns defasios como: garantir um equilibrio de nivel 
de assimilação de conteúdos em todos os alunos onde o plano temático
é o mesmo, menor abrangência de estudantes nos dias de aulas online por
motivos justos como, conflito de agendas e fraca disponibilidade da rede global.
Portanto com a implementação de um sistema de gestão de cursos online pode vir abrangir
vária demanda interessada e auxiliar aos instrutores a prepararem as suas aulas e 
disponibiliza-las aos seus estudantes por meio desta plataforma o que poderia 
ajudar a abrangir maior número de estudantes devido a característica que este 
apresenta de percistência de dados, o que possibilita tambem a ele armazenar os seus
proprios video aulas durante um período estimado ou vitalício, não só poderia ajudar a diminuir a fraca 
participação por alguns motivos a que destacodos como  a oscilação da rede nas
zonas urbanas nos dias de alguns encontros em algumas plataformas de salas online 
por isso surge a ideia de se implementar um  sistema de  cursos online (Luro), onde os 
usuários tem a possibilidade de explora-lo em três níveis de acesso: 
Administrador, Instrutor, Estudante
Baseado na metotologia Scrum permitirá um desenvolvimento organizado e eficiente, garantindo um sistema robusto e alinhado com as necessidades dos usuários atraves 
dos seguintes estágios:
Product Owner (PO): Onde são definidos os requisitos e funcionalidades essenciais, priorizando as necessidades do sistema.
Scrum Master: Facilita o processo, garante o cumprimento das práticas SCRUM e remove impedimentos.
Equipe de Desenvolvimento: Responsável pelo desenvolvimento, teste e implementação das funcionalidades do sistema.

### Administrador

#### Autenticação
Com uma autencicação de dois factores e tambem baseada em tokens onde sao armazenados
na base de dados e associados ao usuário, o administrador tem a possibilidade de criar 
uma conta, gerenciar os instrutores  e avaliação dos cursos cadastrados 
pelos mesmos para posterior aprovação ou reprovação com base nos termos e condições
de uso do sistema.

#### Autorização
O administrador tem a autorização de criar as categorias, avaliar os cursos e ter acesso aos
instrutores apenas.

### Instrutor

#### Autorização
Após passar pela autencicação de dois factores o instrutor é autorizado apenas a ter acesso completo das
regras de gestão e avalição dos alunos subscritos nos cursos por ele criado, cadastro de modulos, aulas, 
mareial de apoio,quizzes e questionários.

### Estudante

#### Autorização
Após passar pela autencicação de dois factores o estudante é autorizado apenas a se subscrever no curso,
realizar pagamentos e acompanhar as aulas ou baixar para uma revisão futura.

O sistema para alem de fornecer um ambiente responsivo, permite o armazenamento de logs de autencicação
no storage da aplicação, realiza uma transação
segura de dados no cadastro e actualização dos cursos com base em transações no banco de dados não só com
os observadores o sistema faz logs de auditoria nos cursos apenas.

# Ferramentas

>>Laravel 11x, Framework
>>Mailit v1.21.4, servidor smtp local
>>PHP 8.2
>>Sqlite, Gerencia do banco de dados
#Instalação

### Comando para clonar o projecto no github
```bash
git clone https://github.com/DaVitoria/luro.git
```

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
npm install
```

# Passos de utilização

### Inicializaçao do servidor smtp
```bash
Baixar a ferramenta aqui: https://mailpit.axllent.org/docs/install/
```

Dentro da pasta acesse o cmd e digita
	```bash
	mailpit.exe
	``` 
Apos isso acesse este link: http://localhost:8025

### Testes
Testes realizados na função __invoke na area de login.
Abrir o terminal
	```bash
	php artisan serve
	php artisan test
	```
	Apos esta acção acesse este link: http://localhost:8000
