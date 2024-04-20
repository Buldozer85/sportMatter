<p align="center"><a href="" target="_blank"><img src="https://raw.githubusercontent.com/Buldozer85/sportMatter/4d9a09547b5f53668e9e0810a31fa9fac437b1cd/public/img/logo-no-background.svg" width="400" alt="SportMatter logo"></a></p>


## Jak spustit aplikaci SportMatter pomocí dockeru

Pro jednoduché spuštění aplikace na lokálním vývojovém prostředí je zapotřebí SW <a href="https://www.docker.com/">Docker</a>

### Jednotlivé kroky prvního spuštění:

1. Ujistit se, že je v počítači docker nainstalovaný. Příkaz <b>docker -v</b> v terminálu
2. Přejít do složky projektu SportMatter
3. Zde je potřeba zkopírovat <b>.env.example</b> do souboru <b>.env</b>, který je zapotřebí vytvořit 
4. Do terminálu zadat příkaz <b>docker-compose up -d</b>
5. Zbuildění projektu bude chvíli trvat, můžete si mezitím připravit kávu
6. Po dokončení buildění by měly běžet 2 kontejnery sportMatter a db
7. Následně je potřeba spustit tyto příkazy:
    1. <b>docker-compose exec app composer dump-autoload</b>
    2. <b>docker-compose exec app composer install</b>
    3. <b>docker-compose exec app php artisan key:generate</b>
    4. <b>docker-compose exec app php artisan db:seed</b>
    5. <b>docker-compose exec app php npm install</b>
9. Dále je potřeba zapnout vite server příkazem <b>docker-compose exec app npm run dev</b>
10. Aplikace by měla být viditelná na adrese [localhost](http://localhost)
11. V případě chybové hlášky typu permissions denied spustit příkaz <b>docker-compose exec app php artisan:optimize</b>, který vymaže starou cache aplikace

### Přístupové údaje ###

#### DB #### 

    username: user
    heslo: user

#### Administrace ####
Super administrator

    email: admin@admin.com
    heslo: 123456qQ

Administrator
    
    email: administrator@administrator.com  
    heslo: 123456qQ

Editor
    
    email: editor@editor.com
    heslo: 123456qQ

#### Aplikace ####

    email: user@user.com
    heslo: 123456qQ

### Role ###

Super administrator
+ Má přístup ke všem modulům administrace
+ Má právo vykonávat všechny operace v administraci

Administrator
+ Má přístup ke všem modulům kromě správy uživatelů

Editor
+ Má přístup pouze k zápasům, které mu byly přiděleny

User
+ Pouze přístup do uživatelské části
+ Může si přidávat zápasy do oblíbených

