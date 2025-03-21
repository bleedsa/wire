#!/bin/sh

find . \
	-exec chown www:other {} \; \
	-exec chmod g+w {} \;

# hello skylar - find(1) is not needed here.

#chown -R www:other .

# creates -rw-rw---- and drwxrwx---
#chmod -R u-x+rwX,g-x+rwX,o-rwx .
