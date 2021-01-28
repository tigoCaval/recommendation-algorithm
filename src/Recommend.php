<?php
namespace Tigo\Recommendation;

use Tigo\Recommendation\Collaborative\EuclideanCollaborative;
use Tigo\Recommendation\Collaborative\RankingCollaborative;
use Tigo\Recommendation\Factories\CollaborativeFactory; 

/**
 * [class Recommend]
 * 
 * @package recommendation
 * @author Tiago A C Pereira
 */
class Recommend
{

   protected $method;

   public function __construct()
   {
       $this->method = new CollaborativeFactory();
   }

   /**
    * Get ranking | collaborative filtering algorithm.
    * @param array $table
    * @param mixed $user
    * @param mixed $score
    *
    * @return array
    */
   public function ranking($table, $user, $score = 0)
   { 
      return $this->method->doFactory(new RankingCollaborative(), $table, $user, $score);   
   }

   /**
    * Get euclidean | collaborative filtering algorithm.
    * @param array $table
    * @param mixed $user
    * @param mixed $score
    * 
    * @return array
    */
   public function euclidean($table, $user, $score = 0)
   { 
      return $this->method->doFactory(new EuclideanCollaborative(), $table, $user, $score);   
   }
   
}