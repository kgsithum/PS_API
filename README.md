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

### Author  

#### Author - Get all authors

###### Method : GET  
```
/author  
```
###### Parameters
```
```
###### Success-Response
```
HTTP/1.1 200 OK
    {
      "id": 1,
      "name": "Andrew",
    },
    {
      "id": 2,
      "name": "Andrew 2"
    }
```

#### Author - Get single author

###### Method : GET  
```
/author/:id  
```
###### Parameters
```
id => Integer - Author ID
```
###### Success-Response
```
HTTP/1.1 200 OK
    {
      "id": 1,
      "name": "Andrew"
    }
```

### Article  

#### Article - Get all articles

###### Method : GET  
```
/article  
```
###### Parameters
```
```
###### Success-Response
```
HTTP/1.1 200 OK
    {
      "id": 1,
      "title": "Anewarticle",
      "author": 1,
      "summary": "Some content...",
      "url": "/article/1",
      "createdAt": "2017-03-20"
    },
    {
      "id": 2,
      "title": "Anewarticle",
      "author": 2,
      "summary": "Some content...",
      "url": "/article/2",
      "createdAt": "2017-03-20"
    }
```

#### Article - Get single article

###### Method : GET  
```
/article/:id  
```
###### Parameters
```
id => Integer - Article ID
```
###### Success-Response
```
HTTP/1.1 200 OK
    {
      "id": 1,
      "title": "Anewarticle",
      "author": 1,
      "summary": "Some content...",
      "url": "/article/1",
      "createdAt": "2017-03-20"
    }
```


## Acknowledgments

Reference :
*  [Symfony](https://symfony.com/doc/current/)
*  [RESTful Web Services](https://www.tutorialspoint.com/restful/)
