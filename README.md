# PET STOCK API

This is a test API for Pet Stock. Developed via Symfony 3. This is a REST API.

## Getting Started

Download or GIT clone the complete project into your PC.
```
Open your terminel and get project
git clone https://github.com/kgsithum/PS_API.git
```
### Prerequisites

You must have PHP installed and a web server(Apache) in your PC.  
You must have Mysql installed to run this  




### Installing

Open terminal and locate to project folder and install dependancies via composer  
```
composer install
```

Install Data Base  

Get petstock.sql file from SQL folder. Create database "petstock" in mysql and import the petstock.sql file to that created database.  
```
Proper way to Installing data base is creating migration file usin DoctrineMigrationsBundle.
```

Install Backup script  

Get backup.sh file from the BACKUP folder and place it into the /var/backup/  
Open terminal and set cron job for backup script
```
crontab -e
00 23 * * * /var/backup/backup.sh
```

## API Documentation  




## Acknowledgments

Reference :
*  [Symfony](https://symfony.com/doc/current/)
*  [RESTful Web Services](https://www.tutorialspoint.com/restful/)
