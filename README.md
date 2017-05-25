Sodybaiciai
===========

A Symfony project created on May 23, 2017, 8:34 am.

Sukurtas naujas projektas. Kiekvienas susikurkime po savo branch'ą ir dirbkime jame.
Database sukurta, bet jokių lentelių dar nėra.

Installation

In order for code to run properly, you need to do following things:


    Run composer install, to install backend dependencies. Provide configuration details for your application.
    Run bower install ./vendor/sonata-project/admin-bundle/bower.json, to install admin panel frontend dependencies.
    Run php bin/console doctrine:database:create, to create MySQL database according to parameters provided in the first step.
    Run php bin/console doctrine:schema:update --force, to create required MySQL tables.
    Run php bin/console doctrine:migrations:migrate, to add data to database.
    Run php bin/console fos:user:create adminuser --super-admin, to create an admin user (email ir pass pasirenkate kokį norite)

