# EFPHT-project
A Symfony3 project (currently in dev)

before running project
Update composer dependencies : 

    php composer.phar update

Set up the Database and load example data :
    
    $ php app/console doctrine:fixtures:load
    $ php app/console doctrine:database:create
    $ php app/console doctrine:schema:create

done !
