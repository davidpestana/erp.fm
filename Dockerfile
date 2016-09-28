# Imagen Base
  FROM ubuntu:14.04

  # Instalamos dependencias
    # apache2: Servidor Web
    # php5: Lenguaje de programacion PHP
    # php5-mysql: Driver de MySql para PHP
    # git: For app deploy.
  RUN apt-get update && apt-get -y install \
    apache2 \
    php5 \
    php5-mysql \
    git
# Get Composer
  RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
  RUN php composer-setup.php --install-dir=bin --filename=composer
  RUN php -r "unlink('composer-setup.php');"
