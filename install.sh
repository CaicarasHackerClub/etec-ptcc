#!/bin/bash

NODE_PATH="/etc/apt/sources.list.d/nodesource.list"
YARN_PATH="/etc/apt/sources.list.d/yarn.list"

D2U=$(which dos2unix)
PCF=$(which php-cs-fixer)

if [[ ! -x "$D2U" ]] ; then
  sudo apt -y update && sudo apt -y install dos2unix
fi

if [[ ! -x "$PCF" ]] ; then
  wget http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -O php-cs-fixer
  sudo chmod a+x php-cs-fixer
  sudo mv php-cs-fixer /usr/local/bin/php-cs-fixer
fi

if [[ ! -f "$NODE_PATH" ]]; then
    echo "* Adicionando PPA para NodeJS"
    curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
fi

if [[ ! -f "$YARN_PATH" ]]; then
    echo "* Adicionando PPA para Yarn"
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
fi

echo "* Atualizando cache de repositórios online"
sudo apt-get -y update
echo "* Instalando os pacotes dos repositórios"
sudo apt-get install -y build-essential nodejs php-pear yarn
sudo pear install PHP_CodeSniffer
sudo npm update -g npm
echo "* Dando permissões de execusão para o fixer.sh"
chmod a+x fixer.sh
echo "* Instalando módulos"
yarn install
echo "* Configurando Sniffers"
