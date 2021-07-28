<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Car;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Car::with('category');

        if($request->get('brand')) {
            $query = $query->where('brand', $request->get('brand'));
        }

        if($request->get('asc')) {
            $query = $query->sortBy('brand', 'asc');
        }

        if($request->get('model')){
            $query->where('model','like' ,'%'.$request->get('model').'%');
        }
        if($request->get('brand')){
            $query->where('brand','like' ,'%'.$request->get('brand').'%');
        }

        if($sort=$request->input('sort')){
            if ($colum=$request->input('colum')) {
                $query->orderBy("$colum", $sort);
            }
        }
        return response()->json($query->paginate(10));
    }



    public function money(Request $request){

        $amount = Category::select('price')->where('id',1)->get();
        $toCurrency = $request->input('tocurrency');

        try {
            $client = new Client([
                'base_uri' => 'http://data.fixer.io/api/',
            ]);

            $response = $client->request('GET', 'latest', [
                'query' => [
                    'access_key' => '6a1a571d3b6b4c6a2a7e22d5c1d1be43',
                    'symbols' => "$toCurrency",
                ]
            ]);
            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();
                $arr_body = json_decode($body);
                $value = $arr_body->rates->$toCurrency;
                $newAmount = $amount[0]['price'];
                $changed = $value * $newAmount;
                return response()->json($changed);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCar = new Car();

        $newCar->registration_license = $request->input('registration_license');
        $newCar->brand = $request->input('brand');
        $newCar->model = $request->input('model');
        $newCar->manufacture_date = $request->input('manufacture_date');
        $newCar->description = $request->input('description');
        $newCar->category_id = $request->input('category_id');
        $newCar->properties = $request->input('properties');

        $newCar->save();
        return response()->json($newCar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $car->registration_license = $request->input('registration_license');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->manufacture_date = $request->input('manufacture_date');
        $car->description = $request->input('description');
        $car->category_id = $request->input('category_id');
        $car->properties = $request->input('properties');

        $car->save();
        return response()->json($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json($car);
    }
}
