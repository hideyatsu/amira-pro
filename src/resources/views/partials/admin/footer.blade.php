<!--  BEGIN FOOTER  -->
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    @foreach($footerLinks ?? [] as $link)
                        <li class="list-inline-item">
                            <a href="{{ $link['url'] }}"
                               class="link-secondary"
                               @if($link['external'] ?? false) target="_blank" rel="noopener" @endif>
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach

                    @if(empty($footerLinks))
                        <li class="list-inline-item">
                            <a href="#" class="link-secondary">Documentation</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="link-secondary">License</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="link-secondary">Support</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; {{ date('Y') }}
                        <a href="{{ url('/') }}" class="link-secondary">{{ config('app.name', 'Laravel') }}</a>.
                        All rights reserved.
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('admin.dashboard') }}" class="link-secondary">
                            v{{ config('app.version', '1.0.0') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
