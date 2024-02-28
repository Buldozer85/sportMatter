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
   1. <b>docker-compose exec app php artisan key:generate</b>
8. Dále je potřeba zapnout vite server příkazem <b>docker-compose exec app npm run dev</b>
9. Aplikace by měla být viditelná na adrese [localhost](http://localhost)
10. V případě chybové hlášky typu permissions denied spustit příkaz <b>docker-compose exec app php artisan:optimize</b>, který vymaže starou cache aplikace

