# Recommendation algorithm
Collaborative filtering recommendation system
- Ranking algorithm using likes / dislikes or star-based rating
- This package can be used in any PHP/composer application or with any framework.
- Download package: ```composer require tigo/recommendation```
### Configuration
Sometimes it may be necessary to rename the value of the attributes (According to your database table).

[![example](https://github.com/tigoCaval/images/blob/main/web/tablereco.png)]()

- Configure: standard key (Directory: ```./src/configuration/StandardKey.php```)
```php
    const SCORE = 'score'; //score  
    const PRODUCT_ID = 'product_id'; //Foreign key
    const USER_ID = 'user_id'; //Foreign key 
```
### Syntax Example
Didactic demonstration of the algorithm
```php
  $table = [
   ['product_id' = 'A',
    'score' = 1, 
    'user_id' = 'Pedro'
   ],
   ['product_id' = 'B',
    'score' = 1, 
    'user_id' = 'Pedro'
   ],
   ['product_id' = 'A',
    'score' = 1, 
    'user_id' = 'João'
   ],
   ['product_id' = 'B',
    'score' = 1, 
    'user_id' = 'João'
   ],
   ['product_id' = 'C',
    'score' = 1, 
    'user_id' = 'João'
   ]
 ];
 use Tigo\Recommend; // import
 $client = new Recommend();
 print_r($client->ranking($table,"Pedro")); 

```
