# Origine du projet
Ceci est un projet réalisé par deux étudiants du but informatique en seconde année. Le projet consiste à créer un site internet en php pour des quiz avec une base de données, un autoloader et des fichiers bien ranger.


## Membre du projet
    - MARIDAT Ethan 2A3B
    - BABA Ahmet 2A3B

## Lancement du projet et explication

Pour lancer le projet vous devez d'abord vous connecter à votre base de données (nous, nous utilisons une bd MySQL donc le chargement est fait par rapport à ça) et lancer les deux fichiers de création de la bd et celle des insertion, ensuite dans le terminal vous devez tapez la commande 'php -S localhost:8000' ceci va vous afficher le quiz. Vous devrez commencer par vous authentifier. En effet, vous devez soit crée un compte avec un pseudo-contenant 6 caractères ou soit vous connecter avec votre compte. Ensuit-vous avez accès à tous les quiz qui ont été insérer dans la base de données, vous pouvez commencer un quiz. Une fois le quiz commencé, vous verrez les questions s'afficher puis vous pourrez y répondre et enregistrer vos réponses ensuite vous verrez votre score par rapport au nombre de questions. Une fois que vous avez réalisé un quiz, il n'est plus possible de le refaire.

## se souvenir (pour nous)

Lorsque nous utilisons un autoloader (ici dans notre cas on se place directement dans le répertoire Classes) nous avons pas besoin pour les fichier dans Choice d'écrire le namespace 'Classes\Choice' le namespace sera 'Choice'