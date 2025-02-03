<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function optimize()
    {
        Artisan::call('optimize');
        return json_encode(['status' => 'success', 'message' => 'Optimization completed!']);
    }

    public function cacheClear()
    {
        Artisan::call('cache:clear');
        return json_encode(['status' => 'success', 'message' => 'Cache cleared!']);
    }

    public function routeClear()
    {
        Artisan::call('route:clear');
        return json_encode(['status' => 'success', 'message' => 'Route cache cleared!']);
    }

    public function configCache()
    {
        Artisan::call('config:cache');
        return json_encode(['status' => 'success', 'message' => 'Config cache generated!']);
    }

    public function publishSweetAlert()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'RealRashid\SweetAlert\SweetAlertServiceProvider',
            '--force' => true, // Gunakan ini jika ingin menimpa file lama
        ]);

        return json_encode(['status' => 'success', 'message' => 'SweetAlert published!']);
    }

    public function storageLink()
    {
        Artisan::call('storage:link');
        return json_encode(['status' => 'success', 'message' => 'Storage linked!']);
    }
}
