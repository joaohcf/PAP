FROM mysql:5.7

ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=dbGestor
ENV MYSQL_USER=my_user
ENV MYSQL_PASSWORD=my_password

COPY database.sql /docker-entrypoint-initdb.d/