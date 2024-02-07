# Info Database #

Il nome del database utilizzato (e da creare su mysql): __letturepremiate__

## BackUp del database ##

mysqldump -u username -p letturepremiate > letturepremiate_dump.sql

## Restore del database ##

mysql -u username -p letturepremiate < letturepremiate_dump.sql


(dove username può essere root)