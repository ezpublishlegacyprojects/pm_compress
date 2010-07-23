2010 Jean-Luc Nguyen - Publicis Modem

1/ Introduction

This extension allows to compress / minify static files (javascript, stylesheet ... ) with a command line.

2/ Installation

* Download the compressed file under /extension directory and uncompress it.
* Activate the extension.
* Clear the caches
* Re-build the class autoload array : php bin/php/ezpgenerateautoloads.php -e

3/ Configuration

Edit pmcompress.ini.append.php file:

- DirectoryPath is the array of directories files to compress.
- Extension is the array of allowed file extensions to compress.

4/ How to use using the CLI script

The CLI script is located in extension/pm_compress/bin/php/pmcompress.php
