<?php
namespace Tigo\Recommendation\Factories;

use Tigo\Recommendation\Creator\CollaborativeCreator;
use Tigo\Recommendation\Interfaces\CollaborativeInterface;

class CollaborativeFactory extends CollaborativeCreator
{
    /**
     * @param CollaborativeInterface $col
     * @param array $table
     * @param mixed $user
     * @param mixed $score
     * 
     * @return [type]
     */
    protected function factoryMethod(CollaborativeInterface $col, $table, $user, $score)
    {
      return $col->recommend($table, $user, $score);
    }
}