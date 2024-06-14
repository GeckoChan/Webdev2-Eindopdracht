# Webdev2-Eindopdracht

# Login Info
# Admin:
username= Admin
password= test

# All other users:
password= test

username=
Gecko
Ahrnuld
Cat
Dog
etc...

# Wat is geimplementeerd:
1. required functionality: 
    Homepagina laat all achievments zien + top users met meeste achievements
    Als je inlogt op een normale account 
        kan je je eigen achievements zien.
    Als je inlogt als admin
        kan je alle achievements inzien createn, editen en deleten.
            Hier kan je ook naar de volgende pagina m.b.v. offset / limit
        Je kan alle users zien
            Hier kan je ook naar de volgende pagina m.b.v. offset / limit (als er genoeg users zijn)
            Je kan ook klikken op assign achievement
        Assign achievements
            Hier kan je alle users en achievements zien
            Je kan ook weer naar volgende pagina
            Je kan hier ook achievements assignen en unassignen
2. css framework:
    Ik maak vooral gebruik van bootstrap
    design is niet responsive (ik ben daar te lui voor)(en niet mooi)
    Ik heb mezelf niet beperkt aan template code. (ik heb gwn wat geschreven tot alles werkt)\
3. Frontend architecture:
    routing kan je terug vinden op jwt-frontend/src/router/index.js
    Statemanagement wordt gedaan op: jwt-frontend/src/main.js met behulp van pinia.
    Verder kan je dit terug vinden in de jwt-frontend\src\stores\userstore.js file
4. REST API:
    De get all requests + wat andere maken gebruiken offset en limts. je kan dit terug vinden in jwt-backend\app\controllers
5. Authentication
    Ik heb role based access control gebruikt. dit kan je terug vinden in jwt-backend\app\controllers\controller.php file



