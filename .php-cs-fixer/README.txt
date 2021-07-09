This folder contains additional tools for php-cs-fixer.

Wordpress-specific files used to automatically fully qualify core
functions and classes:
wp-core.csv - List of all core Wordpress classes and functions.

Built from the VS Code Wordpress Toolbox's snippets definition:
$ curl \
  https://raw.githubusercontent.com/jason-pomerleau/vscode-wordpress-toolbox/master/snippets/snippets.json \
  | sed -nE -e 's/.*(ƒ|Class|Constant): ([^"]+).*/"\2"/p' \
  | sed '/^$/d' | sed '$!s/$/,/' \
  > wp-core.csv
