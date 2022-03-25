# Recommendation algorithm

Collaborative filtering recommendation system
- Ranking algorithm using likes / dislikes or star-based rating
- This package can be used in any PHP application or with any framework.
- Download package: ```composer require tigo/recommendation```
- MIT license. ***Feel free to use this project***. ***Leave a star :star: or make a fork !***

*If you found this project useful, consider making a donation to support the developer.* 

[![paypal](https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/donate?hosted_button_id=S7FBV5N6ZTRXQ)
|
[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/donate?hosted_button_id=PPDESEV98R8KS)

[![](https://github.com/tigoCaval/images/blob/main/web/recommend.gif)](https://github.com/tigoCaval/recommendation-algorithm)

 ### Getting started
 Starting with composer
 1. Install composer
 2. Download package: ```composer require tigo/recommendation```
 3. PHP >= 7.0; Versions that have been tested: 7.2.25, 7.3.23 e 8.0.1. 
 
 ```php
 //Somewhere in your project, you may need to use autoload
 include __DIR__ ."/vendor/autoload.php";
 ```
### Algorithms
- ranking
- euclidean
- slope one
### Introduction
Recommend a product using collaborative filtering
```php
   /**  
     $table gets the array from the database.
     $user is the foreign key that represents the user who will receive the recommendation.
   **/
   use Tigo\Recommendation\Recommend; // import class
   $client = new Recommend();
   $client->ranking($table,$user); //optional third parameter refers to the score not accepted
   $client->euclidean($table,$user); //optional third parameter refers to the minimum accepted score
   $client->slopeOne($table, $user); //optional third parameter refers to the minimum accepted score
```
 
### Configuration
Sometimes, it may be necessary to rename the value of the constants (According to your database table).

[![example](https://github.com/tigoCaval/images/blob/main/web/table_r1.jpg)](https://github.com/tigoCaval/recommendation-algorithm)

- Configure: standard key (Directory: ```./src/configuration/StandardKey.php```)
```php
    const SCORE = 'score'; //score  
    const PRODUCT_ID = 'product_id'; //Foreign key
    const USER_ID = 'user_id'; //Foreign key 
```
### Example
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
  use Tigo\Recommendation\Recommend; // import class
  $client = new Recommend();
  print_r($client->ranking($table,"Pedro")); // result = ['C' => 2] 
  print_r($client->ranking($table,"Pedro",1)); // result = []; 
  
  print_r($client->euclidean($table,"Pedro")); // result = ['C' => 1]
  print_r($client->euclidean($table,"Pedro", 2)); // result = [] ;  
  
  print_r($client->slopeOne($table,'Pedro')); // result = ['C' => 1]
  print_r($client->slopeOne($table,'Pedro', 2)); // result = []
```

### Supporting this project
If you are interested in supporting this project, you can help in many ways. Leave a star :star: or make a donation of any value.

### Sponsor supporting this project
- []
### Contributors
 - [Tiago A C Pereira](https://github.com/tigoCaval) 
 - [list of contributors](https://github.com/tigoCaval/recommendation-algorithm/graphs/contributors)
### License
MIT license. See the archive [License](https://github.com/tigoCaval/recommendation-algorithm/blob/main/LICENSE)

---

