<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    public function __construct(Application $app, Encrypter $encrypter) {
        parent::__construct($app, $encrypter);
        $this->except = [
          env("TELEGRAM_TOKEN") . '/webhook'
        ];
    }
    
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        
    ];
}
