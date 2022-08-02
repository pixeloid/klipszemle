
# Frontend code builder
FROM  --platform=linux/amd64 node:12-alpine

RUN apk add --update \
    bash \
    lcms2-dev \
    libpng-dev \
    gcc \
    g++ \
    make \
    autoconf \
    automake \
  && rm -rf /var/cache/apk/*

WORKDIR /usr/src

COPY ../app /usr/src

WORKDIR /usr/src/app

RUN yarn install


EXPOSE 8080
#CMD yarn dev-server

