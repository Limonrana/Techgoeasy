<?php

namespace App\Services\Web;

use TwoCaptcha\TwoCaptcha;

class TwoCaptchaServices
{
    /**
     * @var $blogServices
     */
    protected TwoCaptcha $twoCaptchaSolver;

    /**
     * Create a new Two Captcha instance.
     *
     * @param TwoCaptcha $twoCaptchaSolver
     * @return void
     */
    public function __construct()
    {
        $this->twoCaptchaSolver = new TwoCaptcha(config('services.two_captcha.key'));
    }

    /**
     * Solve Fun Captcha Methods.
     *
     * @param TwoCaptcha $twoCaptchaSolver
     * @return string
     */
    public function solveFunCaptcha ()
    {
        try {
            $result = $this->twoCaptchaSolver->funcaptcha([
                'sitekey' => '69A21A01-CC7B-B9C6-0F9A-E7FA06677FFC',
                'url'     => 'https://mysite.com/page/with/funcaptcha',
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $result->code;
    }
}
