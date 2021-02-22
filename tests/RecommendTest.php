<?php
namespace Tigo\Recommendation\Tests;

use Tigo\Recommendation\Recommend;
use Tigo\Recommendation\Tests\DataArrayTrait;
use PHPUnit\Framework\TestCase;

class RecommendTest extends TestCase
{
      use DataArrayTrait;
    
      public function  testRankingExpectedResult()
      {
          $client = new Recommend();
          $pedro = $client->ranking($this->table,'Pedro');
          $maria = $client->ranking($this->table,'Maria'); 
          $joaquim = $client->ranking($this->table,'Joaquim');
          $beto = $client->ranking($this->table,'Beto');
          $luiz = $client->ranking($this->table,'Luiz');
          $rui = $client->ranking($this->table,'Rui');
          $beatriz = $client->ranking($this->table,'Beatriz');
          $luana = $client->ranking($this->table,'Luana'); 

          $this->assertEquals($pedro, ['C'=>5]); 
          $this->assertEquals($maria, ['F'=>2]);
          $this->assertEquals($joaquim, ['F'=>4,'G'=>2]);
          $this->assertEquals($beto, ['F'=>2,'G'=>1,'B'=>1]);
          $this->assertEquals($luiz, ['A'=>2,'C'=>2,'F'=>2, 'G'=>1]);
          $this->assertEquals($rui, ['G'=>2,'F'=>2]);
          $this->assertEquals($beatriz, ['A'=>2,'G'=>2,'C'=>1]);
          $this->assertEquals($luana, ['A'=>5,'G'=>2]);
      }

      public function  testEuclideanExpectedResult()
      {
            $client = new Recommend();
            $pedro = $client->euclidean($this->table,'Pedro');
            $maria = $client->euclidean($this->table,'Maria'); 
            $joaquim = $client->euclidean($this->table,'Joaquim');
            $beto = $client->euclidean($this->table,'Beto');
            $luiz = $client->euclidean($this->table,'Luiz');
            $rui = $client->euclidean($this->table,'Rui');
            $beatriz = $client->euclidean($this->table,'Beatriz');
            $luana = $client->euclidean($this->table,'Luana');

            $this->assertEquals($pedro, ['C'=>0.86]); 
            $this->assertEquals($maria, ['F'=>1,'C'=>0.74]);
            $this->assertEquals($joaquim, ['F'=>1,'G'=>1]);
            $this->assertEquals($beto, ['F'=>1,'G'=>1,'B'=>0.25]);
            $this->assertEquals($luiz, ['A'=>0.83,'C'=>0.8,'F'=>1, 'G'=>1]);
            $this->assertEquals($rui, ['G'=>1,'F'=>1]);
            $this->assertEquals($beatriz, ['A'=>0.67,'G'=>1,'C'=>0.5]);
            $this->assertEquals($luana, ['A'=>0.87,'G'=>1]);
      }

      public function testSlopeOneExpectedResult()
      {
            $client = new Recommend();
            $pedro = $client->slopeOne($this->table,'Pedro');
            $this->assertEquals($pedro,['C'=>0.57]);
      }


}
