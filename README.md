# php-java-aes
php-aes encrypt&decrypt match with java

Compatible with php7, removed mcrypt dependency.
### PHP Dependencies
- openssl

### Cipher:
AES-128-ECB

### Usage Example:

------------
```php
$key = 'abcdef';
$aes = new Aes();

#do encrypt
$encrypted = $aes->encrypt('something',$key);
echo $encrypted.PHP_EOL;

#do decrypt
$decrypted = $aes->decrypt($encrypted,$key);
echo $decrypted.PHP_EOL;

```
