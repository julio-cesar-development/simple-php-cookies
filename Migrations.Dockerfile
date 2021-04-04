FROM node:12-alpine
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /migrations/
COPY ./migrations/ /migrations/

RUN npm install --silent
RUN chmod +x /migrations/docker-entrypoint.sh

ENTRYPOINT [ "/bin/sh", "-x", "/migrations/docker-entrypoint.sh"]

CMD [ "npm", "run", "start" ]
