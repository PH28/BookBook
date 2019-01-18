@extends('layouts.app')

@section('oth-page')
    oth-page
@endsection

@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">@lang('labels.checkout')</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="{{ route('home') }}">@lang('labels.home')</a>
                            <span class="brd-separetor">/</span>
                            <a class="breadcrumb_item" href="{{ route('cart.index') }}">@lang('labels.cart')</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">@lang('labels.checkout')</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn_checkout_wrap">
                        @guest
                            <div class="checkout_info">
                                <span>@lang('labels.already_a_member')?</span>
                                <a class="showlogin" href="#">@lang('labels.click_here_to_login')</a>
                            </div>
                            <div class="checkout_login">
                                <form class="wn__checkout__form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input__box">
                                        <label>@lang('labels.account.email_address') <span style="color: red;">*</span></label>
                                        <input type="text" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <div class="has-error">
                                            <i>{{ $errors->first('email') }}</i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="input__box">
                                        <label>@lang('labels.account.password')<span style="color: red;">*</span></label>
                                        <input type="password" name="password">
                                        @if ($errors->has('password'))
                                        <div class="has-error">
                                            <i>{{ $errors->first('password') }}</i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form__btn">
                                        <button>@lang('labels.account.login')</button>
                                        <a class="forget_pass" href="{{ route('password.request') }}">@lang('labels.account.forgot_password')?</a>
                                    </div>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('cart.checkout') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12">
                        @guest
                            <div class="customer_details">
                                <h3>@lang('labels.details_infomation')</h3>
                                <div class="customar__field">
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>@lang('labels.account.last_name') <span>*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('last_name') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="input_box space_between">
                                            <label>@lang('labels.account.first_name') <span>*</span></label>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('first_name') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.account.email_address') <span>*</span></label>
                                        <input class="input-email" type="text" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('email') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>@lang('labels.city') <span>*</span></label>
                                            <select class="select__option" name="city_id">
                                                <option>Vui lòng chọn…</option>
                                                @foreach($cities as $city)
                                                    @if ($city->id == old('city_id'))
                                                        <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('city_id') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="input_box space_between">
                                            <label>@lang('labels.district') <span>*</span></label>
                                            <select class="select__option" name="district_id">
                                                <option>Vui lòng chọn…</option>
                                            </select>
                                            @if ($errors->has('district_id'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('district_id') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.address') <span>*</span></label>
                                        <input type="text" name="address" value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('address') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.phone') <span>*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('phone') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.account.password') <span>*</span> (để tạo tài khoản và giúp việc thanh toán trở nên dễ dàng hơn)</label>
                                        <input type="password" name="password">
                                        @if ($errors->has('password'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('password') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="customer_details">
                                <h3>@lang('labels.select_address_or_enter_new_address')</h3>
                                <div class="customar__field">
                                    <div class="customar__field">
                                        <div class="input_box">
                                            <select class="select__option" name="address_id">
                                                @foreach($addresses as $address)
                                                    @if ($address->id == old('address_id'))
                                                        <option value="{{ $address->id }}" selected>{{ $address->last_name . ' ' . $address->first_name . ', ' . $address->address . ', ' . $address->district->name . ', ' . $address->city->name }}</option>
                                                    @else
                                                        <option value="{{ $address->id }}">{{ $address->last_name . ' ' . $address->first_name . ', ' . $address->address . ', ' . $address->district->name . ', ' . $address->city->name }}</option>
                                                    @endif
                                                @endforeach
                                                @if (old('address_id') === "0")
                                                    <option value="0" selected>Địa chỉ mới</option>
                                                @else
                                                    <option value="0">Địa chỉ mới</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('address_id'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('address_id') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="customer_details mt--20 address-wrapper">
                                @foreach ($addresses as $address)
                                    <div class="customar__field address-{{ $address->id }} mt--40" style="display: none;">
                                        <h3 class="pull-left">@lang('labels.address')</h3>
                                        <a href="{{ route('address.edit', $address->id) }}" class="btn btn-outline-dark pull-right">Sửa địa chỉ</a>
                                        <div class="clearfix"></div>
                                        <div class="margin_between">
                                            <div class="input_box space_between">
                                                <label>@lang('labels.account.last_name')</label>
                                                <input type="text" value="{{ $address->last_name }}" disabled>
                                            </div>
                                            <div class="input_box space_between">
                                                <label>@lang('labels.account.first_name')</label>
                                                <input type="text" value="{{ $address->first_name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="margin_between">
                                            <div class="input_box space_between">
                                                <label>@lang('labels.city')</label>
                                                <input type="text" value="{{ $address->city->name }}" disabled>
                                            </div>
                                            <div class="input_box space_between">
                                                <label>@lang('labels.district')</label>
                                                <input type="text" value="{{ $address->district->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="input_box">
                                            <label>@lang('labels.address')</label>
                                            <input type="text" value="{{ $address->address }}" disabled>
                                        </div>
                                        <div class="input_box">
                                            <label>@lang('labels.phone')</label>
                                            <input type="text" value="{{ $address->phone }}" disabled>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="customar__field differt__form mt--40">
                                    <h3>@lang('labels.new_address')</h3>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>@lang('labels.account.last_name') <span>*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('last_name') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="input_box space_between">
                                            <label>@lang('labels.account.first_name') <span>*</span></label>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('first_name') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>@lang('labels.city') <span>*</span></label>
                                            <select class="select__option" name="city_id">
                                                <option>Vui lòng chọn…</option>
                                                @foreach($cities as $city)
                                                    @if ($city->id == old('city_id'))
                                                        <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('city_id') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="input_box space_between">
                                            <label>@lang('labels.district') <span>*</span></label>
                                            <select class="select__option" name="district_id">
                                                <option>Vui lòng chọn…</option>
                                            </select>
                                            @if ($errors->has('district_id'))
                                                <div class="has-error">
                                                    <i>{{ $errors->first('district_id') }}</i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.address') <span>*</span></label>
                                        <input type="text" name="address" value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('address') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="input_box">
                                        <label>@lang('labels.phone') <span>*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <div class="has-error">
                                                <i>{{ $errors->first('phone') }}</i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                    <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                        <div class="wn__order__box">
                            <h3 class="onder__title">@lang('labels.your_order')</h3>
                            <ul class="order__total">
                                <li>@lang('labels.product')</li>
                                <li>@lang('labels.subtotal')</li>
                            </ul>
                            <ul class="order_product"></ul>
                            <ul class="shipping__method">
                                <li>@lang('labels.cart_subtotal') <span class="cart_subtotal"></span></li>
                            </ul>
                            <ul class="total__amount">
                                <li>@lang('labels.order_total') <span class="cart_total"></span></li>
                            </ul>
                        </div>
                        <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                            <button class="btn-checkout">@lang('labels.order_confirmation')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Checkout Area -->
@endsection

@section('javascript')

    <script src="{{ asset('js/checkout.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
            var city = $('select[name="city_id"]');
            var address = $('select[name="address_id"]');

            if ($.isNumeric(city.val())) {
                districts = '<option>Vui lòng chọn...</option>';

                $.ajax({
                    url: '/api/v1/cities/' + city.val() + '/districts',
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function(index, value) {
                            districts += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                        });

                        $('select[name="district_id"]').html(districts);
                    }
                });
            }

            city.on('change', function(event) {
                event.preventDefault();
                /* Act on the event */

                districts = '<option>Vui lòng chọn...</option>';

                if ($.isNumeric($(this).val())) {
                    $.ajax({
                        url: '/api/v1/cities/' + $(this).val() + '/districts',
                        type: 'GET',
                        success: function(response) {
                            $.each(response, function(index, value) {
                                districts += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                            });

                            $('select[name="district_id"]').html(districts);
                        }
                    });
                } else {
                    $('select[name="district_id"]').html(districts);
                }
            });

            if (address.val() == 0) {
                $('.differt__form').slideToggle(200);
            } else {
                $('.address-' + address.val()).slideToggle(200);
            }

            address.on('change', function(event) {
                event.preventDefault();
                /* Act on the event */

                if ($(this).val() == 0) {
                    $('.address-wrapper').children().slideUp(200);
                    $('.differt__form').delay(200).slideDown(200);
                } else {
                    $('.address-wrapper').children().slideUp(200);
                    $('.address-' + $(this).val()).delay(200).slideDown(200);
                }
            });
        });
    </script>

@endsection