<?php
namespace Tigo\Recommendation\Tests;

trait DataArrayTrait
{

  public $table = [ 
        [
            'product_id'=>'A',
            'score'=>1,
            'user_id'=>'Pedro'
        ],
        [
           'product_id'=>'B',
           'score'=>0,
           'user_id'=>'Pedro'
        ],
        [
           'product_id'=>'A',
           'score'=>0,
           'user_id'=>'Maria'
        ],
        [
           'product_id'=>'B',
           'score'=>1,
           'user_id'=>'Maria'
        ],
        [
           'product_id'=>'C',
           'score'=>1,
           'user_id'=>'Joaquim'
        ],
        [
          'product_id'=>'A',
          'score'=>1,
          'user_id'=>'Joaquim'
        ],
        [
          'product_id'=>'A', 
          'score'=>1,
          'user_id'=>'Beto'
        ],
        [
          'product_id'=>'B', 
          'score'=>0,
          'user_id'=>'Luiz'
        ],
        [
          'product_id'=>'C', 
          'score'=>1,
          'user_id'=>'Beto'
        ],
        [
          'product_id'=>'G', 
          'score'=>1,
          'user_id'=>'Pedro'
        ],
        [
          'product_id'=>'A', 
          'score'=>1,
          'user_id'=>'Rui'
        ],
        [
          'product_id'=>'B', 
          'score'=>1,
          'user_id'=>'Beatriz'
        ],
        [
          'product_id'=>'C', 
          'score'=>0,
          'user_id'=>'Rui'
        ],
        [
         'product_id'=>'G', 
         'score'=>1,
         'user_id'=>'Maria'
        ],
        [
         'product_id'=>'F', 
         'score'=>1,
         'user_id'=>'Beatriz'
        ],
        [
         'product_id'=>'B', 
         'score'=>0,
         'user_id'=>'Joaquim'
        ],
        [
         'product_id'=>'F', 
         'score'=>1,
         'user_id'=>'Pedro'
        ],
        [
         'product_id'=>'C', 
         'score'=>1,
         'user_id'=>'Luana'
        ],
        [
         'product_id'=>'F', 
         'score'=>1, 
         'user_id'=>'Luana'
        ],
        [
         'product_id'=>'B', 
         'score'=>0, 
         'user_id'=>'Luana'
        ],
        [
         'product_id'=>'B', 
         'score'=>1, 
         'user_id'=>'Rui'
        ]              
      ];
}