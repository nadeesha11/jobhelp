<?php

use App\Http\Controllers\admin\adminAuthController;
use App\Http\Controllers\admin\adsManagementController;
use App\Http\Controllers\admin\adsTypesController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\dashBoardController;
use App\Http\Controllers\admin\modelController;
use App\Http\Controllers\admin\packageController;
use App\Http\Controllers\admin\subCategoryController;
use App\Http\Controllers\admin\subCategoryTypes;
use App\Http\Controllers\adminManagementController;
use App\Http\Controllers\categoryBrandsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\web\AdController;
use App\Http\Controllers\web\contactUsController;
use App\Http\Controllers\web\homeController;
use App\Http\Controllers\web\mainAdsDisplayController;
use App\Http\Controllers\web\mainFilterController;
use App\Http\Controllers\web\paymentController;
use App\Http\Controllers\web\userAuthController;
use App\Http\Controllers\web\vendorDashBoardController;
use Illuminate\Support\Facades\Route;

Route::get('/web/sms/', [userAuthController::class, 'sms'])->name('web.sms'); // websms
Route::get('locale/{lange}', [LocalizationController::class, 'setLang']); //change lang
Route::get('/carrosal', [homeController::class, 'test'])->name('web.carrosal'); // web home

//display main ads 
Route::get('/ads/{id}', [mainAdsDisplayController::class, 'index'])->name('ads.displaymain.ads'); // display main ads with filter
Route::get('/ads/detailed/electronic{id}', [mainAdsDisplayController::class, 'detailedElectronic'])->name('web.dashboard.electronic.detailed'); // display main ads with detailed electronic
Route::get('/ads/detailed/vehicle{id}', [mainAdsDisplayController::class, 'detailedVehicle'])->name('web.dashboard.vehicle.detailed'); // display main ads with detailed vehicle
Route::get('/ads/detailed/property{id}', [mainAdsDisplayController::class, 'detailedProperty'])->name('web.dashboard.property.detailed'); // display main ads with detailed property
Route::get('/ads/detailed/service{id}', [mainAdsDisplayController::class, 'detailedService'])->name('web.dashboard.service.detailed'); // display main ads with detailed service
Route::get('/ads/detailed/jobs{id}', [mainAdsDisplayController::class, 'detailedJobs'])->name('web.dashboard.jobs.detailed'); // display main ads with detailed jobs
Route::get('/ads/detailed/education{id}', [mainAdsDisplayController::class, 'detailedEducation'])->name('web.dashboard.education.detailed'); // display main ads with detailed education

//main filters for electronics
Route::get('/ads/electronics/filter/{id}', [mainFilterController::class, 'electronics'])->name('web.electronics.filters'); // display filter page electronics
Route::post('/ads/electronics/filterd', [mainFilterController::class, 'electronicsFilterdRedirect'])->name('electronics.filterdAds'); // redirect filterd ads
Route::get('/electronics/filterd/ads', [mainFilterController::class, 'electronicsFilterdDisplay'])->name('electronics.filterd.ads'); // filterd ads in electronics

//main filters for vehicles
Route::get('/ads/vehicles/filter/{id}', [mainFilterController::class, 'vehicles'])->name('web.vehicles.filters'); // display filter page vehicles
Route::post('/ads/vehicles/filterd', [mainFilterController::class, 'vehiclesFilterdRedirect'])->name('vehicles.filterdAds'); // redirect filterd ads
Route::get('/vehicles/filterd/ads', [mainFilterController::class, 'vehiclesFilterdDisplay'])->name('vehicles.filterd.ads'); // filterd ads in vehicles

//main filters for property
Route::get('/ads/property/filter/{id}', [mainFilterController::class, 'property'])->name('web.property.filters'); // display filter page property
Route::post('/ads/property/filterd', [mainFilterController::class, 'propertyFilterdRedirect'])->name('property.filterdAds'); // redirect filterd ads
Route::get('/property/filterd/ads', [mainFilterController::class, 'propertyFilterdDisplay'])->name('property.filterd.ads'); // filterd ads in property

//main filters for service
Route::get('/ads/service/filter/{id}', [mainFilterController::class, 'service'])->name('web.service.filters'); // display filter page filters
Route::post('/ads/service/filterd', [mainFilterController::class, 'serviceFilterdRedirect'])->name('service.filterdAds'); // redirect filterd ads

