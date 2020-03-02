FROM node:10-alpine

RUN npm i --global docsify-cli
WORKDIR /docsify

ENTRYPOINT docsify serve ./ -p 3000 -P 35730
