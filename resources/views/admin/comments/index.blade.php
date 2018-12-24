@extends('admin.layouts.master')

@section('function')
    <li class="nav-item nav-drawer-header">Chức năng</li>

    <li class="nav-item nav-item-has-subnav">
        <!-- <a href=""><i class="ion-ios-search"></i>Tìm kiếm</a> -->
        <!-- <ul class="nav nav-subnav">
            <li>
                <a href="base_ui_buttons.html">Buttons</a>
            </li>
            <li>
                <a href="base_ui_cards.html">Cards</a>
            </li>
        </ul> -->
    </li>
@endsection

@section('breadcrumb')
	Bình luận
@endsection

@section('content')

    <main class="app-layout-content">

        <!-- Page Content -->
        <div class="container-fluid p-y-md">
        	<div class="card">
        		<div class="card-header bg-purple bg-inverse">
                    <h4>Bình luận</h4>
                </div>
                <div class="card-block">
                	<table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="text-center w-5">#</th>
                                <th class="w-15">Người bình luận</th>
                                <th class="w-10">Biệt danh</th>
                                <th>Sản phẩm</th>
                                <th class="w-15">Chất lượng</th>
                                <th class="w-15">Giá</th>
                                <th class="w-15">Giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr class="pointer comment" href="{{ route('admin.comments.show', $comment->id) }}">
                                    <td class="text-center">{{ $comment->id }}</td>
                                    <td>{{ $comment->user->last_name . ' ' . $comment->user->first_name }}</td>
                                    <td>{{ $comment->nickname }}</td>
                                    <td>{{ $comment->product->name }}</td>
                                    <td>
                                        @for ($i = 1; $i <= $comment->rating_quality; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </td>
                                    <td>
                                        @for ($i = 1; $i <= $comment->rating_price; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </td>
                                    <td>
                                        @for ($i = 1; $i <= $comment->rating_value; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $comments->links() }}
                    </div>
                </div>
        	</div>
        </div>
        <!-- End Page Content -->

        @if (session('type'))
            <div id="message" type="{{ session('type') }}" message="{{ session('message') }}"></div>
        @endif

    </main>

@endsection

@section('javascript')

	<!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
	<script src="{{ asset('admin/js/core/jquery.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.scrollLock.min.js') }}"></script>
	<script src="{{ asset('admin/js/core/jquery.placeholder.min.js') }}"></script>
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<script src="{{ asset('admin/js/app-custom.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Page JS Code -->
    <script>

        $(document).ready(function () {

            if ($('#message').length) {
                type = $('#message').attr('type');
                message = $('#message').attr('message');

                $.notify({
                    title: '<strong>' + message + '</strong>',
                    message: ''
                }, {
                    element: 'body',
                    type: type
                });
            }

            //view order details when click a tr
            $(document).on('click', 'tr.comment', function(event) {
                event.preventDefault();
                
                href = $(this).attr('href');
                window.location.replace(href);
            });

        });
        
    </script>

@endsection