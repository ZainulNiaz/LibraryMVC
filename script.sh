#!/bin/bash
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer install
composer dump-autoload

cp config/sample.config.php config/config.php
# Edit the file using your mysql database credentials

sudo nano /etc/apache2/sites-available/library.sds.conf
echo "127.0.0.1      library.sds" >> /etc/hosts

cd public
STR = pwd;

touch /etc/apache2/sites-available/library.sds.conf
 echo "
 <VirtualHost *:80>
        ServerAdmin contact@sdslabs.co.in
        ServerName mvc.sdslabs.local
        # Change the path below to wherever your application's public folder is in your system
        DocumentRoot $STR 
        # Change the path below too
        <Directory $STR >
                #Do not show indexes
                #Do not follow symlinks
                Options -Indexes -MultiViews
                #Order allow,deny
                Require all granted
                Allowoverride All
                <IfModule mod_rewrite.c>
                        RewriteEngine on
                        RewriteCond %{REQUEST_FILENAME} !-f
                        RewriteCond %{REQUEST_FILENAME} !-d"
>> /etc/apache2/sites-available/library.sds.conf

echo '
                        RewriteCond $1 !^(index\.php)
                        RewriteRule ^(.*)$ index.php/$1 [L]
                </IfModule>
        </Directory>
        ErrorLog /var/log/apache2/mvc.error.log
        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn
        CustomLog /var/log/apache2/mvc.access.log combined
</VirtualHost>
' >> /etc/apache2/sites-available/library.sds.conf




# sed -i 's/\r$//'	script.sh	