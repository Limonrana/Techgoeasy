<!-- captcha-section start -->
<div class="top-bar-section" id="captcha-section" style="display: none;">
    <div class="container py-2">
        @php
            $captcha_ads = customize('hcaptcha');
        @endphp
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="wrapper">
                @if ($captcha_ads && $captcha_ads->has('banner_script_1'))
                    <section class="blog-ads-section pb-4" data-hCaptcha-ads>
                        {!! $captcha_ads['banner_script_1'] !!}
                    </section>
                @endif
                <div id="recaptcha-form">
                    <form id="recaptchaGoogle" method="POST">
                        <div id="googleRecaptcha-0" data-theme="dark" class="d-flex justify-content-center"></div>
                        <div id="googleRecaptcha-1" data-theme="dark" class="d-flex justify-content-center d-none"></div>
                        <div id="googleRecaptcha-2" data-theme="dark" class="d-flex justify-content-center d-none"></div>
                        <div id="googleRecaptcha-3" data-theme="dark" class="d-flex justify-content-center d-none"></div>
                        <br>
                        <div id="recaptchaError" class="alert alert-danger d-none" role="alert">
                            OOPS! Missing something, Are you Robot?
                        </div>
                        <div class="submit-btn text-center">
                            <button class="btn btn-primary px-3" type="submit">I am not a robot</button>
                        </div>
                    </form>
                </div>
                <div id="recaptcha-countdown" class="d-none" style="position: relative; height: 200px;">
                    <svg class="timer">
                        <circle class="progress-frame" cx="100" cy="100" r="96"></circle>
                        <circle class="progress" cx="100" cy="100" r="96"></circle>
                    </svg>
                    <div class="time">
                        <p><span class="seconds">15</span></p>
                    </div>
                </div>
                @if ($captcha_ads && $captcha_ads->has('banner_script_2'))
                    <section class="blog-ads-section py-4" data-hCaptcha-ads>
                        {!! $captcha_ads['banner_script_2'] !!}
                    </section>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var onloadCallbackRecaptcha = function() {
        hcaptcha.render('googleRecaptcha-0', {
            sitekey: '{{ config('services.recaptcha.key') }}'
        });
        hcaptcha.render('googleRecaptcha-1', {
            sitekey: '{{ config('services.recaptcha.key') }}'
        });
        hcaptcha.render('googleRecaptcha-2', {
            sitekey: '{{ config('services.recaptcha.key') }}'
        });
        hcaptcha.render('googleRecaptcha-3', {
            sitekey: '{{ config('services.recaptcha.key') }}'
        });
    };
</script>
