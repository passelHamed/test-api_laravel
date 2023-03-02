to install and run Api

composer update
composer install
php artisan key:genrate
change database name in env
php artisan migrate
php artisan db:seed
change smtp in env
change QUEUE_CONNECTION=database


show data
-------------------
/websites (show all websites)
/websites/page=1
/websites/page=2
/websites/1 (show website 1)
/websites/1/posts (show posts on website 1)

/posts (show all posts)
/posts/page=1
/posts/page=2
/posts/1 (show post 1)

/subscribes (show all subscribes)
/subscribes/page=1
/subscribes/page=2
/subscribes/1 (show subscribe 1)

------------------------------------------


create post&website
--------
 post 

/websites
    title = ??
    url = ??

/posts
    title = ??
    description = ??
    website_id = ??


update posts&website
--------
patch

/websites/1
    title = ??
    url  = ??

/posts/1
    title = ??
    description = ??
    website-id = ??


delete posts&website
-------
delete

/websites/1

/posts/1


--------------------------

to subscribe website
-------

/subscribes
     email = ??
     website_id = ??


---------------------------


to send mails when subscribe && create post
-----------
php artisan queue:work or php artisan queue:listen
php artisan send:posts-email




