#!/bin/sh

port=`fuser 8080/tcp`

if [ $port ];
then
echo "yes"
else
`php -f chat-server.php < /dev/null > script.log &`
fi
exit
