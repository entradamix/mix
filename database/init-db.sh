#!/bin/bash
set -e
echo "VERIFICANDO DB"
# Verifica se o banco de dados já existe
if ! mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE $MYSQL_DATABASE"; then
    echo "Database does not exist. Creating now..."
    
    # Executa o script de criação do banco de dados
    mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"
    
    # Execute outros scripts SQL aqui, se necessário
    mysql -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /docker-entrypoint-initdb.d/db.sql
else
    echo "Database already exists. Skipping initialization."
fi
