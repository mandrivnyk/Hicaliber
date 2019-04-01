<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\House;

 class SearchController extends BaseController {

    public function search(Request $request){
        $whereData = [];
        $params = $request->all();

        if(isset($params['Name'])) {
            $whereData[] = ['Name', 'LIKE', "%".$params['Name']."%"];
        }
        if(isset($params['Bedrooms'])) {
            $whereData[] = ['Bedrooms', '=', (int)$params['Bedrooms']];
        }
        if(isset($params['Bathrooms'])) {
            $whereData[] = ['Bathrooms', '=', (int)$params['Bathrooms']];
        }
        if(isset($params['Storeys'])) {
            $whereData[] = ['Storeys', '=', (int)$params['Storeys']];
        }
        if(isset($params['Garages'])) {
            $whereData[] = ['Garages', '=', (int)$params['Garages']];
        }
        if(isset($params['PriceFrom'])) {
            $whereData[] = ['Price', '>=', (int)$params['PriceFrom']];
        }
        if(isset($params['PriceTo'])) {
            $whereData[] = ['Price', '<=', (int)$params['PriceTo']];
        }


        $houses = House::where($whereData)->get();
        return $houses->toJson();
    }
}