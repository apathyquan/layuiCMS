<?php


Route::get('', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('backend.login');
Route::middleware(['auth:backend', 'reject_empty_value'])->group(function () {
    Route::get('index', 'IndexController@index')->name('backend.index');
    Route::get('home', 'IndexController@home')->name('backend.home');
    Route::get('menu', 'AdminController@menu');
    Route::get('logout', 'LoginController@logout')->name('backend.logout');
    Route::get('login/record', 'LoginRecordController@listData')->name('login.record.data');
    //管理员模块
    Route::prefix('admin')->group(function () {
        // 管理员
        Route::post('upload', 'AdminController@uploadImg')->name('admin.upload');
        Route::get('', 'AdminController@index')->name('admin.list');
        Route::get('listData', 'AdminController@listData')->name('admin.data');
        Route::get('add', 'AdminController@add')->name('admin.add');
        Route::get('edit', 'AdminController@edit')->name('admin.edit');
        Route::get('edit/{id}', 'AdminController@editData');
        Route::get('editpwd', 'AdminController@editPWD')->name('admin.editpwd');
        Route::post('add', 'AdminController@addStore')->name('admin.addPost');
        Route::get('impower', 'AdminController@impower')->name('admin.impower');
        Route::get('impower/data', 'AdminController@impowerData')->name('admin.impower.data');
        Route::get('impower/role/{id}', 'AdminController@getRole')->name('admin.role');
        Route::patch('impower/{id}', 'AdminController@impowerStore');
        Route::patch('edit/{id}', 'AdminController@editStore');
        Route::patch('editpwd/{id}', 'AdminController@editPWDStore');
        Route::delete('delete', 'AdminController@delete')->name('admin.delete');
    });
    //角色
    Route::prefix('role')->group(function () {
        Route::get('', 'RoleController@index')->name('role.index');
        Route::get('listData', 'RoleController@listData')->name('role.data');
        Route::get('add', 'RoleController@add')->name('role.add');
        Route::get('edit', 'RoleController@edit')->name('role.edit');
        Route::get('impower', 'RoleController@impower')->name('role.impower');
        Route::get('edit/{id}', 'RoleController@editData');
        Route::post('add', 'RoleController@addStore')->name('role.addPost');
        Route::get('impower/data/{id}', 'RoleController@impowerData');
        Route::patch('edit/{id}', 'RoleController@editStore');
        Route::patch('impower/{id}', 'RoleController@impowerStore');
        Route::delete('delete', 'RoleController@delete')->name('role.delete');
    });
    //权限
    Route::prefix('permission')->group(function () {
        Route::get('', 'PermissionController@index');
        Route::get('listData', 'PermissionController@listData')->name('permission.data');
        Route::get('add', 'PermissionController@add')->name('permission.add');
        Route::get('edit', 'PermissionController@edit')->name('permission.edit');
        Route::post('add', 'PermissionController@addStore')->name('permission.addPost');
        Route::get('edit/{id}', 'PermissionController@editData');
        Route::patch('edit/{id}', 'PermissionController@editStore');
        Route::delete('delete', 'PermissionController@delete')->name('permission.delete');
    });
    //文章
    Route::prefix('article')->group(function () {
        Route::post('upload', 'ArticleController@uploadImg')->name('article.upload');
        Route::get('', 'ArticleController@index');
        Route::get('listData', 'ArticleController@listData')->name('article.data');
        Route::get('add', 'ArticleController@add')->name('article.add');
        Route::post('add', 'ArticleController@addStore')->name('article.addPost');
        Route::get('edit', 'ArticleController@edit')->name('article.edit');
        Route::get('edit/{id}', 'ArticleController@editData');
        Route::patch('edit/{id}', 'ArticleController@editStore');
        Route::delete('delete', 'ArticleController@delete')->name('article.delete');
        //文章分类
        Route::prefix('category')->group(function () {
            Route::get('', 'ArticleCategoryController@index');
            Route::post('upload', 'ArticleCategoryController@uploadImg')->name('articleCategory.upload');
            Route::get('listData', 'ArticleCategoryController@listData')->name('articleCategory.data');
            Route::get('add', 'ArticleCategoryController@add')->name('articleCategory.add');
            Route::get('edit', 'ArticleCategoryController@edit')->name('articleCategory.edit');
            Route::get('edit/{id}', 'ArticleCategoryController@editData');
            Route::post('add', 'ArticleCategoryController@addStore');
            Route::patch('edit/{id}', 'ArticleCategoryController@editStore');
            Route::delete('delete', 'ArticleCategoryController@delete')->name('articleCategory.delete');
        });
    });
    //广告
    Route::prefix('ad')->group(function () {
        Route::get('', 'AdController@index');
        Route::post('upload', 'AdController@uploadImg')->name('ad.upload');
        Route::get('listData', 'AdController@listData')->name('ad.data');
        Route::get('add', 'AdController@add')->name('ad.add');
        Route::get('edit', 'AdController@edit')->name('ad.edit');
        Route::get('edit/{id}', 'AdController@editData');
        Route::post('add', 'AdController@addStore')->name('ad.addPost');
        Route::patch('edit/{id}', 'AdController@editStore');
        Route::delete('delete', 'AdController@delete')->name('ad.delete');
        Route::prefix('position')->group(function () {
            Route::get('', 'AdPositionController@index');
            Route::get('listData', 'AdPositionController@listData')->name('ad.position.data');
            Route::get('add', 'AdPositionController@add')->name('ad.position.add');
            Route::get('edit', 'AdPositionController@edit')->name('ad.position.edit');
            Route::get('edit/{id}', 'AdPositionController@editData');
            Route::post('add', 'AdPositionController@addStore')->name('ad.position.addPost');
            Route::patch('edit/{id}', 'AdPositionController@editStore');
            Route::delete('delete', 'AdPositionController@delete')->name('ad.position.delete');
        });
    });
    Route::prefix('system')->group(function () {
        Route::get('', 'SystemConfigController@index');
        Route::get('group', 'SystemConfigController@configMenu');
        Route::get('group/data', 'SystemConfigController@groupData');
        Route::patch('edit', 'SystemConfigController@edit');
        Route::post('upload', 'SystemConfigController@uploadImg');
    });
    Route::prefix('login/record')->group(function () {
        Route::get('', 'LoginRecordController@index');
        Route::get('listData', 'LoginRecordController@listData')->name('loginRecord.data');
 
    });
});
