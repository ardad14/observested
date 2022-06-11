#!/bin/bash
now=$(date '+%Y-%m-%d_%H:%M:%S')
docker exec observested-db /usr/bin/mysqldump -u root --password=root Observested > "backups/backup_${now}.sql"
