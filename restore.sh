#!/bin/bash
search_dir=backups/
options=()

restore() {
    echo -ne "
Choose file\n"
index=1
for entry in "$search_dir"*
do
  echo "${index}) $entry"
  options+=($entry)
  let index=${index}+1
done
echo "Choose an option:  "
    read -r ans
    if ((ans > ${#options[@]}))
    then
        echo "Invalid choose param"
        exit 125;
    fi
    cat ${options[$ans-1]} | docker exec -i observested-db /usr/bin/mysql -u root --password=root Observested
    echo "Successful restore data"
}

restore
