<?php

namespace Book\Http\Controllers;

use Book\Address;
use Book\City;
use Book\Order;
use Book\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    const NEW_ADDRESS = 0;
    const ROLE_USER   = 2;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    public function showCheckoutForm()
    {
        $cities = City::all();

        if (!Auth::check()) {

            return view('checkout', ['cities' => $cities]);

        } else {
            $user      = Auth::user();
            $addresses = $user->addresses()->with('city', 'district')->get();

            return view('checkout', [
                'cities'    => $cities,
                'addresses' => $addresses,
            ]);
        }
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();

        if (!Auth::check()) {
            $this->validateGuestRequest($request);

            try {
                $this->guestCheckout($request);

                DB::commit();

                return view('message', [
                    'title'   => 'Đặt hàng thành công',
                    'message' => 'Chúng tôi sẽ xử lý đơn hàng của bạn trong vòng 1 - 2 ngày làm việc. Cảm ơn!',
                    'url'     => '/account',
                    'type'    => 'order success',
                ]);
            } catch (\Exception $e) {
                DB::rollback();
            }
        } else {
            $this->validateUserRequest($request);

            $user = Auth::user();

            if ($request->address_id == $this::NEW_ADDRESS) {
                $this->validateNewAddressUserRequest($request);

                $address = $this->createNewAddress($user, $request->only(['first_name', 'last_name', 'phone', 'address', 'city_id', 'district_id']));
            } else {
                $address = $user->addresses()->where('id', $request->address_id)->first();
            }

            try {
                $this->userCheckout($request, $address);

                DB::commit();

                return view('message', [
                    'title'   => 'Đặt hàng thành công',
                    'message' => 'Chúng tôi sẽ xử lý đơn hàng của bạn trong vòng 1 - 2 ngày làm việc. Cảm ơn!',
                    'url'     => '/account',
                    'type'    => 'order success',
                ]);
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
    }

    public function validateGuestRequest(Request $request)
    {
        $request->validate([
            'last_name'    => 'required|min:2|max:10',
            'first_name'   => 'required|min:2|max:10',
            'email'        => 'required|email|max:255|unique:users',
            'city_id'      => 'required|numeric',
            'district_id'  => 'required|numeric',
            'address'      => 'required',
            'phone'        => 'required|regex:/(0)[0-9]{9}/',
            'password'     => 'required|min:6',
            'orderDetails' => 'required',
        ], [
            'last_name.required'   => 'Vui lòng nhập họ',
            'last_name.min'        => 'Họ phải có ít nhất 2 ký tự',
            'last_name.max'        => 'Họ không được quá 10 ký tự',
            'first_name.min'       => 'Tên phải có ít nhất 2 ký tự',
            'first_name.max'       => 'Tên không được quá 10 ký tự',
            'first_name.required'  => 'Vui lòng nhập tên',
            'email.required'       => 'Vui lòng nhập địa chỉ email',
            'email.email'          => 'Địa chỉ email không hợp lệ',
            'email.unique'         => 'Địa chỉ này email đã tồn tại. Vui lòng đăng nhập để việc thanh toán dễ dàng hơn!',
            'city_id.required'     => 'Vui lòng chọn thành phố',
            'city_id.numeric'      => 'Vui lòng chọn thành phố',
            'district_id.required' => 'Vui lòng chọn quận/huyện',
            'district_id.numeric'  => 'Vui lòng chọn quận/huyện',
            'address.required'     => 'Vui lòng nhập địa chỉ',
            'phone.required'       => 'Vui lòng nhập số điện thoại',
            'phone.regex'          => 'Số điện thoại không hợp lệ',
            'password.required'    => 'Vui lòng nhập mật khẩu',
            'password.min'         => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);
    }

    public function validateUserRequest(Request $request)
    {
        $request->validate([
            'address_id'   => 'required',
            'orderDetails' => 'required',
        ], [
            'address_id.required' => 'Vui lòng chọn địa chỉ',
        ]);
    }

    public function validateNewAddressUserRequest(Request $request)
    {
        $request->validate([
            'address_id'   => 'required',
            'last_name'    => 'required|string|min:2|max:10',
            'first_name'   => 'required|string|min:2|max:10',
            'city_id'      => 'required|numeric',
            'district_id'  => 'required|numeric',
            'address'      => 'required',
            'phone'        => 'required|regex:/(0)[0-9]{9}/',
            'orderDetails' => 'required',
        ], [
            'last_name.required'   => 'Vui lòng nhập họ',
            'last_name.min'        => 'Họ phải có ít nhất 2 ký tự',
            'last_name.max'        => 'Họ không được quá 10 ký tự',
            'first_name.min'       => 'Tên phải có ít nhất 2 ký tự',
            'first_name.max'       => 'Tên không được quá 10 ký tự',
            'first_name.required'  => 'Vui lòng nhập tên',
            'city_id.required'     => 'Vui lòng chọn thành phố',
            'city_id.numeric'      => 'Vui lòng chọn thành phố',
            'district_id.required' => 'Vui lòng chọn quận/huyện',
            'district_id.numeric'  => 'Vui lòng chọn quận/huyện',
            'address.required'     => 'Vui lòng nhập địa chỉ',
            'phone.required'       => 'Vui lòng nhập số điện thoại',
            'phone.regex'          => 'Số điện thoại không hợp lệ',
        ]);
    }

    public function guestCheckout(Request $request)
    {
        $user    = $this->createNewAccount($request->only(['email', 'password', 'first_name', 'last_name']));
        $address = $this->createNewAddress($user, $request->only(['first_name', 'last_name', 'phone', 'address', 'city_id', 'district_id']));
        $order   = $this->createNewOrder($user, $address);
        $this->createOrderDetails($order, $request->only(['orderDetails']));

        Auth::guard()->login($user);
    }

    public function userCheckout(Request $request, Address $address)
    {
        $user = Auth::user();

        $order = $this->createNewOrder($user, $address);
        $this->createOrderDetails($order, $request->only(['orderDetails']));
    }

    public function createNewAccount($data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['role_id']  = $this::ROLE_USER;

        $user = User::create($data);

        return $user;
    }

    public function createNewAddress(User $user, $data)
    {
        $address = $user->addresses()->create($data);

        return $address;
    }

    public function createNewOrder(User $user, Address $address)
    {
        $order = $user->orders()->create(['address_id' => $address->id]);

        return $order;
    }

    public function createOrderDetails(Order $order, $orderDetails)
    {
        $orderDetails = $orderDetails['orderDetails'];

        foreach ($orderDetails as $orderDetail) {
            $data = [
                'product_id' => $orderDetail['product_id'],
                'quantity'   => $orderDetail['quantity'],
            ];

            $order->orderDetails()->create($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