// service.filterdAds

// web.dashboard.education.detailed
Route::get('/', [homeController::class, 'index'])->name('web.index'); // web home 
Route::get('/web/userForm', [userAuthController::class, 'userForm'])->name('web.userForm'); // web login register page for venders
Route::post('/web/registerByOtp', [userAuthController::class, 'registerOTP'])->name('web.registerByOtp'); // to register and login venders and send otps
Route::post('/web/checkOtp', [userAuthController::class, 'checkOTP'])->name('web.checkOtp'); // to register and login venders and send otps

// socialite routes 
Route::get('/google', [userAuthController::class, 'redirectGoogle'])->name('google'); // google auth 
Route::get('/auth/google/call-back', [userAuthController::class, 'callbackGoogle'])->name('google-call-back'); // google auth 

Route::get('/facebook', [userAuthController::class, 'redirectFacebook'])->name('facebook'); // google auth 
Route::get('/auth/facebook/call-back', [userAuthController::class, 'callbackFacebook'])->name('facebook-call-back'); // facebook auth 
// socialite routes 

Route::get('/web/contactus', [contactUsController::class, 'contactus'])->name('web.contactus'); // contact us view
Route::post('/web/contactus/sendMail', [contactUsController::class, 'sendMail'])->name('web.sendContactMail'); // to register and login venders and send otps

// need to use middleware for this route 
Route::group(['middleware' => ['vendorCheck']], function () {

    Route::get('/web/vendorDashboard/{id}', [vendorDashBoardController::class, 'index'])->name('web.vendordashboard'); // display vendor dash board
    Route::get('web/dashboard/{id}/getSubCategory', [vendorDashBoardController::class, 'getSubCategory'])->name('web.getSubCategory'); // get Subcategory
    Route::get('web/dashboard/createPost{id}', [vendorDashBoardController::class, 'createPost'])->name('web.vendordashboard.createPost'); //create post
    Route::get('web/dashboard/setting/{selectedlocation}', [vendorDashBoardController::class, 'getSubLocation'])->name('web.vendordashboard.getSubLocation'); //get sub location
    Route::post('web/dashboard/setting/create', [vendorDashBoardController::class, 'update'])->name('web.dashboard.setting.create'); // save vendor data

    Route::get('web/dashboard/getModels/{brands}', [vendorDashBoardController::class, 'getModels'])->name('web.dashboard.getModels'); // get brands

    Route::post('web/dashboard/electronic/create', [AdController::class, 'create_electronic'])->name('web.dashboard.electronic.create'); // create electronic ad
    Route::post('web/dashboard/vehicle/create', [AdController::class, 'create_vehicle'])->name('web.dashboard.vehicle.create'); // create vehicle ad
    Route::post('web/dashboard/education/create', [AdController::class, 'create_education'])->name('web.dashboard.education.create'); // create education ad 
    Route::post('web/dashboard/service/create', [AdController::class, 'create_service'])->name('web.dashboard.service.create'); // create service ad 
    Route::post('web/dashboard/job/create', [AdController::class, 'create_jobs'])->name('web.dashboard.jobs.create'); // create jobs ad 
    Route::post('web/dashboard/property/create', [AdController::class, 'create_property'])->name('web.dashboard.property.create'); // create property ad 

    Route::get('web/dashboard/freeAds/package/{inserted_ad}', [AdController::class, 'ads_type_for_free_ads'])->name('web.dashboard.freeAds.package');
    Route::post('web/payment/free', [paymentController::class, 'freeAds'])->name('freeads.payment'); // create payment post free
    Route::post('web/dashboard/payedAds/package', [AdController::class, 'ads_type_for_payed_ads'])->name('web.dashboard.payedAds.package'); // free ad direct pay
    Route::post('web/payment/pay', [paymentController::class, 'payedAds'])->name('payed.ads.directpay'); // create payment post payed

    Route::post('web/payment/successFreePay', [paymentController::class, 'successFreePay'])->name('web.dashboard.successFreePay'); // send ajax payment data for free ads
    Route::post('web/payment/successPayAds', [paymentController::class, 'successPayAds'])->name('web.dashboard.successPayAds'); // send ajax payment data for pay ads
});

