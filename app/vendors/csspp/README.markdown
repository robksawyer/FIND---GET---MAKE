CSSPP: CSS Pre-Processor
========================

Install
-------

Extract file into a `csspp` directory in your web root.

.htaccess
---------

Your `.htaccess` file should look something like this:

    RewriteEngine On
    RewriteBase /
  
    RewriteCond %{REQUEST_URI} \.css$
    RewriteRule ^(.+)$  /csspp/process.php?file=%{REQUEST_URI}&%{QUERY_STRING}
