FROM node:12-alpine

ADD custom-entrypoint.sh /var/www/custom-entrypoint.sh
RUN chmod +x /var/www/custom-entrypoint.sh

WORKDIR /var/www/front/
EXPOSE 8080

ENTRYPOINT ["/var/www/custom-entrypoint.sh"]

