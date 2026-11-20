<h1 align="center">Magento 2 Return Product Plugin</h1>
  
Customers can create a request to return products after the order is complete.

# Requirements
    Minimum PHP 8.1  
    Maximum PHP 8.4  
    Magento minimum version: 2.4.4
    Magento maximum version: 2.4.8  

# Installation
#### Installing

In the command line, navigate to the installation directory of Magento2

Update your root Magento composer.json:
```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ankushsantra/returnorder.git"
        }
    ]
}
```
Enter the following commands:

```
composer require ankush/returnorder:dev-main
php bin/magento setup:upgrade
php bin/magento cache:clean
```

The plugin is now installed
  

#### Update instructions

In the command line, navigate to the installation directory of Magento2

Enter the following commands:

```
composer update ankush/returnorder -W
php bin/magento setup:upgrade
php bin/magento cache:clean
```

<img width="1632" height="745" alt="ReturnOrder_FE" src="https://github.com/user-attachments/assets/4637e57b-6d74-48db-adf2-5e6761794d65" />
<img width="437" height="617" alt="ReturnOrder_A1" src="https://github.com/user-attachments/assets/a328d945-0579-4ad5-88bd-9c44ebdd2cc0" />
<img width="1887" height="877" alt="ReturnOrder_A2" src="https://github.com/user-attachments/assets/90faf82e-0f49-4b40-9f45-e527e5c641d1" />

