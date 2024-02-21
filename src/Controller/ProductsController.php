<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $file = fopen("/Users/sofiamihaleva/products/src/data/file1.csv","r");
        //reading the first line
        fgetcsv($file);
     
        //writing the data from the file in the database
        $products =array();
        while(!feof($file))
        {
          $line = fgetcsv($file,0,";");
          //todo separate function
        $product = new Product();
        $product->setItemNumber($line[0]);
        $product->setDescription($line[1]);
        $product->setManufacturer($line[2]);
        $product->setCategory($line[3]);
        $product->setProductGroup($line[4]);
        if($this ->isNumeric($line[5])) {
        $price = str_replace(',','.', $line[5]);
        $product->setPrice($price);
       }
        $product->setInventory(intval($line[6]));
        $product->setEstimatedLeadTime($line[7]);
        $product->setQuality($line[8]);
        if($this ->isNumeric($line[9])) {
        $product->setEan($line[9]);
        }

        array_push($products,$product);
        $entityManager->persist($product);
        $entityManager->flush();
        }
        fclose($file);

        $minArray=$entityManager->getRepository(Product::class)->findMinPrice();
        $minPrice = $minArray[0];

        $maxArray = $entityManager->getRepository(Product::class)->findMaxPrice();
        $maxPrice = $maxArray[0];

        $manufacturers = $entityManager->getRepository(Product::class)->findUniqueManufacturers();
        
        $avgPriceArray = $entityManager->getRepository(Product::class)->findAvgPrice();
        $avgPrice = $avgPriceArray[0];

        $entityManager->getRepository(Product::class)->deleteAllData();

        return new Response(
            '<html>
                <body>
                    Manufacturers: '.print_r($manufacturers).'<br> 
                    Lowest price: '.array_values($minPrice)[0].'  <br> 
                    Highest price: '.array_values($maxPrice)[0].'<br> 
                    Average price: '.array_values($avgPrice)[0].'<br> 
                </body>
            </html>'
        );
    }

    private function isNumeric(string $item): bool{
        $pattern="(\d+(\.|\,)*\d+)";
        if (preg_match($pattern, $item)){
        return true;
       } 
      return false;
    }

}
