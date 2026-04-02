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

        $allowedFields = ['minPrice', 'maxPrice', 'brand', 'categoryTitle', 'onSale'];

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
        $categoryTitle = $queryStringCopy['categoryTitle'] ?? null;
        $onSale = $queryStringCopy['onSale'] ?? null;
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

        // category title filtering
        if ($categoryTitle) {
            $this->query->whereHas('category', function ($query2) use ($categoryTitle): void {
                $query2->where('title', 'LIKE', "%$categoryTitle%");
            });
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

            if (in_array($field, $allowedFields)) {
                unset($queryStringCopy[$field]);
            }
        }

        $sortBy = $queryStringCopy['sortBy'] ?? 'price';
        $sortOrder = $queryStringCopy['sortOrder'] ?? 'asc';

        $this->query->orderBy($sortBy, $sortOrder);

        return $this;

    }

    public function paginate($page = 1)
    {

        // Jednostavno ako se vraca 30 redova, treba da se uzmu redovi od 1-10 za page 1 pa za page 2 od 11 do 20, page 3 od 21 do 30

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

