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

        return new Response(
            '<html>
                <body>
                    Manufacturers: '.$number.'<br> 
                    Lowest price:  '.$number.'<br> 
                    Highest price: '.$number.'<br> 
                    Average price: '.$number.'<br> 
                </body>
            </html>'
        );
    }
}
