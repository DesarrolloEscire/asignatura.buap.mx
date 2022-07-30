<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/registrarse', App\Http\Livewire\Register::class)->name('register');
Route::post('/registrarse', App\Http\Controllers\Users\RegisterAccountController::class)->name('register.store');
Route::post('/solicitar-cuenta', \App\Http\Controllers\Users\RequestAccountController::class)->name('request-account');
Route::get('/users/{user}/verify', App\Http\Controllers\Verify::class)->name('users.verify');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/admin/subjects', App\Http\Livewire\Admin\Subjects\Index::class)->name('admin.subjects.index');

    Route::get('/dashboard', App\Http\Livewire\Dashboard::class)->name('dashboard');

    Route::get('/usuarios', App\Http\Livewire\Users\Index::class)->name('users.index');

    Route::get('/asignaturas', App\Http\Livewire\Subjects\Index::class)->name('subjects.index');
    Route::get('/asignaturas/{subject}/contenidos', App\Http\Livewire\Subjects\Contents\Show::class)->name('subjects.contents.show');
    Route::post('/asignaturas/{subject}/solicitar-publicacion', App\Http\Controllers\Subjects\RequestPublication::class)->name('subjects.request-publication');
    Route::post('/asignaturas/{subject}/aprobar', App\Http\Controllers\Subjects\Approve::class)->name('subjects.approve');
    Route::put('/asignaturas/{subject}/desaprobar', App\Http\Controllers\Subjects\Disapprove::class)->name('subjects.disapprove');
    Route::post('/asignaturas/{subject}/estrategias', App\Http\Controllers\Subjects\Strategies\Store::class)->name('subjects.strategies.store');
    Route::post('/asignaturas/{subject}/recursos', App\Http\Controllers\Subjects\Resources\Store::class)->name('subjects.resources.store');
    Route::post('/asignaturas/{subject}/ejes', App\Http\Controllers\Subjects\Axes\Store::class)->name('subjects.axes.store');
    Route::post('/asignaturas/{subject}/criterios', App\Http\Controllers\Subjects\Criteria\Store::class)->name('subjects.criteria.store');
    Route::post('/asignaturas/{subject}/actas', App\Http\Controllers\Subjects\Certificates\Store::class)->name('subjects.certificates.store');
    Route::post('/asignaturas/{subject}/unidades', App\Http\Controllers\Units\Store::class)->name('units.store');
    Route::post('/asignaturas/{subject}/perfiles-profesionales', App\Http\Controllers\Subjects\ProfessionalProfiles\Store::class)->name('subjects.professional-profiles.store');
    Route::post('/asignaturas/{subject}/colaboradores', App\Http\Controllers\Subjects\Collaborators\Store::class)->name('subjects.collaborators.store');
    Route::post('/asignaturas/{subject}/reviewers', App\Http\Controllers\Subjects\Reviewers\Store::class)->name('subjects.reviewers.store');
    Route::post('/asignaturas/{subject}/planeaciones', App\Http\Controllers\Subjects\Plannings\Store::class)->name('subjects.plannings.store');
    Route::get('/asignaturas/{subject}/informacion-general', App\Http\Livewire\Subjects\GeneralInformation\Show::class)->name('subjects.general-information.show');
    Route::get('/asignaturas/{subject}/acta-aprobacion', App\Http\Livewire\Subjects\ValidationCertificates\Show::class)->name('subjects.validation-certificates.show');
    Route::get('/asignaturas/{subject}/docentes', App\Http\Livewire\Subjects\Teachers\Show::class)->name('subjects.teachers.show');
    Route::get('/asignaturas/{subject}/contenidos', App\Http\Livewire\Subjects\Contents\Show::class)->name('subjects.contents.show');
    Route::put('/asignaturas/{subject}/proposito', App\Http\Controllers\Subjects\Purpose\Update::class)->name('subjects.purpose.update');
    Route::put('/asignaturas/{subject}/actualizar-status', App\Http\Controllers\Subjects\UpdateStatus::class)->name('subjects.update-status');
    Route::put('/asignaturas/{subject}/competencias', App\Http\Controllers\Subjects\Competences\Attach::class)->name('subjects.competences.attach');
    Route::get('/asignaturas/{subject}/unidades/crear', App\Http\Livewire\Units\Create::class)->name('units.create');
    Route::get('/asignaturas/{subject}/pdf', App\Http\Controllers\Subjects\EducationalPrograms\PDF::class)->name('subjects.pdf');
    Route::get('/asignaturas/{subject}/planeaciones', App\Http\Livewire\Subjects\Plannings\Index::class)->name('subjects.plannings.index');
    Route::put('/asignaturas/{subject}/unidades-de-competencia', App\Http\Controllers\Subjects\CompetenceUnits\Attach::class)->name('subjects.competence-units.attach');
    
    Route::get('/competencias/{competence}/unidades-de-competencias', App\Http\Livewire\Competences\CompetenceUnits\Index::class)->name('competences.competence-units.index');
    Route::put('unidades-de-competencias/{competenceUnit}/', App\Http\Controllers\Competences\CompetenceUnits\Update::class)->name('competences.competence-units.update');
    Route::delete('unidades-de-competencias/{competenceUnit}/', App\Http\Controllers\Competences\CompetenceUnits\Delete::class)->name('competence-units.delete');
    Route::post('/competencias/{competence}/unidades-de-competencias', App\Http\Controllers\Competences\CompetenceUnits\Store::class)->name('competences.competence-units.store');

    Route::get('/mis-planeaciones', App\Http\Livewire\MyPlannings\Index::class)->name('my-plannings.index');
    Route::get('/mis-asignaturas', App\Http\Livewire\MySubjects\Index::class)->name('my-subjects.index');

    Route::get('programas-asignatura', App\Http\Livewire\SubjectPrograms\Index::class)->name('subject-programs.index');
    Route::get('programas-asignatura/{educationalProgram}', App\Http\Livewire\SubjectPrograms\Show::class)->name('subject-programs.show');
    Route::get('programas-asignatura/{subjectProgram}/pdf', App\Http\Controllers\Subjects\SubjectPrograms\PDF::class)->name('subject-programs.pdf');
    Route::post('programas-educativos/{educationalProgram}/competencias', App\Http\Controllers\EducationalPrograms\Competences\Store::class)->name('educational-programs.competences.store');

    Route::get('planeaciones', App\Http\Livewire\Plannings\Index::class)->name('plannings.index');
    Route::get('planeaciones/{planning}', App\Http\Livewire\Plannings\Show::class)->name('plannings.show');
    Route::delete('planeaciones/{planning}', App\Http\Controllers\Plannings\Delete::class)->name('plannings.delete');
    Route::post('planeaciones/{planning}/despublicar', App\Http\Controllers\Plannings\Unpublish::class)->name('plannings.unpublish');
    Route::post('planeaciones/{planning}/publicar', App\Http\Controllers\Plannings\Publish::class)->name('plannings.publish');
    Route::get('planeaciones/{planning}/subtemas/{subtopic}', App\Http\Livewire\Subtopics\Show::class)->name('plannings.subtopics.show');
    Route::put('planeaciones/{planning}/subtemas/{subtopic}/actividad', App\Http\Controllers\Subtopics\Activity\Update::class)->name('plannings.subtopics.activity.update');
    Route::put('planeaciones/{planning}/subtemas/{subtopic}/horas', App\Http\Controllers\Plannings\Subtopics\Hours\Update::class)->name('plannings.subtopics.hours.update');
    Route::get('planeaciones/{planning}/unidades/{unit}', App\Http\Livewire\Plannings\Units\Show::class)->name('plannings.units.show');
    Route::put('planeaciones/{planning}/usuarios/{user}/desvincular', App\Http\Controllers\Plannings\Users\Detach::class)->name('plannings.users.detach');
    Route::post('planeaciones/{planning}/ecaas', App\Http\Controllers\Plannings\Ecaas\Store::class)->name('plannings.ecaas.store');
    Route::put('planeaciones/{planning}/usuarios', App\Http\Controllers\Plannings\Users\Attach::class)->name('plannings.users.attach');
    Route::get('planeaciones/{planning}/pdf', App\Http\Controllers\Plannings\PDF::class)->name('plannings.pdf');
    Route::put('planeaciones/{planning}/subtemas/{subtopic}/materials', App\Http\Controllers\Plannings\Subtopics\Materials\Update::class)->name('plannings.subtopics.materials.update');
    Route::put('planeaciones/{planning}/subtemas/{subtopic}/unidades-de-competencia', App\Http\Controllers\Subtopic\CompetenceUnits\Attach::class)->name('plannings.subtopics.competence-units.attach');
    Route::get('planeaciones/{planning}/temas/{topic}', App\Http\Livewire\Plannings\Topics\Show::class)->name('plannings.topics.show');
    Route::put('planeaciones/{planning}/temas/{topic}/unidades-de-competencia', App\Http\Controllers\Topics\CompetenceUnits\Attach::class)->name('plannings.topics.competence-units.attach');
    Route::put('planeaciones/{planning}/temas/{topic}/materiales', App\Http\Controllers\Topics\Materials\Update::class)->name('plannings.topics.materials.update');
    Route::put('planeaciones/{planning}/units/{unit}/instrumentos', App\Http\Controllers\Plannings\Units\Instruments\Attach::class)->name('plannings.units.instruments.attach');
    Route::put('planeaciones/{planning}/temas/{topic}/horas', App\Http\Controllers\Plannings\Topics\Hours\Update::class)->name('contents.hours.update');
    Route::put('planeaciones/{planning}/temas/{topic}/actividad', App\Http\Controllers\Topics\Activity\Update::class)->name('plannings.topics.activity.update');
    Route::put('planeaciones/{planning}/unidades/{unit}/competencias', App\Http\Controllers\Plannings\Units\Competences\Attach::class)->name('plannings.units.competences.attach');
    Route::put('planeaciones/{planning}/unidades/{unit}/estrategias', App\Http\Controllers\Plannings\Units\Strategies\Attach::class)->name('plannings.units.strategies.attach');
    Route::put('planeaciones/{planning}/unidades/{unit}/evidencias', App\Http\Controllers\Plannings\Units\Evidences\Attach::class)->name('plannings.units.evidences.attach');
    Route::put('planeaciones/{planning}/unidades/{unit}/ponderacion', App\Http\Controllers\Plannings\Units\Weighing\Update::class)->name('plannings.units.weighing.update');
    Route::put('planeaciones/{planning}/unidades/{unit}/recursos', App\Http\Controllers\Plannings\Units\Resources\Attach::class)->name('plannings.units.resources.attach');

    Route::get('/certificados/{certificate}', App\Http\Controllers\Certificates\Download::class)->name('certificates.download');
    
    Route::get('/educacion-continua', App\Http\Livewire\ContinuingEducation\Show::class)->name('continuing-education.show');

    Route::get('/unidades', App\Http\Livewire\Units\Index::class)->name('units.index');
    Route::put('/unidades/{unit}', App\Http\Controllers\Units\Update::class)->name('units.update');
    Route::get('/unidades/{unit}', App\Http\Livewire\Units\Show::class)->name('units.show');
    Route::delete('/unidades/{unit}', App\Http\Controllers\Units\Delete::class)->name('units.delete');
    
    Route::get('/unidades-academicas/{academicUnit}/asignaturas', App\Http\Livewire\AcademicUnits\Subjects\Index::class)->name('academic-units.subjects.index');
    Route::get('/unidades-academicas/{academicUnit}/planeaciones', App\Http\Livewire\AcademicUnits\Plannings\Index::class)->name('academic-units.plannings.index');
    
    Route::post('/opiniones', App\Http\Controllers\Opinions\Store::class)->name('opinions.store');

    Route::get('/platforms/rea', function (Request $request) {
        return redirect()->away(external_route($request->route, $request->params));
    })->name('platforms.rea');

    Route::get('/reportes/asignaturas/aprobadas',App\Http\Livewire\Reports\ApprovedSubjects::class)->name('reports.subjects.approved');
    Route::post('/reportes/asignaturas/aprobadas',App\Http\Controllers\Reports\ApprovedSubjects::class)->name('reports.subjects.approved');
});

Route::get('redirect', function (Request $request) {
    return redirect()->route($request->route);
})->name('redirect');