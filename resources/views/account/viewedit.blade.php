@extends('layouts.app')
{{-- {{ dump($page) }} --}}
@section('oth-page')
    oth-page
@endsection

@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Cửa hàng</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="{{ route('home') }}">@lang('labels.home')</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Chỉnh sửa địa chỉ  </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div class="accountSidebar bg_w">
                    <div class="feature_user">
                        <div class="icon">
                            <img src="{{ asset('admin/img/avatars/icon_avatar.png') }}" alt="Nguyen Hung">
                        </div>
                        <div class="user">
                            <span>Người nhận hàng:</span>
                            <h3>{{$address->first_name.' '.$address->last_name}}</h3>
                        </div>
                    </div>
                    <div class="link_account">
                        <ul>
                                <li class="active"><a href="{{route('account.index')}}">Thông tin chung</a></li>
                                <li class="active"><a href="{{route('account.addresses')}}">Sổ địa chỉ</a></li>
                        </ul>
                    </div>

                </div>
                <div class="ctAccount">
                    <div class="detailAccount bg_w">
                        
                        <div class="accountNewoder">
                            <form action="{{ route('address.update', ['id' => $address->id ]) }}" method="post">
                                @csrf
                                @method('PUT')
                                 <div class="container mt-3">
                                     <div class="row">
                                        <div class="col-sm-6">
                                                <fieldset class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{$address->first_name}}" name="first_name">
                                                </fieldset>
                                        </div>
                                        <div class="col-sm-6">
                                                <fieldset class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{$address->last_name}}" name="last_name">
                                                </fieldset>
                                        </div>
                                    </div>
                                   <fieldset class="form-group">            
                                     <label>Số điện thoại:</label>
                                    <input type="number" value="{{$address->phone}}" name="phone" class="form-control">   
                                   </fieldset>
                                   <fieldset class="form-group">
                                     <label>Địa chỉ cụ thể: </label>
                                    <input type="text" name="address" value="{{$address->address}}" class="form-control">                    
                                   </fieldset>
                                        <input type="number" value="{{$address->user_id}}" name="user_id" class="form-control" hidden>   
                                   <fieldset class="form-group">
                                     <label for="formGroupExampleInput">Tỉnh/Thành phố</label>
                                     <select class="form-control" name="city_id">
                                       @foreach ($cities as $key => $value)
                                       @if ($address->city_id == $key) 
                                       <option value="{{$key}}" selected>{{$value}}</option>
                                       @else
                                       <option value="{{$key}}">{{$value}}</option>
                                       @endif
                                       @endforeach
                                       </select>
                                    </fieldset>
                                    <fieldset class="form-group">
                                            <label for="formGroupExampleInput">Quận/Huyện</label>
                                            <select class="form-control" name="district_id">
                                              @foreach ($districts as $key => $value)
                                              @if ($address->district_id == $key) 
                                              <option value="{{$key}}" selected>{{$value}}</option>
                                              @else
                                              
                                              @endif
                                              @endforeach
                                              </select>
                                           </fieldset>
                                 </div>
                   
                                 <div class="form-group">
                                   <button class="form-control btn btn-success">Lưu</button>
                                 </div>
                             </form>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- End Bradcaump area -->
    <!-- Start Shop Page -->

    @section('javascript')
    <script>
        jQuery().ready(function ($) {

            city = $('select[name="city_id"]');
            district = $('select[name="district_id"]');

            $city_id = city.val();
            districts = '';

            $.ajax({
                url: '/api/v1/cities/' + $city_id + '/districts',
                type: 'GET',
                success: function(response) {
                    $.each(response, function(index, value) {
                        districts += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                    });

                    district.html(districts);
                }
            });

            city.on('change', function (event) {
                event.preventDefault();

                $city_id = city.val();
                districts = '';
                
                $.ajax({
                    url: '/api/v1/cities/' + $city_id + '/districts',
                    type: 'GET',
                    success: function(response) {
                        $.each(response, function(index, value) {
                            districts += '<option value="' + value['id'] + '">' + value['name'] + '</option>'
                        });

                        district.html(districts);
                    }
                });
            });
        })
    </script>
@endsection