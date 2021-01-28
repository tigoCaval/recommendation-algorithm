<?php
namespace Tigo\Recommendation\Traits;

/**
 * [OperationTrait]
 * 
 * @author Tiago A C Pereira
 */
trait OperationTrait
{

    /**
     * Mathematical division operation.
     * Example: $dividend = ['A'=>10,'B'=>20]; $divisor = ['A'=>2,'B'=>10]; result ['A'=>5, 'B'=>2].
     * @param array $dividend
     * @param array $divisor
     * 
     * @return array
     */ 
    public function division($dividend, $divisor)
    {
        $result = [];
        foreach($dividend as $item){
            foreach($divisor as $div){
               if(key($dividend) == key($divisor)){
                   if(!isset($result[key($dividend)]))
                      $result[key($dividend)] = $item;   
                   $result[key($dividend)] =  round($result[key($dividend)]/$div,2);
               }  
               next($divisor);    
            }
            reset($divisor);
            next($dividend);
        }
        arsort($result);
        return $result;
    }

}