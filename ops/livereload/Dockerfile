FROM node:10-alpine

RUN npm i --global livereload
WORKDIR /livereload

ENTRYPOINT livereload . -d -u true