Route::get('/web/vendor/logout', [userAuthController::class, 'logout'])->name('web.vendor.logout'); // vendor logout

// web routes end 

//backend routes start
Route::get('/admin/index', [adminAuthController::class, 'index'])->name('admin.index'); // admin view
Route::post('/admin/login', [adminAuthController::class, 'authCheck'])->name('admin.login'); // to admin form data

Route::group(['middleware' => ['adminCheck']], function () {

    Route::get('/admin/dashboard', [dashBoardController::class, 'dashboard'])->name('admin.dashboard'); // admin dashboard
    Route::get('/admin/adminManagement', [adminManagementController::class, 'adminManagement'])->name('admin.adminManagement'); //display admin management
    Route::post('/admin/create', [adminManagementController::class, 'create_admin'])->name('admin.create_admin'); // to admin form data
    Route::get('/admin/listAdmin', [adminManagementController::class, 'recieveadmin'])->name('admin.recieveAdmin'); //display admin list
    Route::get('admin/{id}/delete', [adminManagementController::class, 'deleteAdmin'])->name('admin.deleteAdmin'); //delete admin
    Route::get('admin/logout', [adminAuthController::class, 'logout'])->name('admin.logout'); //logout admin

    Route::get('/admin/packages', [packageController::class, 'index'])->name('admin.packages.index'); // view packages
    Route::post('/admin/packages/create', [packageController::class, 'create'])->name('admin.packages.create'); // create packages
    Route::get('/admin/recievePackages', [packageController::class, 'recievePackages'])->name('admin.recievePackages'); //display package management
    Route::get('admin/package/{id}/editData', [packageController::class, 'getEditPackages'])->name('admin.getEditPackages'); //get edit data package management
    Route::post('/admin/packages/update', [packageController::class, 'update'])->name('admin.package.update'); // update package
    Route::get('admin/package/{id}/delete', [packageController::class, 'delete'])->name('admin.package.delete'); // delete package

    Route::get('/admin/ads/management', [adsManagementController::class, 'index'])->name('admin.ads.management'); // ads management
    Route::get('/admin/ads/management/recieveData', [adsManagementController::class, 'recieveData'])->name('admin.adsManagement.recieveData'); // ads management recieveData
    Route::get('/admin/adsmanagement/{id}/index/detailed', [adsManagementController::class, 'detailed'])->name('admin.adsManagement.detailed'); // ads management detailed
    Route::get('/admin/adsManagement/{id}/detailed', [adsManagementController::class, 'more'])->name('admin.adsManagement.more'); // ads management detailed ajax
    Route::post('/admin/adManagement/update/status', [adsManagementController::class, 'updateStatus'])->name('admin.adManagement.update.status'); // update admanagement


    Route::get('admin/adsType/{id}', [adsTypesController::class, 'index'])->name('admin.adsType'); // access ads types
    Route::post('admin/adsType/create', [adsTypesController::class, 'create'])->name('admin.ad_type.create'); // create ads types
    Route::get('admin/display_ads_types/{id}', [adsTypesController::class, 'getAjaxDetails'])->name('admin.adsType.display'); // display ads types
    Route::get('admin/ad_type/{id}/delete', [adsTypesController::class, 'delete'])->name('admin.adsType.delete'); // display ads types delete 
    Route::get('admin/ads_types/{id}/edit', [adsTypesController::class, 'edit'])->name('admin.adsType.edit'); // display ads types in edit modal 
    Route::post('admin/adsType/update', [adsTypesController::class, 'update'])->name('admin.ads_types.update'); // update ads types

    Route::get('/admin/category/index', [categoryController::class, 'index'])->name('admin.category.index'); // view category
    Route::post('/admin/category/create', [categoryController::class, 'create_category'])->name('admin.category.create'); // add  category
    Route::get('/admin/category/getData', [categoryController::class, 'getData'])->name('admin.category.recieveData'); // view category data
    Route::get('admin/category/{id}/more', [categoryController::class, 'moreData'])->name('admin.category.more'); // more category data
    Route::get('admin/category/{id}/delete', [categoryController::class, 'delete'])->name('admin.category.delete'); // delete category data
    Route::get('admin/category/{id}/edit', [categoryController::class, 'edit'])->name('admin.category.edit'); // edit category data
    Route::post('/admin/category/update', [categoryController::class, 'update'])->name('admin.category.update'); // update  category

    Route::get('admin/subcategory/{id}/index', [subCategoryController::class, 'index'])->name('admin.subcategory.index'); // view subcategory
    Route::post('admin/subcategory/create', [subCategoryController::class, 'create'])->name('admin.subcategory.create'); // create subcategory
    Route::get('admin/subcategory/{id}', [subCategoryController::class, 'getData'])->name('admin.subcategory.recieveData'); // view subcategory data
    Route::get('admin/subcategory/{id}/more', [subCategoryController::class, 'more'])->name('admin.subcategory.more'); // view more subcategory data
    Route::get('admin/subcategory/{id}/edit', [subCategoryController::class, 'edit'])->name('admin.subcategory.edit'); // edit subcategory data
    Route::post('admin/subcategory/update', [subCategoryController::class, 'update'])->name('admin.subcategory.update'); // update subcategory
    Route::get('admin/subcategory/{id}/delete', [subCategoryController::class, 'delete'])->name('admin.subcategory.delete'); // delete subcategory data

    Route::get('admin/subcategoryTypes/{id}/index', [subCategoryTypes::class, 'index'])->name('admin.subcategorytypes.index'); // subcategory types index
    Route::post('admin/subcategoryTypes/create', [subCategoryTypes::class, 'create'])->name('admin.subcategoryTypes.create'); // create subcategory types
    Route::get('admin/subcategoryTypes/{id}', [subCategoryTypes::class, 'getData'])->name('admin.subcategorytypes.recieveData'); // view subcategory types data
    Route::get('admin/subcategoryTypes/{id}/edit', [subCategoryTypes::class, 'edit'])->name('admin.subcategorytypes.edit'); // view subcategory edit data
    Route::post('admin/subcategoryTypes/update', [subCategoryTypes::class, 'update'])->name('admin.subcategoryTypes.update'); // update subcategory types
    Route::get('admin/subcategoryTypes/{id}/delete', [subCategoryTypes::class, 'delete'])->name('admin.subcategorytypes.delete'); // delete subcategory data

    Route::get('admin/subcategory/brands/{id}/index', [categoryBrandsController::class, 'index'])->name('admin.subcategorybrands.index'); // view subcategory brands data
    Route::post('admin/subcategory/brands/create', [categoryBrandsController::class, 'create'])->name('admin.subcategoryBrands.create'); // create subcategory brands
    Route::get('admin/subcategoryBrands/getData/{id}', [categoryBrandsController::class, 'getData'])->name('admin.subcategorybrands.getData'); // get subcategory brands data ajax
    Route::get('admin/subcategoryBrand/{id}/delete', [categoryBrandsController::class, 'delete'])->name('admin.subcategorybrands.delete'); // subcategory brands delete
    Route::get('admin/subcategoryBrand/{id}/edit', [categoryBrandsController::class, 'edit'])->name('admin.subcategorybrands.edit'); // subcategory brands edit
    Route::post('admin/subcategory/brands/update', [categoryBrandsController::class, 'update'])->name('admin.subcategoryBrand.update'); // update sub cat brand

    Route::get('admin/subcategoryTypesModel/{id}/index', [modelController::class, 'index'])->name('admin.subcategorymodel.index'); // view subcategory brands data
    Route::post('admin/subcategoryTypesModel/create', [modelController::class, 'create'])->name('admin.subcategoryBrandModel.create'); // create subcategory models
    Route::get('admin/BrandModels/getData/{id}', [modelController::class, 'getData'])->name('admin.subcategorymodel.getData'); // view subcategory models data
    Route::get('admin/Brand/Model/{id}/delete', [modelController::class, 'delete'])->name('admin.subcategorymodel.delete'); // delete model
    Route::get('admin/subCategory/brands/model/{id}/edit', [modelController::class, 'edit'])->name('admin.subcategorymodel.edit'); // delete model
    Route::post('admin/subcategoryTypesModel/update', [modelController::class, 'update'])->name('admin.subcategorymodel.update'); // update model

});
//backend routes end
