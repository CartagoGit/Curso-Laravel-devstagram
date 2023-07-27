# Curso de Laravel

## Localizacion del curso

[https://www.udemy.com/course/curso-laravel-crea-aplicaciones-y-sitios-web-con-php-y-mvc]
por Juan Pablo De la torre Valdez

## Pasos para iniciar laravel

<p>Podriamos inicializarlo con ./vendor/sail up</p>
<p>O directamente levantando el docker compose up</p>
<h4>Para crear un alias en la base de wsl para iniciar los contenedores de devstagram</h4>
<pre>alias devstagram='dir=$(pwd); cd _projects/Laravel9-Php8-MVC/devstagram && [ -f sail ] && sh sail up || sh vendor/bin/sail up; cd $dir'</pre>

## Despliegue en DomCloud

[http://cartago-devstagram.domcloud.io/] <- Direccion web

[https://my.domcloud.co/user/host/] <- Panel de deploy in domcloud
