# Demoscene
Демосцена - сайт, где каждый может анонимно оставлять комментарии.
На сайте также есть разные модификаторы текста, чтобы было не так скучно.  

![chat](./images/DemosceneChat.png)

Реализованные модификаторы:  

![modifiers](./images/DemosceneModifiers.png)

## Ссылки
Первый сезон на [webarchive](https://web.archive.org/web/20221130191402/https://demoscene.herokuapp.com/)  
Второй сезон на [webarchive](https://web.archive.org/web/20261031161025/https://tauceti.nhost.me/demoscene/)  
Третий сезон на [Tor сервере](http://tauceti5lowrh27defk7hczwi7sv45mcii7x3yzyrzxhutocwyqlqfqd.onion/demoscene/)  

## Данные
Последняя версия использует PostgreSQL в качестве базы данных. Создание схемы описано ниже.  

```sql
CREATE DATABASE demoscene;
\c demoscene

CREATE TABLE comments (
  id SERIAL PRIMARY KEY,
  comment TEXT NOT NULL,
  birthtime TIMESTAMP(0) NOT NULL DEFAULT NOW()
);
```
