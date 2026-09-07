## Para hacer commit en nuestra rama individual
``` bash
git checkout NombreDeNuestraRama        #Nos aseguramos de que estamos en nuestra rama
git add .                               #Añadimos todos los cambios que hemos hecho
git commit -m "mensajeDeCommit"         #Guardamos los cambios localmente con un mensaje descriptivo
git push                                #Subimos los commits a nuestra rama en GitHub
```


## Para hacer merge de main en nuestra rama:
``` bash
git checkout main                       #Cambiamos a la rama main
git pull origin main                    #Descargamos los últimos cambios de GitHub a nuestra main local
git checkout NombreDeNuestraRama        #Volvemos a nuestra rama de trabajo
git merge main                          #Fusionamos los cambios más recientes de main en nuestra rama
git push origin NombreDeNuestraRama     #Subimos la versión actualizada de nuestra rama a GitHub
```