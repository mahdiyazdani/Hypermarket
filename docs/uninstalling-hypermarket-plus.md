# Uninstalling Hypermarket Plus plugin

There are two things to understand when uninstalling or removing **Hypermarket Plus** plugin.

* If you deactivate and delete the plugin from WordPress, you only remove the plugin and its files. The plugin options page settings, customizer values, etc. will still exist in the database.
* If you need to remove **ALL Hypermarket Plus** data, including plugin options page settings, customizer control values, etc. you need to be able to modify the site's ```wp-config.php``` file to set a constant as true.

!> Open your site's ```wp-config.php``` file and add ```define( 'HYPERMARKET_PLUS_REMOVE_ALL_DATA', true);``` on its own line above the ```/* That’s all, stop editing! Happy blogging. */``` line. 

?> Then when you deactivate and delete **Hypermarket Plus** plugin it will remove all of its data.

To uninstall the Hypermarket Plus plugin from your WordPress site, follow these steps:

* Click the **Installed Plugins** link on the **Plugins** menu.
* Locate the Hypermarket Plus plugin.
* Click the **Deactivate** link below the plugin title.
*The Plugins page refreshes, and the plugin now appears as deactivated (or inactive).*
* Click the **Delete** link that now appears below the plugin title.
*The Delete Plugin page opens, and a confirmation message displays asking you whether you're sure you want to delete this plugin.*
* Click the **Yes, Delete These Files** button.
* You're done.
