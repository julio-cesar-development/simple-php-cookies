FROM node:12-alpine
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /migrations/
COPY ./migrations/ /migrations/

RUN npm install --silent
RUN chmod +x /migrations/docker-entrypoint.sh

ENTRYPOINT [ "/bin/sh", "-x", "/migrations/docker-entrypoint.sh"]

CMD [ "npm", "run", "start" ]

# Build this image
# docker image build -f Dockerfile -t juliocesarmidia/simple-app-migrations:latest .

# Run this image
# docker container run --rm --name simple-app-migrations -p 80:80 juliocesarmidia/simple-app-migrations:latest
# docker container run --rm --name -it simple-app-migrations -p 80:80 juliocesarmidia/simple-app-migrations:latest bash
