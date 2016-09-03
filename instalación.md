# Instalar Laravel en Mac OSX

## Instalar __PHP__

1. Actualizar _brew_ `$ brew update`
2. Ejecutar `$ brew install homebrew/php/php70`

## Instalar __Composer__

1. Descargar: https://getcomposer.org/installer
2. Ejecutar el archivo descargado `$ cd ~/Downloads/` y `$ php installer`
3. Mover el ejecutable `mv composer.phar /usr/local/bin/composer`
4. Editar `$ nano ~/.bash_profile` agregar `export PATH=$PATH:~/.composer/vendor/bin`

## Instalar __Valet__

1. Ejecutar `$ composer global require laravel/valet`
2. Luego `$ valet install`
3. Comprobar `$ ping foobar.dev` que no pierda paquetes `ctrl+c`

## Instalar __Maria DB__

1. Ejecutar `$ brew install mariadb`
2. Iniciar _mysql_ `$ mysql.server start`
3. Entrar a _mysql_ `$ mysql -uroot`

## Instalar Laravel

1. Ejecutar `$ composer global require "laravel/installer"`

## Crear un proyeto de prueba en _laravel_

1. Crear la carpeta `$ mkdir ~/sites`
2. Ir a `$ cd ~/sites`
3. Agregar la carpeta de proyectos `sites` a `valet` con `$ valet park`
4. Crear el proyecto `blog` con `$ laravel new blog`
5. Ir a http://blog.dev para probar que el proyecto funcione

## Enlaces de interés

* __Composer__ https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
* __Install Laravel__ https://laravel.com/docs/5.3/installation
* __Valet__ https://laravel.com/docs/5.3/valet
