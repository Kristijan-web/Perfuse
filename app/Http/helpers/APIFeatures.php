<?php
/**
 *  Used for providing functionality for filtering and sorting and it also sanitizes the provided fields
 * 
 *  When working with different DB model, you must add the fields that you're going to allow to be used for filtering and sort, they are usually      *  defined in $alloweFields variables
 * 
 */


namespace App\Http\Helpers;
use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;

// Illuminate\Database\Query\Builder

/**
 * Main class used for filtering and sorting
 * 
 * Currently it contains methods like: filter, sort, sanitize, getQuery
 */
class APIFeatures
{

    // private string[] $queryString;
    /**
     * @param string[] $queryString
     */
    protected array $queryString;
    protected Builder $query;

    public function __construct(array $queryString, Builder $query)
    {
        $this->queryString = $queryString;
        $this->query = $query;

    }


    public function filter()
    {

        $allowedFields = ['minPrice', 'maxPrice', 'brand', 'waterType', 'onSale', 'gender', 'title'];

        $queryStringCopy = $this->queryString;

        // Deletes the fields that are not allowed
        foreach ($queryStringCopy as $key => $value) {
            if (!in_array($key, $allowedFields)) {
                unset($queryStringCopy[$key]);
            }
        }

        // filtering logic
        $maxPrice = $queryStringCopy['maxPrice'] ?? null;
        $minPrice = $queryStringCopy['minPrice'] ?? null;
        $brand = $queryStringCopy['brand'] ?? null;
        $onSale = $queryStringCopy['onSale'] ?? null;
        $gender = $queryStringCopy['gender'] ?? null;
        $waterType = $queryStringCopy['waterType'] ?? null;
        $title = $queryStringCopy['title'] ?? null;

        // price filtering
        if ($minPrice && $maxPrice) {
            $this->query->whereBetween('price', [$minPrice, $maxPrice]);
        }
        if ($minPrice && !$maxPrice) {
            $this->query->where('price', ">=", $minPrice);
        }
        if (!$minPrice && $maxPrice) {
            $this->query->where('price', "<=", $maxPrice);
        }

        if ($title) {

            $this->query->where('title', 'LIKE', "%$title%");

        }

        // product title filtering
        if ($brand) {
            // sad treba da odem do brand tabele i da izbucem samo one proizvode koji odgovaraju prosledjenom brand-u 
            // Kako da filtiriram proizode koji imaju prosledjeni brand?
            // - Pa da se uradi eager loading sa Product::with(['brand', 'waterType'])
            // - 
            // $this->query->where('title', 'LIKE', "%$productTitle%");

            // sta pass-ujem 
            $this->query->whereHas('brand', function ($q) use ($brand) {

                $q->whereIn('title', $brand);

            });
        }


        if ($waterType) {
            // water type je u drugoj tabeli
            $this->query->whereHas('waterType', function ($q) use ($waterType) {
                $q->whereIn('type', $waterType);
            });
        }

        if ($gender) {
            // samo uzmi proizvode koji imaju gender
            $this->query->whereiN("gender", $gender);
        }

        // getting products on sale
        if ($onSale) {
            // ako u tabelu products postoji discount_id = null
            $this->query->whereNotNull('discount_id');
        }


        return $this;
    }

    public function sort()
    {


        $allowedFields = ['sortBy', 'sortOrder'];

        $queryStringCopy = $this->queryString;

        foreach ($queryStringCopy as $field => $fieldValue) {

            if (!in_array($field, $allowedFields)) {
                unset($queryStringCopy[$field]);
            }
        }

        $sortBy = $queryStringCopy['sortBy'] ?? 'price';
        $sortOrder = $queryStringCopy['sortOrder'] ?? 'asc';
        $this->query->orderBy($sortBy, $sortOrder);

        return $this;

    }

    public function paginate($productsPerPage = 1)
    {

        // Jednostavno ako se vraca 30 redova, treba da se uzmu redovi od 1-10 za page 1 pa za page 2 od 11 do 20, page 3 od 21 do 30

        // Cemu sluzi paginacija?
        // - Da se ne vrate svi proizvodi iz baze vec samo deo, jer ako dodje baza to 1000+ proizvoda mozda to cak nece moci ni stati u file size JSON-a koji prihvata browser a i servera da pokupi 1000+ recorda i da napravi popuni html moze biti sporo

        //
        $allowedFields = ['page'];
        $queryStringCopy = $this->queryString;


        foreach ($queryStringCopy as $field => $fieldValue) {

            if (!in_array($field, $allowedFields)) {
                unset($queryStringCopy[$field]);
            }
        }

        $page = $queryStringCopy['page'] ?? null;


        // ako je page 1 treba biti od 1 do 10 ((1-1) * 10) + 1 = 1
        // ako je page 2 treba biti od 11 d 20   ((2-1) * 10 ) + 1 = 11
        // ako je page 3 treba biti od 21 do 30   ((3-1) * 10 )  + 1 = 21
        // treba samo da kazemo odakle da pocne od kog id-a
        // kako ide formula?
        // - ((page-1) * 10 ) + 1 

        $this->query->paginate($productsPerPage);

        return $this;

    }

    public function sanitize(array $allowedFields, array $sentFields)
    {

        // MA NEK MOZE DA SE PROSLEDI I ASOCIJATVNI NIZ I OBICAN STRING, a sanitize ce da sanitizuje i vrati isti tip koji je  prosledjen
        // znaci samo nek imam if(associative_array) {logic}, i isto if(string) {logic} i vracaju tip koji je prosledjen 



        // if (!is_array($sentFields)) {
        // $sentFields = explode(",", $sentFields);
        if (!array_is_list($sentFields)) {
            throw new InvalidArgumentException('Expected default array structure, the one with numerical indexes');
        }

        foreach ($sentFields as $key => $fieldValue) {
            if (!in_array($fieldValue, $allowedFields)) {
                unset($sentFields[$key]);
            }
        }


        return $sentFields;

    }

    public function getQuery()
    {
        return $this->query;
    }


}

