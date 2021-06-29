# Crazy-Lemp

## Full stack docker server

A docker environment for Linux that contains :

- PHP
- MySQL
- Nginx

All in seperate containers in order to keep scalability at maximum.

This is a boilerplate, that means you need to change some things to push it into production.

-------------------
## 🔌 Installation

### Prerequisite

- [docker installation](https://docs.docker.com/get-docker/)
- [bash shell](https://fr.wikipedia.org/wiki/Bourne-Again_shell) console to use it
- [git installation](https://git-scm.com/book/fr/v2/D%C3%A9marrage-rapide-Installation-de-Git)
- An idea about how Nginx server, MySQL database or PHP are working, especially together
- Basics knowledges on how command line works is also a good start

### ⚡ Quick start

`git clone https://github.com/LeFodeurCou/crazy-lemp.git yourFolderName`

`cd yourFolderName`

`./lemp run`

`./lemp ssl`

And it's all you need 🎶

-------------------
## 💻 Usage

### Structure

| Name | Role |
| --- | --- |
| lemp | Main shell script. Run what you need |
| lemp.env | Shell script containing all configuration variables |
| lemp.bin | Folder with all other shell script wich are running under lemp script control |
| lemp.core | Folder where all secrets are. Here you will found Dockerfiles, natives scripts or configurations files each containers needs |
| build | Folder which contain your projects files |

### Lemp script

```
Usage: lemp [command...] [args...]

    run      {php|mysql|nginx}    Without args runs all containers, else runs specific container
    stop     {php|mysql|nginx}    Without args stops all containers, else stops specific container
    php                           Runs php container            
    mysql                         Runs mysql container          
    nginx                         Runs nginx container          
    list                          Lists all docker containers   
    reset                         Use `lemp stop` and `docker system prune -fa` then reset nginx site available conf file
    ssl                           Setup ssl connexion throught Letsencrypt

See lemp.env to change configuration variables
```
✋ SSL is not configured to be used in local environment. It made for production only.

### Configuration in lemp.env

```
#!/bin/bash

# Softs versions

phpVersion='8.0';
mysqlVersion='8.0';

# MySQL setup

mysqlRootPassword='rootpass';
mysqlUser='webapp';
mysqlHost='%';
mysqlPassword='webapp';
mysqlDatabase='webapp';
```

✋ PHP is using alpine versions for it's container
✋ MySQL root  user is 'root'

### Others scripts in lemp.bin

| Script name | Role |
| --- | --- |
| d-php | Launch PHP container |
| d-mysql | Launch MySQL container |
| d-nginx | Launch Nginx container |
| d-run | Launch all containers or one of theim |
| d-stop | Stop all containers or one of theim |
| d-letsencrypt | Setup ssl certificate in Nginx container |
| d-reset | Stop all containers, use docker system prune and recreate original Nginx configuration file |

### Core files in lemp.core

There is three folders

#### PHP

It contains :
- `Dockerfile` to setup PHP container

That's all here.

#### MySQL

It contains :
- `Scripts` folder with init.sql file. This file will be created and recreated each time you launch MySQL container using d-mysql script.

~~And that's all ...~~

Not all, after at least one run, there will be a `db` folder containing one folder per database version. It is the heart of your database and you have to be careful with it.

#### Nginx

It contains :
- `Dockerfile` to setup Nginx container
- `default.conf` of the server
- `site-available`, a folder containing each configuration files you need
- `site-enabled`, a folder with a symbolic link from each configuration files you need

There is no redirection in `.conf` files for SSL nor root.
If you need first you have to see below, for the second, you have to do it yourself 😜

### Your build

On this repository there is a minimal PHP exemple of MySQL connexion in `build` folder.

Replace it by your project from the index file until the most hidden file you have.

> TIP : You can use symbolic link here to get your project from anywhere you want with your own organization
Using : ` ln -s /the/path/of/your/project/ build/`

## ✒ Configurations to run your project

For your own project there is some files you need to update manually : 

- Add a `.conf` file in lemp.core/nginx/site-available/

- Create manually a symbolic link in lemp.core/nginx/site-enabled/ or modify lemp.bin/d-nginx to add the command ad hoc instead of `ln -sf lemp.core/nginx/sites-available/lefodeurcou.fr.conf nginx/sites-enabled/` (recommended)

- Replace domain in `docker exec nginx certbot --nginx -d lefodeurcou.fr -d www.lefodeurcou.fr -m lefodeurcou@gmail.com --agree-tos -w /usr/share/nginx/html/letsencrypt/` in lemp.bin/d-letsencrypt with your own

- And the last if you plan to use it, change in `cp lemp.core/nginx/sites-available/lefodeurcou.fr.src lemp.core/nginx/sites-available/lefodeurcou.fr.conf` in lemp.bin/d-reset

-------------------

## 🔐 License

MIT

-------------------
## 📢 Last word

Don't forget, be crazy 💥💥💥