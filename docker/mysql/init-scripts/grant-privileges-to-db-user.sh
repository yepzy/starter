#!/bin/bash

mysql -u root -p${MYSQL_ROOT_PASSWORD} -e \
"GRANT PROCESS,SELECT ON *.* to '$MYSQL_USER'@'%'; FLUSH PRIVILEGES;";
