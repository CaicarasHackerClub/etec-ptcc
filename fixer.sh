#!/bin/bash

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

# Unificar o caractere EOL pro formato Unix '\n'
find . -type f -name "*.php" -exec dos2unix {} \;

# Transformar tabs em 4 espaços
find . -type f -name "*.php" | awk '{print "expand -t 2 ", $0, " > tmp; mv tmp ", $0}' | sh

# Eliminar trailing whitespaces
find . -type f -name "*.php" -exec sed -i -E 's/[[:space:]]+$//' {} \;

# Tentar resolver alguns erros com o php-cs-fixer
find . -type f -name "*.php" -exec php-cs-fixer fix {} --rules='{"braces": {"position_after_functions_and_oop_constructs": "same"}}' \;

