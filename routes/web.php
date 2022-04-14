<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\FormulerController;
use \App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\InteractionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/formLogin',[VisiteurController::class,'getLogin']);

Route::post('/login',[VisiteurController::class,'signIn']);

Route::get('/getLogout',[VisiteurController::class,'signOut']);


Route::get('/listerMedicament',[MedicamentController::class,'listerMedicament']);
Route::get('/listerFormule/{id}', [FormulerController::class,'listerFormule']);
Route::get('/listerPreciption/{id}', [PrescriptionController::class,'listerPreciption']);
Route::get('/listeInteraction/{id_medicament}', [InteractionController::class, 'getInteraction']);

Route::get('/affichageAjoutFormulation/{id_medicament}', [FormulerController::class, 'affichageAjoutFormulation']);
Route::post('/ajouterLaFormulation', [FormulerController::class, 'ajouterLaFormulation']);
Route::get('/surpprimerFormule/{idmedoc}/{idpresntation}',[FormulerController::class,'surpprimerFormule']);
Route::get('/updateFormulation/{id}/{id2}',[FormulerController::class,'updateFormulation']);
Route::post('/updateLaFormulation',[FormulerController::class,'updateLaformulation']);

Route::get('/affichageAjoutPrescription/{id_medicament}', [PrescriptionController::class, 'affichageAjoutPrescription']);
Route::post('/ajouterLaPrescription', [PrescriptionController::class, 'ajouterLaPrescription']);
Route::get('/surpprimerPrescription/{id_medicament}/{id_dosage}/{id_type_individu}/', [PrescriptionController::class, 'supprimerPrescription']);
Route::get('/modifPrescription/{id_medicament}/{id_dosage}/{id_type_individu}/', [PrescriptionController::class, 'modifPrescription']);
Route::post('/modifierLaPrescription',[PrescriptionController::class,'modifierLaPrescription']);

Route::get('/ajoutinteraction/{id_medicament}', [InteractionController::class, 'ajoutinteraction']);
Route::post('/ajouterLaInteraction', [InteractionController::class, 'ajouterLaInteraction']);
Route::get('/supprimerInteraction/{id_medicament}/{med_id_medicament}/', [InteractionController::class, 'supprimerInteraction']);
Route::get('/modifInteractions/{id_medicament}/{med_id_medicament}', [InteractionController::class, 'modifInteractions']);
Route::post('/modifierLaInteraction', [InteractionController::class, 'modifierLaInteraction']);
