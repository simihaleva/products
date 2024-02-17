<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController
{
    #[Route('/products')]
    public function number(): Response
    {
        $number = random_int(0, 100);
        $file = fopen("/Users/sofiamihaleva/products/src/Controller/file1.csv","r");
        $manifacturers = [];
        $prices = [];
        fgetcsv($file);
        while(!feof($file))
          {
            $line = fgetcsv($file,0,";");
            if(empty($line)) continue;
            array_push($prices,$line[5]);
           array_push($manifacturers,$line[2]);
          }
          
        $manifacturers1 = array_unique($manifacturers);

        $filteredArray =array_filter($prices,array($this, 'isNumeric'));
        foreach($filteredArray as &$value){
            $value = str_replace(',','.', $value);
    
        }

        sort($filteredArray);
       // var_dump($filteredArray);
        fclose($file);
        $arraySize = count($filteredArray);
        $sum = array_sum($filteredArray);
        return new Response(
            '<html>
                <body>
                    Manufacturers: '.print_r($manifacturers1).'<br> 
                    Lowest price: '.$filteredArray[0].'  <br> 
                    Highest price: '.$filteredArray[$arraySize-1].'<br> 
                    Average price: '.$sum/$arraySize.'<br> 
                </body>
            </html>'
        );
    }


   /* private function getDataCSV(string $filename): array
    {
        $file = fopen($filename,"r");
        $manifacturers = [];
        $prices = [];
        fgetcsv($file);
        while(!feof($file))
          {
            $line = fgetcsv($file,0,";");
            if(empty($line)) continue;
            array_push($prices,$line[5]);
           array_push($manifacturers,$line[2]);
          }
          
        $manifacturers1 = array_unique($manifacturers);
        #var_dump ($manifacturers1);
        fclose($file);
        $result = [];
        return $manifacturers1;
    
    }*/

    private function isNumeric(string $item): bool{
        $pattern="(\d+(\.|\,)*\d+)";
        if (preg_match($pattern, $item)){
        return true;
       } 
      return false;
    }

}
