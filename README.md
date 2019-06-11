# debug

## Connection

### Nginx:
fastcgi_param PHP_VALUE "auto_prepend_file=/path_to/debug.php";

### Apache:
php_value auto_prepend_file "/path_to/debug.php"

### Php CLI:
mkdir -p ~/.php.d
echo 'auto_prepend_file=/path_to/debug.php' >> ~/.php.d/php.ini
echo 'export PHP_INI_SCAN_DIR=:~/.php.d' >> ~/.bashrc
