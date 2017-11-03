# Wordpress Plugins Manager

This page displays differents ways to **disable / enable plugins on WordPress**, whether you have access to your site via FTP or via database (which is usually the case). 

It could be useful if, for some reason, your site is "broken" and you can't login to disable a plugin via the admin panel.

> **tl;dr :** this page should answer **"How to disable one or all plugin(s) in WordPress?"**

## Disable one plugin via FTP

- Connect to your site directory and go to /wp-content/plugins directory
- Find the directory used by your plugin and rename it. 
  - For example : /wp-content/plugins/my-plugin -> /wp-content/plugins/my-plugin-disabled

> To enable the plugin again, rename the directory with its original name

## Disable all plugins via FTP

- Connect to your site directory and go to /wp-content/plugins directory
- Rename every directories... 
  - For example : /wp-content/plugins/my-plugin -> /wp-content/plugins/my-plugin-disabled

> To enable the plugins again, rename all the directories (...) with their original name

## Disable all plugins via database

- Connect to your site database via your favorite database manager (ex : PhpMyAdmin)
- In table **wp_options** :
  - Find the **active_plugins** key
  - **Copy the value and save it somewhere !**
  - Replace that value by : ````a:0:{}````
  - Alternative / faster way : execute this query 
  - ````UPDATE wp_options SET option_value = 'a:0:{}' WHERE option_name = 'active_plugins';````
  
> To enable the plugins again, replace the value by the one you saved

## Disable one plugin via database

- **This is the only case where those files are really needed**
- You'll need a machine with PHP running (you can use anyhing like Wamp for example)
- Once you've downloaded the files, go to : http://localhost/wordpress-plugins-manager
