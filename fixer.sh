#!/bin/bash

# Transformar tabs em 2 espaços
# find . -type f -name "*.php" | awk '{print "expand -t 2", $0, "> tmp ; mv tmp", $0}' | sh

# Nova versão de transformar tabs em 2 espaços
FILES=$(find . -type f -name "*.php")

for f in $FILES; do
  echo "$f"
  expand -t 2 "$f" > tmp
  mv tmp "$f"
done

# Unificar o caractere EOL pro formato Unix '\n'
find . -type f -name "*.php" -exec dos2unix {} \;

# Eliminar trailing whitespaces
find . -type f -name "*.php" -exec sed -i -E 's/[[:space:]]+$//' {} \;

# phpcbf fix
phpcbf --standard=.phpcs/CodeSniffer/Custom *.php backend/*.php

# TODO Problema com indentação a 2 espaços (phpcbf)
# php-cs-fixer
# find . -type f -name "*.php" -exec php-cs-fixer fix {} \
#   --rules="@PSR2" \
#   --rules='{"braces": {"position_after_functions_and_oop_constructs": "same"}}' \;
