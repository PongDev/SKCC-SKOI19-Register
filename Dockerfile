FROM ubuntu:latest

RUN apt update && apt upgrade -y
RUN apt install -y tzdata
RUN apt install -y apache2
RUN apt install -y php
RUN apt install -y php-mysql
RUN apt install -y netcat
RUN apt install -y nodejs
RUN apt install -y npm
RUN apt install -y screen
RUN apt install -y unzip
RUN apt install -y php-mbstring
RUN apt install -y php-dom
RUN apt install -y wget
RUN a2enmod rewrite
RUN a2enmod proxy
RUN a2enmod proxy_http
RUN a2enmod headers
RUN a2enmod deflate

RUN wget https://browscap.org/stream?q=PHP_BrowsCapINI
RUN cp stream?q=PHP_BrowsCapINI $(dirname $(dirname $(find /etc/php -name "php.ini"|grep cli)))/mods-available/php_browscap.ini
RUN echo >> $(find /etc/php -name "php.ini"|grep cli) "\n[browscap]\nbrowscap = $(dirname $(dirname $(find /etc/php -name "php.ini"|grep cli)))/mods-available/php_browscap.ini\n"
RUN mv stream?q=PHP_BrowsCapINI $(dirname $(dirname $(find /etc/php -name "php.ini"|grep apache2)))/mods-available/php_browscap.ini
RUN echo >> $(find /etc/php -name "php.ini"|grep apache2) "\n[browscap]\nbrowscap = $(dirname $(dirname $(find /etc/php -name "php.ini"|grep apache2)))/mods-available/php_browscap.ini\n"

RUN echo > /composer.sh '#!/bin/bash'"\nscript_path="\$0"\ndestroy() {\n          shred -fzu \$script_path\n}\ntrap destroy EXIT\nEXPECTED_CHECKSUM=\"\$(php -r 'copy(\"https://composer.github.io/installer.sig\", \"php://stdout\");')\"\nphp -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\"\nACTUAL_CHECKSUM=\"\$(php -r \"echo hash_file('sha384', 'composer-setup.php');\")\"\nif [ \"\$EXPECTED_CHECKSUM\" != \"\$ACTUAL_CHECKSUM\" ]\nthen\n    >&2 echo 'ERROR: Invalid installer checksum'\n    rm composer-setup.php\n    exit 1\nfi\nphp composer-setup.php --quiet\nRESULT=\$?\nrm composer-setup.php\nexit \$RESULT\n"
RUN chmod +x /composer.sh
RUN /composer.sh
RUN mv /composer.phar /usr/bin/composer

RUN echo > /setup.sh '#!/bin/bash'"\nwhile ! nc -z mysql 3306; do\n    sleep 1\ndone\ncd /home/SKOI19_Register\nchown -R $USER:www-data /home/SKOI19_Register/storage\nchown -R $USER:www-data /home/SKOI19_Register/bootstrap/cache\nchmod -R 755 /home/SKOI19_Register\nchmod -R 775 /home/SKOI19_Register/storage\nchmod -R 775 /home/SKOI19_Register/bootstrap/cache\ncomposer install\ncomposer update laravel/framework\ncp .env.example .env\nsed -i -e 's/APP_NAME=.*/APP_NAME=SKOI19_Register/g' /home/SKOI19_Register/.env\nsed -i -e 's/APP_ENV=.*/APP_ENV=production/g' /home/SKOI19_Register/.env\nsed -i -e 's/APP_DEBUG=.*/APP_DEBUG=false/g' /home/SKOI19_Register/.env\nsed -i -e 's/DB_DATABASE=.*/DB_DATABASE='\$DB_DATABASE'/g' /home/SKOI19_Register/.env\nsed -i -e 's/DB_USERNAME=.*/DB_USERNAME=root/g' /home/SKOI19_Register/.env\nsed -i -e 's/DB_HOST=.*/DB_HOST=mysql/g' /home/SKOI19_Register/.env\nsed -i -e 's/DB_PASSWORD=.*/DB_PASSWORD='\$DB_PASSWORD'/g' /home/SKOI19_Register/.env\nsed -i -e 's/#!.*/#!\/usr\/bin\/node/g' /home/SKOI19_Register/pdfcreator/pdfcreator.js\nphp artisan key:generate\nphp /home/SKOI19_Register/artisan migrate --force\nphp /home/SKOI19_Register/artisan db:seed --force\nchmod +x /home/SKOI19_Register/pdfcreator/pdfcreator.js\ncp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/SKOI19_Register.conf\nsed -i -e 's|DocumentRoot /var/www/html|ProxyPreserveHost On\\\n\\\n	ProxyPass \"/SKOI19/Database\" \"http://'\phpmyadmin':80\"\\\n	DocumentRoot /home/SKOI19_Register/public\\\n\\\n	<Directory /home/SKOI19_Register/public>\\\n		AllowOverride All\\\n		Require all granted\\\n	</Directory>|g' /etc/apache2/sites-available/SKOI19_Register.conf\na2dissite 000-default.conf\na2ensite SKOI19_Register.conf\napache2ctl restart\ncd /home/SKOI19_Register/pdfcreator\nnpm install\nnpm install pdfmake\nnpm audit fix\ncd /\nscript_path=\"\$0\"\ndestroy() {\n                                  shred -fzu \$script_path\n}\ntrap destroy EXIT\n"
RUN echo > /run.sh '#!/bin/bash'"\nif test -f /setup.sh; then\n    chmod +x /setup.sh\n    /bin/bash /setup.sh\nfi\ncd /home/SKOI19_Register/pdfcreator\nscreen -dmS pdfcreator ./pdfcreator.js\ncd /\napachectl -D FOREGROUND\n"
RUN chmod +x /run.sh

EXPOSE 80

CMD /run.sh
