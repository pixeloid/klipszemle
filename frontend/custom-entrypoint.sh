#!/bin/sh
COPY yarn.lock .
COPY package.json .

RUN yarn --prod --frozen-lockfile

COPY . .

EXPOSE 8080

CMD [ "yarn", "start" ]
