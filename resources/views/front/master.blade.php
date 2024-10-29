<!DOCTYPE html>
<html lang="en">
@include('front.includes.head')

<body
        @unless(empty($body_class))
            class="{{$body_class}}"
        @endunless
>
<div class="wrapper">
    @include('front.includes.header', [ 'header_id' => 'header',  'header_class' => 'header navbar-fixed-top'])

    @yield('body')
</div><!--//wrapper-->

@include('front.includes.footer')
@include('front.includes.modal')
@include('front.includes.scripts')

@yield('scripts')
</body>

</html>

