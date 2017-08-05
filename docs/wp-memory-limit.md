# Increasing WordPress memory limit

This setting increases PHP Memory only for WordPress, not other applications. By default, WordPress will attempt to increase memory allocated to PHP to **40MB** for single site and **64MB** for multisite, so the setting in ```wp-config.php``` should reflect something higher than **40MB** or **64MB** depending on your setup.

WordPress will automatically check if PHP has been allocated less memory than the entered value before utilizing this function. For example, if PHP has been allocated **64MB**, there is no need to set this value to **64M** as WordPress will automatically use all **64MB** if need be.

!> Please note, this setting may **NOT** work if your host does **NOT** allow for increasing the PHP memory limit--in that event, contact your host to increase the PHP memory limit. Also, note that many hosts set the PHP limit at **8MB**.

## Increase PHP memory to 64MB

```php
define( 'WP_MEMORY_LIMIT', '64M' );
```

## Increase PHP memory to 96MB

```php
define( 'WP_MEMORY_LIMIT', '96M' );
```

Administration tasks require much memory than usual operation. When in the administration area, the memory can be increased or decreased from the ```WP_MEMORY_LIMIT``` by defining ```WP_MAX_MEMORY_LIMIT```.

```php
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
```

!> Please note, this has to be put before ```wp-settings.php``` inclusion.
