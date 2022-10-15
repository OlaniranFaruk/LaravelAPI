<?php

use App\Http\Controllers\AuthController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/AD/departments', [\App\Http\Controllers\RandomController::class, 'CustomDepartment']);
Route::get('/AD/OU', [\App\Http\Controllers\RandomController::class, 'CustomOU']);
//Route::get('/AD/users', [\App\Http\Controllers\RandomController::class, 'CustomUsers']);
Route::get('/AD/employees', [\App\Http\Controllers\ADemployees::class, 'CustomEmployees']);
//Route::get('/AD/employees/{id}', [\App\Http\Controllers\ADemployees::class, 'CustomEmployees']);
Route::post('/AD/employees/new', [\App\Http\Controllers\ADemployees::class, 'AddEmployee']);
Route::post('/AD/employees', [\App\Http\Controllers\ADemployees::class, 'DisableEmployee']);
// Public routes
//Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('Customer signup');
//Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
//Route::group(['middleware' => ['auth:sanctum']], function () {
 //  Route::post('/logout', [AuthController::class, 'logout']);
//});

// Resource controllers
Route::resource('flights', 'FlightController', ['except' => ['create', 'edit']]);
Route::get('/flightsParcels','FlightController@parcels');


Route::resource('parcels', 'ParcelController', ['except' => ['create', 'edit']]);
Route::resource('addresses', 'AddressController', ['except' => ['create', 'edit']]);
Route::resource('customs', 'CustomsController', ['except' => ['create', 'edit']]);
Route::resource('delivery_types', 'DeliveryTypeController', ['except' => ['create', 'edit']]);
Route::resource('orders', 'OrderController', ['except' => ['create', 'edit']]);
Route::resource('parcel_checks', 'ParcelCheckController', ['except' => ['create', 'edit']]);
Route::resource('parcel_types', 'ParcelTypeController', ['except' => ['create', 'edit']]);
Route::resource('shipments', 'ShipmentController', ['except' => ['create', 'edit']]);
Route::resource('status', 'StatusController', ['except' => ['create', 'edit']]);
Route::resource('shipment_info', 'ShipmentInfoController', ['except' => ['create', 'edit']]);

Route::resource('orders.shipments', 'ShipmentController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.status', 'StatusController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.shipment_info', 'ShipmentInfoController', ['except' => ['create', 'edit']]);

Route::resource('orders.shipments.addresses', 'AddressController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.delivery_types', 'DeliveryTypeController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels', 'ParcelController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels.status', 'StatusController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels.customs', 'CustomsController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels.parcel_checks', 'ParcelCheckController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels.flights', 'FlightController', ['except' => ['create', 'edit']]);
Route::resource('orders.shipments.parcels.parcel_types', 'ParcelTypeController', ['except' => ['create', 'edit']]);
Route::resource('orders.customer', 'CustomerController', ['except' => ['create', 'edit']]);

Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);
Route::resource('businesses', 'BusinessController', ['except' => ['create', 'edit']]);
Route::resource('customers', 'CustomerController', ['except' => ['create', 'edit']]);
Route::resource('customers.customerpasswords', 'CustomerPasswordController', ['except' => ['create', 'edit']]);
Route::resource('customerpasswords', 'CustomerPasswordController', ['except' => ['create', 'edit']]);

Route::resource('tickets', 'TicketController', ['except' => ['create', 'edit']]);
Route::resource('tickets.ticket_categories', 'TicketCategoryController', ['except' => ['create', 'edit']]);
Route::resource('tickets.ticket_files', 'TicketFileController', ['except' => ['create', 'edit']]);
Route::resource('tickets.ticket_logs', 'TicketLogController', ['except' => ['create', 'edit']]);
Route::resource('tickets.ticket_states', 'TicketStateController', ['except' => ['create', 'edit']]);

Route::resource('ticket_categories', 'TicketCategoryController', ['except' => ['create', 'edit']]);
Route::resource('ticket_files', 'TicketFileController', ['except' => ['create', 'edit']]);
Route::resource('ticket_logs', 'TicketLogController', ['except' => ['create', 'edit']]);
Route::resource('ticket_states', 'TicketStateController', ['except' => ['create', 'edit']]);

Route::resource('employees','EmployeeController', ['except' => ['create', 'edit']]);
Route::resource('absences','AbsenceController', ['except' => ['create', 'edit']]);
Route::resource('benefits', 'BenefitController', ['except' => ['create', 'edit']]);
Route::resource('jobs', 'JobController', ['except' => ['create', 'edit']]);
Route::resource('jobDescriptions', 'JobDescriptionController', ['except' => ['create', 'edit']]);
Route::resource('jobOffers', 'JobOfferController', ['except' => ['create', 'edit']]);
Route::resource('departments', 'DepartmentController', ['except' => ['create', 'edit']]);

Route::resource('employees.jobs','JobController', ['except' => ['create', 'edit']]);
Route::resource('employees.absences', 'AbsenceController', ['except' => ['create', 'edit']]);
Route::resource('faq', 'FaqController', ['except' => ['create', 'edit']]);
Route::resource('timesheet', 'TimesheetController', ['except' => ['create', 'edit']]);
