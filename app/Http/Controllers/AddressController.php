<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AddressController extends Controller
{
    public function index(Order $order,  Shipment $shipment)
    {
        if(!empty($shipment->toArray())){
            $result = [
                $shipment->depAddress()->get(),
                $shipment->destAddress()->get()
                ];
            return $result;
        }
        //in all other cases return ALL
        else{
            $addresses = QueryBuilder::for(Address::class)
                ->allowedFilters([
                    AllowedFilter::exact('addressName'),
                    AllowedFilter::exact('addressNumber'),
                    AllowedFilter::exact('addressStreet'),
                    AllowedFilter::exact('addressPlace'),
                    AllowedFilter::exact('addressZip'),
                    AllowedFilter::exact('addressCountry'),
                    AllowedFilter::exact('addressState'),
                    AllowedFilter::exact('addressMailBoxNumber'),
                    AllowedFilter::exact('addressExtraInfo'),
                    AllowedFilter::exact('loadingPresent'),
                    AllowedFilter::exact('trailerAccess')])
            ->get();
            return $addresses;
        }
    }

    public function show(Order $order,Shipment $shipment,Address $address)
    {
        return $address;
    }

    public function store(Request $request)
    {
        $address = Address::create($request->all());

        return response()->json($address, 201);
    }

    public function update(Request $request, Order $order,Shipment $shipment,Address $address)
    {
        $address->update($request->all());

        return response()->json($address, 200);
    }

    public function destroy(Order $order,Shipment $shipment,Address $address)
    {

        $address->delete();

        return response()->json(null,204);
    }
}
