FROM ubuntu:18.04

RUN apt-get update && apt-get install -y apache2
COPY apache/000-default.conf /etc/apache2/sites-avallible/000-default.conf

WORKDIR "/application"
