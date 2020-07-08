<?php

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



Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home');



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::get('/admin','DashboardController@index')->middleware('admin');
Route::get('/admin/create_seeker','DashboardController@createSeeker')->middleware('admin');
Route::get('/admin/create_employer','DashboardController@createEmployer')->middleware('admin');
Route::get('/admin/users','DashboardController@users')->middleware('admin');

Route::get('/admin/category/create','DashboardController@createCategory')->middleware('admin');
Route::post('/admin/category/store','DashboardController@storeCategory')->name('category.store')->middleware('admin');

Route::get('/admin/categories','DashboardController@categories')->middleware('admin');
Route::post('/admin/category/delete','DashboardController@deleteCategory')->name('category.delete')->middleware('admin');
Route::get('/admin/category/edit/{id}','DashboardController@editCategory')->name('category.edit')->middleware('admin');
Route::post('/admin/category/update/{id}','DashboardController@updateCategory')->name('category.update')->middleware('admin');



Route::get('/admin/blog/create','DashboardController@create')->middleware('admin');
Route::post('/admin/blog/store','DashboardController@store')->name('blog.store')->middleware('admin');
Route::get('/admin/blogs','DashboardController@blogs')->middleware('admin');
Route::post('/admin/blog/delete','DashboardController@destroy')->name('blog.delete')->middleware('admin');
Route::get('/admin/blog/edit/{id}','DashboardController@edit')->name('blog.edit')->middleware('admin');
Route::post('/admin/blog/update/{id}','DashboardController@update')->name('blog.update')->middleware('admin');
Route::get('/admin/blogs/bin','DashboardController@bin')->name('blog.bin')->middleware('admin');
Route::get('/admin/blog/{id}/restore','DashboardController@restore')->name('blog.restore')->middleware('admin');
Route::get('/admin/blog/{id}/change-status','DashboardController@changeStatus')->name('change.status')->middleware('admin');

// show single blog
Route::get('/admin/blog/{id}/','DashboardController@showBlog')->name('blog.show');
Route::get('/admin/jobs/','DashboardController@jobs')->name('admin.jobs');
Route::get('/admin/job/application','DashboardController@applications')->name('job.application');


/*
|--------------------------------------------------------------------------
| Company Routes
|--------------------------------------------------------------------------
*/





Route::group(['prefix'=>'company'],function(){
    
    //To view company registration template
    Route::view('/registration','auth.register_company');
    // To Store Company registration details
    Route::post('/registration','Auth\EmployerController@register_employer')->name('company.register');
    // To view company profile
    Route::get('/profile','CompanyController@profile')->name('company.profile');
    // To update company common details
    Route::post('/update','CompanyController@update')->name('company.update');
    // to update comapny cover image
    Route::post('/update/cover','CompanyController@update_cover')->name('cover_image.update');
    // To update company logo
    Route::post('/update/logo','CompanyController@logo_update')->name('logo.update');
    // To show single company page
    Route::get('/{id}/{company}','CompanyController@show')->name('company.show');
    
    
});

// Route::get()

/*
|--------------------------------------------------------------------------
| Job Seeker profile Routes
|--------------------------------------------------------------------------
*/

Route:: get('/category/{id}','CategoryController@index')->name('category.index');


Route::group(['prefix' => 'user'], function () {
    
    Route::group(['prefix'=>'profile'],function(){
        // To view job seeker profile
        Route::get('/','UserProfileController@index')->name('seeker.profile');
        // To update job seeker common  details
        Route::post('/update','UserProfileController@store')->name('profile.update');
    });
    // To update job seeker cover letter
    Route::post('/cover','UserProfileController@coverupdate')->name('cover.update');
    // To update job seeker resume
    Route::post('/resume','UserProfileController@resumeupdate')->name('resume.update');
    // To update job seeker profile image
    Route::post('/update/profile/image','UserProfileController@profileImageUpdate')->name('pp.update');
    // To reset all data from profile
    Route::get('/reset','UserProfileController@reset')->name('account.reset');
    
});

/*
|--------------------------------------------------------------------------
| Job Routes
|--------------------------------------------------------------------------
*/

Route::get('/','JobController@index');
Route::group(['prefix'=>'jobs'],function(){

    
    Route::get('/create','JobController@create')->name('job.create');
    Route::get('/edit/{id}/{job}','JobController@edit')->name('job.edit');
    Route::post('/edit/{id}/{job}','JobController@update')->name('job.update');
    
    Route::post('/create/job','JobController@store')->name('job.store');
    // Route::get('/company-jobs','JobController@company_jobs')->name('company.jobs');
    // Fetch all jobs created by single company
    Route::get('/{id}/{job}','JobController@show')->name('job.show');

    Route::get('/company-jobs',function(){
        
        $jobs = App\Job::where('user_id',Auth()->user()->id)->get();

        return view('jobs.companyjobs',compact('jobs'));
    
    })->name('company.jobs');
            

        Route::post('/apply/{id}/{job}','JobController@apply')->name('apply');
        Route::get('/applications','JobController@applications')->name('applications');
        // Fecth all jobs
        Route::get('/','JobController@jobs')->name('jobs');

        // Wish list
        Route::post('/wish/{id}','WishController@wish')->name('wish');
        Route::post('/unwish/{id}','WishController@unwish')->name('unwish');

        Route::get('/search','JobController@search');



});



