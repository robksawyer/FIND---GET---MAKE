# Cached ACL plugin for CakePHP #

This plugin implements caching for Access Control List.

## Installation ##

* Place the plugin files in your `app/plugins/cached_acl/` folder.
* Go into your `app/config/core.php` file and make the following changes: 

Code:

    # Change DbAcl to db_cached_acl
    Configure::write('Acl.classname', 'Cached_Acl.Db_Cached_Acl');

    # Optionally, you can specify a different cache configuration
    Configure::write('Acl.cache', 'my_acl_cache');

## Usage ##

The plugin works completely transparent so you don't have to change your code. 

**NOTE:** The plugin takes care of clearing the cache for you. 

## Cached ACL Shell ##

The `cacl` shell is a copy of the original ACL shell compatible with this plugin.

## Requirements ##

* PHP version 5
* CakePHP 1.3 Stable

## License ##

Copyright (c) 2011, George C. &lt;slygoncito@gmail.com&gt;

Licensed under [The MIT License](http://www.opensource.org/licenses/mit-license.php)<br/>Redistributions of files must retain the above copyright notice.
