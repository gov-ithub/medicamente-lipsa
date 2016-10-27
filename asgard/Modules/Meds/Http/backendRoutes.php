<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/meds'], function (Router $router) {
    $router->bind('med', function ($id) {
        return app('Modules\Meds\Repositories\MedRepository')->find($id);
    });
    $router->get('meds', [
        'as' => 'admin.meds.med.index',
        'uses' => 'MedController@index',
        'middleware' => 'can:meds.meds.index'
    ]);
    $router->get('meds/create', [
        'as' => 'admin.meds.med.create',
        'uses' => 'MedController@create',
        'middleware' => 'can:meds.meds.create'
    ]);
    $router->post('meds', [
        'as' => 'admin.meds.med.store',
        'uses' => 'MedController@store',
        'middleware' => 'can:meds.meds.store'
    ]);
    $router->get('meds/{med}/edit', [
        'as' => 'admin.meds.med.edit',
        'uses' => 'MedController@edit',
        'middleware' => 'can:meds.meds.edit'
    ]);
    $router->put('meds/{med}', [
        'as' => 'admin.meds.med.update',
        'uses' => 'MedController@update',
        'middleware' => 'can:meds.meds.update'
    ]);
    $router->delete('meds/{med}', [
        'as' => 'admin.meds.med.destroy',
        'uses' => 'MedController@destroy',
        'middleware' => 'can:meds.meds.destroy'
    ]);
    $router->bind('patient', function ($id) {
        return app('Modules\Meds\Repositories\PatientRepository')->find($id);
    });
    $router->get('patients', [
        'as' => 'admin.meds.patient.index',
        'uses' => 'PatientController@index',
        'middleware' => 'can:meds.patients.index'
    ]);
    $router->get('patients/create', [
        'as' => 'admin.meds.patient.create',
        'uses' => 'PatientController@create',
        'middleware' => 'can:meds.patients.create'
    ]);
    $router->post('patients', [
        'as' => 'admin.meds.patient.store',
        'uses' => 'PatientController@store',
        'middleware' => 'can:meds.patients.store'
    ]);
    $router->get('patients/{patient}/edit', [
        'as' => 'admin.meds.patient.edit',
        'uses' => 'PatientController@edit',
        'middleware' => 'can:meds.patients.edit'
    ]);
    $router->get('patients/{patient}/reply', [
        'as' => 'admin.meds.patient.reply',
        'uses' => 'PatientController@reply',
        'middleware' => 'can:meds.patients.reply'
    ]);
    $router->put('patients/{patient}', [
        'as' => 'admin.meds.patient.update',
        'uses' => 'PatientController@update',
        'middleware' => 'can:meds.patients.update'
    ]);
    $router->delete('patients/{patient}', [
        'as' => 'admin.meds.patient.destroy',
        'uses' => 'PatientController@destroy',
        'middleware' => 'can:meds.patients.destroy'
    ]);
    $router->bind('contact', function ($id) {
        return app('Modules\Meds\Repositories\ContactRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.meds.contact.index',
        'uses' => 'ContactController@index',
        'middleware' => 'can:meds.contacts.index'
    ]);
    $router->get('contacts/create', [
        'as' => 'admin.meds.contact.create',
        'uses' => 'ContactController@create',
        'middleware' => 'can:meds.contacts.create'
    ]);
    $router->post('contacts', [
        'as' => 'admin.meds.contact.store',
        'uses' => 'ContactController@store',
        'middleware' => 'can:meds.contacts.store'
    ]);
    $router->get('contacts/{contact}/edit', [
        'as' => 'admin.meds.contact.edit',
        'uses' => 'ContactController@edit',
        'middleware' => 'can:meds.contacts.edit'
    ]);
    $router->put('contacts/{contact}', [
        'as' => 'admin.meds.contact.update',
        'uses' => 'ContactController@update',
        'middleware' => 'can:meds.contacts.update'
    ]);
    $router->delete('contacts/{contact}', [
        'as' => 'admin.meds.contact.destroy',
        'uses' => 'ContactController@destroy',
        'middleware' => 'can:meds.contacts.destroy'
    ]);
    $router->bind('recipe', function ($id) {
        return app('Modules\Meds\Repositories\RecipeRepository')->find($id);
    });
    $router->get('recipes', [
        'as' => 'admin.meds.recipe.index',
        'uses' => 'RecipeController@index',
        'middleware' => 'can:meds.recipes.index'
    ]);
    $router->get('recipes/create', [
        'as' => 'admin.meds.recipe.create',
        'uses' => 'RecipeController@create',
        'middleware' => 'can:meds.recipes.create'
    ]);
    $router->post('recipes', [
        'as' => 'admin.meds.recipe.store',
        'uses' => 'RecipeController@store',
        'middleware' => 'can:meds.recipes.store'
    ]);
    $router->get('recipes/{recipe}/edit', [
        'as' => 'admin.meds.recipe.edit',
        'uses' => 'RecipeController@edit',
        'middleware' => 'can:meds.recipes.edit'
    ]);
    $router->put('recipes/{recipe}', [
        'as' => 'admin.meds.recipe.update',
        'uses' => 'RecipeController@update',
        'middleware' => 'can:meds.recipes.update'
    ]);
    $router->delete('recipes/{recipe}', [
        'as' => 'admin.meds.recipe.destroy',
        'uses' => 'RecipeController@destroy',
        'middleware' => 'can:meds.recipes.destroy'
    ]);
    $router->bind('reply', function ($id) {
        return app('Modules\Meds\Repositories\ReplyRepository')->find($id);
    });
    $router->get('replies', [
        'as' => 'admin.meds.reply.index',
        'uses' => 'ReplyController@index',
        'middleware' => 'can:meds.replies.index'
    ]);
    $router->get('replies/create', [
        'as' => 'admin.meds.reply.create',
        'uses' => 'ReplyController@create',
        'middleware' => 'can:meds.replies.create'
    ]);
    $router->post('replies', [
        'as' => 'admin.meds.reply.store',
        'uses' => 'ReplyController@store',
        'middleware' => 'can:meds.replies.store'
    ]);
    $router->get('replies/{reply}/edit', [
        'as' => 'admin.meds.reply.edit',
        'uses' => 'ReplyController@edit',
        'middleware' => 'can:meds.replies.edit'
    ]);
    $router->put('replies/{reply}', [
        'as' => 'admin.meds.reply.update',
        'uses' => 'ReplyController@update',
        'middleware' => 'can:meds.replies.update'
    ]);
    $router->delete('replies/{reply}', [
        'as' => 'admin.meds.reply.destroy',
        'uses' => 'ReplyController@destroy',
        'middleware' => 'can:meds.replies.destroy'
    ]);
// append





});
