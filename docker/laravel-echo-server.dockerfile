FROM node

# Install selected extensions and other stuff
RUN npm install -g laravel-echo-server

COPY ./laravel-echo-server.json /laravel-echo-server.json

CMD laravel-echo-server start
