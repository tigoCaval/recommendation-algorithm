<?php
namespace Tigo\Recommendation\Collaborative;

use Tigo\Recommendation\Collaborative\Base;
use Tigo\Recommendation\Traits\OperationTrait;

/**
 * Collaborative filtering [recommendation algorithm EuclideanCollaborative].
 * Using the Euclidean distance formula and applying a weighted average.
 * 
 * @author Tiago A C Pereira <tiagocavalcante57@gmail.com>
 */
class EuclideanCollaborative extends Base
{
      
    use OperationTrait;
    
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
        $data = $this->average($table, $user, $score);
        return $this->filterRating($data);   
    }

    /**
     * Get users who rated the same product.
     * @param array $table
     * @param mixed $user
     * @param mixed $score
     * 
     * @return array
     */
    private function userRated($table, $user, $score)
    {
        $this->ratedProduct($table, $user);
        $rated = []; //get user rating
        foreach($this->product as $myProduct){
            foreach($this->other as $item){ 
               if($myProduct[self::PRODUCT_ID] == $item[self::PRODUCT_ID]){
                   if($myProduct[self::SCORE] >= $score && $item[self::SCORE] >= $score){
                      if(!in_array($item[self::USER_ID],$rated)) // check if user already exists
                          $rated[] = $item[self::USER_ID]; //add user
                   }     
               }
            }
        }
        return $rated;
    }

    /**
     * Get operation|using part of the euclidean formula (p-q).
     * @param array $table
     * @param mixed $user
     * @param mixed $score
     * 
     * @return array
     */
    private function operation($table, $user, $score)
    {
        $rated = $this->userRated($table, $user, $score);
        $data = [];
        foreach ($this->product as $myProduct){
            for($i = 0; $i < count($rated) ; $i++){
                foreach($this->other as $itemOther){
                    if($itemOther[self::USER_ID] == $rated[$i] &&
                    $myProduct[self::PRODUCT_ID] == $itemOther[self::PRODUCT_ID] 
                    && $myProduct[self::SCORE] >= $score && $itemOther[self::SCORE] >= $score){  
                        $data[$itemOther[self::USER_ID]][$myProduct[self::PRODUCT_ID]] = abs($itemOther[self::SCORE] - $myProduct[self::SCORE]);       
                    }  
                }
            }
        }
        return $data;
    }

    /**
     * Using the metric distance formula and convert value to percentage.
     * @param array $table
     * @param mixed $user
     * @param mixed $score
     *  
     * @return array
     */
    private function metricDistance($table, $user, $score)
    {
        $data = $this->operation($table, $user, $score);
        $element = [];
        foreach($data as $item){
            foreach($item as $value){
                if(!isset($element[key($data)]))
                    $element[key($data)] = 0;
                $element[key($data)] += pow($value,2);
            }
            $similarity = round(sqrt($element[key($data)]),2); //similarity rate
            $element[key($data)] =  round(1/(1 + $similarity), 2); //convert value
            next($data);
        }     
        return $element;
    }

   
    /**
     * Get weighted average.
     * @param array $table 
     * @param mixed $user
     * @param mixed $score
     * 
     * @return array
     */
    private function average($table, $user, $score)
    {
        $metric = $this->metricDistance($table, $user, $score);
        $similarity = [];
        $element = [];
        foreach($metric as $itemMetric){
            foreach($this->other as $itemOther){
                if($itemOther[self::USER_ID] == key($metric) && $itemOther[self::SCORE] >= $score){
                    if(!isset($element[$itemOther[self::PRODUCT_ID]])){
                       $element[$itemOther[self::PRODUCT_ID]] = 0;
                       $similarity[$itemOther[self::PRODUCT_ID]] = 0;
                    }     
                   $element[$itemOther[self::PRODUCT_ID]] += ($itemMetric * $itemOther[self::SCORE]); 
                   $similarity[$itemOther[self::PRODUCT_ID]] += $itemMetric; 
                }
            }
           next($metric);  
        }
        return $this->division($element,$similarity);
    }

}