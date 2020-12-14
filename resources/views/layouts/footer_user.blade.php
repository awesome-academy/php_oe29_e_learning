<footer class="footer">
    <section class="layout">
        <section class="info">
            <a href="">
                <img src="{{ asset(config('title.logo')) }}">
            </a>
            <p>@lang('label.f8_area')</p>
            <p>@lang('label.f8_course_intro')</p>
            <p>@lang('label.f8_students_intro')</p>
            <p>@lang('label.copy')</p>
        </section>
        <section class="web-info">
            <h6>@lang('label.f8_title')</h6>
            <ul>
                <li><a href="">@lang('label.intro')</a></li>
                <li><a href="">@lang('label.question')</a></li>
                <li><a href="">@lang('label.contact')</a></li>
            </ul>
        </section>
        <section class="product">
            <h6>@lang('label.product')</h6>
            <ul>
                <li><a href="">@lang('label.website')</a></li>
            </ul>
        </section>
        <section class="support">
            <h6>@lang('label.support')</h6>
            <ul>
                <li><a href="">@lang('label.support')</a></li>
                <li><a href="">@lang('label.contribute')</a></li>
            </ul>
        </section>
        <section class="follow-us">
            <h6>@lang('label.follow_us')</h6>
            <p>@lang('label.contact_mail')</p>
            <input type="email" placeholder="@lang('label.enter_email')">
            <button class="btn-mine">@lang('label.register')</button>
        </section>
    </section>
</footer>
