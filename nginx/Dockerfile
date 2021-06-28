FROM nginx:stable-alpine
ENV CRYPTOGRAPHY_DONT_BUILD_RUST=1
RUN apk add gcc musl-dev python3 python3-dev libffi-dev openssl-dev cargo py3-pip build-base libressl-dev
RUN pip3 install pip --upgrade
RUN pip3 install certbot-nginx
RUN mkdir /usr/share/nginx/html/letsencrypt/
