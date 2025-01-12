# Todo List
## Created with PHP and Mariadb
## Description
I created this Todo list using php and mariadb in the backend and simple html and css in the frontend. The todo primairly uses backend to execute the application.

With this todo list you will be able to create new tasks including a description as well as edit, delete and mark as done. You also have the option to revert a completed task back onto the active tasks lists incase you made a mistake.

This project challeneged me with making PHP connect correctly to the MySQL with maridb and making CRUD functions execute properly and displa in the frontend. 

## How to run
To run this application you can use the pulled files to create a docker container to run the environment. 
After pulling the files ensure that docker is open and you can then use the docker compose file to complete a docker compose up command. 
The index.php runs on port 80 - which may be forbidden in your browser as it was for all of mine over my wifi - you can then access by going to localhost:80/src/index.php

## How to use 
Click on the Add button to insert a task name and description (you do not always need to put a description). You will then see you task displayed in the awaiting tasks section. You may then use the Edit button to edit the task name or description. The Done button will add the task to the completed tasks section and you can undo this by pressing the Or Not button. To remove a task completely you can use the Delete button, but keep in mind there is no way to recover the task once you do this. 

## Figma sketch and ER diagram
https://www.figma.com/design/JwD4qX7yLR9JUtXlE6LndT/Todo-List?node-id=0-1&m=dev&t=I9D7jh6hEWcI9UN8-1

- git also never took any of my commits into this repository even though it is the one I have been commiting to so don't know what is going on there 🥰

file:///Users/ciaranhayes/Documents/Todo%20List/

## The SQL

CREATE DATABASE mariadb;
USE mariadb;
CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(100) NOT NULL,
    description VARCHAR(200),
    done TINYINT(1) DEFAULT 0
);
