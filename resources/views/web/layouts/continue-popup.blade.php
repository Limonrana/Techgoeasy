<!-- Modal Fullscreen xl -->
<div class="modal modal-fullscreen-xl" id="continue-page-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document" style="max-width: 100% !important;height: 100%;margin: 0 !important;">
        <div class="modal-content" style="height: 100%">
            <div class="modal-body">
                <div class="container h-100">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        @php
                            $continue_ads = customize('continue');
                        @endphp
                        <div id="continue-page">
                            @if ($continue_ads && $continue_ads->has('banner_script_1'))
                                <section class="blog-ads-section py-2" data-continue-ads>
                                    {!! $continue_ads['banner_script_1'] !!}
                                </section>
                            @endif
                            <div class="submit-btn text-center my-3">
                                <button class="btn btn-info px-5" type="button" id="continue-btn">Click here to continue</button>
                            </div>
                            @if ($continue_ads && $continue_ads->has('banner_script_2'))
                                <section class="blog-ads-section py-2" data-continue-ads>
                                    {!! $continue_ads['banner_script_2'] !!}
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
