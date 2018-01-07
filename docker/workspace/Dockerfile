FROM laradock/workspace:1.8-71

LABEL Maintainer="Layton Everson <layton.everson@gmail.com>"

ARG PUID=1000
ARG PGID=1000

ENV PUID ${PUID}
ENV PGID ${PGID}

RUN groupadd -g ${PGID} laradock \
    && useradd -u ${PUID} -g laradock -m laradock \
    && apt-get update -yqq

USER root

ARG TZ=UTC
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./composer.json /home/laradock/.composer/composer.json
COPY ./crontab /etc/cron.d
RUN chown -R laradock:laradock /home/laradock/.composer \
    && chmod -R 644 /etc/cron.d

USER laradock
COPY ./aliases.sh /home/laradock/aliases.sh
RUN echo "" >> ~/.bashrc \
    && echo "# Load Custom Aliases" >> ~/.bashrc \
    && echo "source /home/laradock/aliases.sh" >> ~/.bashrc \
    && echo "" >> ~/.bashrc \
	&& sed -i 's/\r//' /home/laradock/aliases.sh \
	&& sed -i 's/^#! \/bin\/sh/#! \/bin\/bash/' /home/laradock/aliases.sh

USER root
RUN echo "" >> ~/.bashrc \
    && echo "# Load Custom Aliases" >> ~/.bashrc \
    && echo "source /home/laradock/aliases.sh" >> ~/.bashrc \
    && echo "" >> ~/.bashrc \
	&& sed -i 's/\r//' /home/laradock/aliases.sh \
	&& sed -i 's/^#! \/bin\/sh/#! \/bin\/bash/' /home/laradock/aliases.sh


ADD insecure_id_rsa /tmp/id_rsa
ADD insecure_id_rsa.pub /tmp/id_rsa.pub

RUN rm -f /etc/service/sshd/down \
    && cat /tmp/id_rsa.pub >> /root/.ssh/authorized_keys \
    && cat /tmp/id_rsa.pub >> /root/.ssh/id_rsa.pub \
    && cat /tmp/id_rsa >> /root/.ssh/id_rsa \
    && rm -f /tmp/id_rsa* \
    && chmod 644 /root/.ssh/authorized_keys /root/.ssh/id_rsa.pub \
    && chmod 400 /root/.ssh/id_rsa

RUN pecl -q install mongodb \
    && pecl -q install -o -f redis \
    && echo "extension=mongodb.so" >> /etc/php/7.1/mods-available/mongodb.ini \
    && echo "extension=redis.so" >> /etc/php/7.1/mods-available/redis.ini \
    && ln -s /etc/php/7.1/mods-available/mongodb.ini /etc/php/7.1/cli/conf.d/30-mongodb.ini \
    && phpenmod redis

USER laradock
ARG NODE_VERSION=stable
ENV NODE_VERSION ${NODE_VERSION}
ARG INSTALL_NODE=false
ENV INSTALL_NODE ${INSTALL_NODE}
ENV NVM_DIR /home/laradock/.nvm
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.1/install.sh | bash && \
        . $NVM_DIR/nvm.sh && \
        nvm install ${NODE_VERSION} && \
        nvm use ${NODE_VERSION} && \
        nvm alias ${NODE_VERSION} && \
        npm install -g gulp bower vue-cli

# Wouldn't execute when added to the RUN statement in the above block
# Source NVM when loading bash since ~/.profile isn't loaded on non-login shell
RUN echo "" >> ~/.bashrc && \
    echo 'export NVM_DIR="$HOME/.nvm"' >> ~/.bashrc && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"  # This loads nvm' >> ~/.bashrc

USER root
RUN echo "" >> ~/.bashrc \
    && echo 'export NVM_DIR="/home/laradock/.nvm"' >> ~/.bashrc \
    && echo '[ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"  # This loads nvm' >> ~/.bashrc

ENV PATH $PATH:$NVM_DIR/versions/node/v${NODE_VERSION}/bin

USER laradock
ARG YARN_VERSION=latest
ENV YARN_VERSION ${YARN_VERSION}

RUN [ -s "$NVM_DIR/nvm.sh" ] \
    && . "$NVM_DIR/nvm.sh" \
    && if [ ${YARN_VERSION} = "latest" ]; then \
        curl -o- -L https://yarnpkg.com/install.sh | bash; \
    else \
        curl -o- -L https://yarnpkg.com/install.sh | bash -s -- --version ${YARN_VERSION}; \
    fi \
    && echo "" >> ~/.bashrc \
    && echo 'export PATH="$HOME/.yarn/bin:$PATH"' >> ~/.bashrc

USER root
RUN echo "" >> ~/.bashrc \
    && echo 'export YARN_DIR="/home/laradock/.yarn"' >> ~/.bashrc \
    && echo 'export PATH="$YARN_DIR/bin:$PATH"' >> ~/.bashrc

USER laradock
RUN echo "" >> ~/.bashrc \
    && echo 'export PATH="/var/www/vendor/bin:$PATH"' >> ~/.bashrc

USER root
RUN apt-get update \
    && apt-get install -y --force-yes \
        php7.1-xdebug \
        jpegoptim \
        optipng \
        pngquant \
        gifsicle \
        python \
        python-pip \
        python-dev \
        build-essential \
        imagemagick \
        php-imagick \
    && . ~/.bashrc \
    && mkdir -p /usr/local/bin \
    && curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony \
    && echo 'alias dev="php bin/console -e=dev"' >> ~/.bashrc \
    && echo 'alias prod="php bin/console -e=prod"' >> ~/.bashrc \
    && echo "alias phpunit='php -dzend_extension=xdebug.so /var/www/vendor/bin/phpunit'" >> ~/.bashrc \
    && sed -i 's/^;//g' /etc/php/7.1/cli/conf.d/20-xdebug.ini \
    && pip install --upgrade pip  \
    && pip install --upgrade virtualenv \
    && npm install -g svgo \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./xdebug.ini /etc/php/7.1/cli/conf.d/xdebug.ini

WORKDIR /var/www
