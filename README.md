# Recommendation algorithm
Collaborative filtering recommendation system
- Ranking algorithm using likes / dislikes or star-based rating
- This package can be used in any PHP application or with any framework.
- Download package: ```composer require tigo/recommendation```

 ### Getting started
 Starting with composer
 1. Install composer
 2. Download package: ```composer require tigo/recommendation```
 3. PHP >= 7.0; Versions that have been tested: 7.2.25, 7.3.23 e 8.0.1. 
 
 ```php
 //Somewhere in your project, you may need to use autoload
 include __DIR__ ."/vendor/autoload.php";
 ```
 
### Introduction
Recommend a product using collaborative filtering
```php
   /**  
     $table gets the array from the database.
     $user is the foreign key that represents the user who will receive the recommendation.
   **/
   use Tigo\Recommend; // import class
   $client = new Recommend();
   $client->ranking($table,$user) 
   $client->euclidean($table,$user,0);   
```
 
### Configuration
Sometimes, it may be necessary to rename the value of the constants (According to your database table).

[![example](https://github.com/tigoCaval/images/blob/main/web/tablereco.png)](https://github.com/tigoCaval/recommendation-algorithm)

- Configure: standard key (Directory: ```./src/configuration/StandardKey.php```)
```php
    const SCORE = 'score'; //score  
    const PRODUCT_ID = 'product_id'; //Foreign key
    const USER_ID = 'user_id'; //Foreign key 
```
### Syntax Example
A simple didactic demonstration of the algorithm
```php
  /**
     Example using "rating: liked and disliked"
     like: score = 1;  dislike: score = 0
  **/
   $table = [
        ['product_id'=> 'A',
         'score'=> 1, 
         'user_id'=> 'Pedro'
        ],
        ['product_id'=> 'B',
         'score'=> 1, 
         'user_id'=> 'Pedro'
        ],
        ['product_id'=> 'A',
         'score'=> 1, 
         'user_id'=> 'João'
        ],
        ['product_id'=> 'B',
         'score'=> 1, 
         'user_id'=> 'João'
        ],
        ['product_id'=> 'C',
         'score'=> 1, 
         'user_id'=> 'João'
        ]
  ];
  use Tigo\Recommend; // import class
  $client = new Recommend();
  print_r($client->ranking($table,"Pedro")); // result = ['C' => 2] 
  print_r($client->euclidean($table,"Pedro", 0)); // result = ['C' => 1]
  /**third parameter determines the lowest accepted score**/
  print_r($client->euclidean($table,"Pedro", 2)); // result = [] ;  
```
