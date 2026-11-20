<h1 align="center">Magento 2 Return Product Plugin</h1>
  
Customer can create a request to return products after order complete

# Requirements
    Minimum PHP 8.1  
    Maximum PHP 8.4  
    Magento minimum version: 2.4.4
    Magento maximum version: 2.4.8  

# Installation
#### Installing

In command line, navigate to the installation directory of Magento2

Enter the following commands:

```
composer require ankush/returnorder
php bin/magento setup:upgrade
php bin/magento cache:clean
```

The plugin is now installed
  

#### Update instructions

In command line, navigate to the installation directory of Magento2

Enter the following commands:

```
composer update ankush/returnorder -W
php bin/magento setup:upgrade
php bin/magento cache:clean
```

The plugin has now been updated
