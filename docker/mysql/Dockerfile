FROM mysql:5.7

# ENV MYSQL_DATABASE laravel
# RUN ls
COPY setup.sh /mysql/setup.sh 
COPY laboratory.sql /mysql/laboratory.sql
RUN ["chmod", "+x", "/mysql/setup.sh"] 