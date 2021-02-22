<?php
namespace Tigo\Recommendation\Collaborative;

use Tigo\Recommendation\Collaborative\Base;
 
/**
 * Slope One algorithm
 * 
 * @author Tiago A C Pereira <tiagocavalcante57@gmail.com>
 */
class SlopeOneCollaborative extends Base
{
      
    /**
     * Get average weight.
     * @var array
     */
    protected $weight = [];
      
    /**
     * Get items rated by other customers (difference matrix).
     * @var array
     */
    protected $factor = [];

    /**
     * Get items rated by the client.
     * @var array
     */
    protected $myProduct = [];

     /**
      * Get recommend. 
      * @param array $table
      * @param mixed $user
      * @param mixed $score
      * 
      * @return array
      */
     public function recommend($table, $user, $score = 0)
     {
          return $this->filterRating($this->prediction($table, $user, $score));
     }

    /**
     * Get customer rated product and update format.
     * @param array $table
     * @param mixed $user
     * 
     * @return array
     */
    private function update($table, $user)
    {
        $this->ratedProduct($table, $user);
        foreach($this->product as $item){
            $this->myProduct[$item[self::USER_ID]][$item[self::PRODUCT_ID]] = $item[self::SCORE];
        }
        foreach($this->other as $item){ 
            $this->factor[$item[self::USER_ID]][$item[self::PRODUCT_ID]] = $item[self::SCORE]; 
        }
    }
    
    /**
     * Get calculated items (f(x) = x + b).
     * @param array $table
     * @param mixed $user
     * 
     * @return array
     */
    private function calculateItems($table, $user)
    {
        $this->update($table, $user);
        $diff = $this->factor;
        $data = [];
        foreach($this->factor as $key1 => $item1){
            foreach($item1 as $key2 => $value1){ 
                foreach($diff as $key3 => $item2){
                    foreach($item2 as $key4 => $value2){
                         if(!isset($data[$key2][$key4]) && !isset($this->weight[$key2][$key4])){
                            $data[$key2][$key4] = 0;
                            $this->weight[$key2][$key4] = 0; 
                         }       
                         if($key1 == $key3){
                            $data[$key2][$key4] += ($value1 - $value2);
                            $this->weight[$key2][$key4] += 1;
                         }         
                    }
                }
            }     
        }
        return $data; 
    }

    /**
     * Get average difference.
     * @param array $table
     * @param mixed $user
     * 
     * @return array
     */
    private function averageDifference($table, $user)
    {
        $component = $this->calculateItems($table, $user);
        $data = [];
        foreach($this->myProduct as $key1 => $item1){
            foreach($item1 as $key2 => $value1){
               foreach($component as $key3 => $item2){
                   foreach($item2 as $key4 => $value2){
                        if($key2 == $key4){
                            if(!isset($data[$key3][$key4]))
                                $data[$key3][$key4] = 0;
                            if($this->weight[$key3][$key4] > 0)    
                                $data[$key3][$key4] +=  ($value2/$this->weight[$key3][$key4])+$value1;   
                        }   
                   }
               }
            }
        }
        return $data;
    }

    /**
     * Get prediction.
     * @param array $table
     * @param mixed $user
     * @param mixed $score
     * 
     * @return array
     */
    private function prediction($table, $user, $score)
    {
        $component = $this->averageDifference($table, $user);
        $weight = [];
        $data = [];
        $result = [];
        foreach($component as $key1 => $item1){
            foreach($item1 as $key2 => $value1){
                  if(!isset($weight[$key1]) && !isset($data[$key1]) ){
                     $weight[$key1] = 0;
                     $data[$key1] = 0;
                  }   
                  $weight[$key1] += $this->weight[$key1][$key2];
                  $data[$key1] += $value1 * $this->weight[$key1][$key2];                
            }
        }
        
        foreach($data as $key1 => $value){
            $average = round($value/$weight[$key1],2);
            if($average >= $score)
               $result[$key1] = $average;
        }
        return $result;
    } 
       
}