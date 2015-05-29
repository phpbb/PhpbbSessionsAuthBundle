# phpBB Sessions Auth Bundle

This allows you to use phpBB as a authentication provider and share its sessions.

It was originally developed for use on the new phpBB Symfony Website but was then open sourced.


Configuration
=============

First of all, make sure in your application to ignore the phpBB tables, by using:

```
doctrine:
    dbal:
        schema_filter: ~^(?!phpbb_)~
```        
where phpbb_ is your prefix. Not making this configuration change can cause your forum tables to be deleted!

Bundle configuration:
```
phpbb_sessions_auth:
    session:
        secure: false
        cookiename: ""
        boardpath: ""
    database:
        connection: ""
        prefix: ""
```