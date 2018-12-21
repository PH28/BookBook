@extends('admin.layouts.master')

@section('content')
<main class="app-layout-content">
  <div  class="container-fluid p-y-md">
    <ul style="list-style: none;" class="navbar-nav mr-auto">
                        <li><a href="{{route('admin.products.index')}}"> Products</a></li> 
                        <li>&nbsp;&nbsp;&nbsp; </li>
                        <li><a href="{{ route('admin.product.create')}}"> New Product </a></li>           
        </ul>

        

  </div>

    <div  class="container-fluid p-y-md">
      
            <div class="container">

            <div class="card">
                <div class="card-header">Edit Product</div>
              
              <div class="card-body">
                    <form action="{{ route('admin.product.update', ['id' => $product->id ]) }}" method="post">
                        @csrf

                        <div class="container mt-3">
                        <fieldset class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" value="{{$product->name}}" name="name">
                        </fieldset>
                        <fieldset class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description">{{$product->description}}</textarea>
                        </fieldset>
                         <fieldset class="form-group">
                  
                              <label>Quantity</label>
                              <input type="number" value="{{$product->quantity}}" name="quantity" class="form-control">
                        
                        </fieldset>
                        <fieldset class="form-group">
                  
                              <label for="image">Price</label>
                              <input type="number" name="price" value="{{$product->price}}" class="form-control">
                        
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="formGroupExampleInput">Subcategory_id</label>
                          <select class="form-control" name="subcategory_id">
                           @foreach ($subcategories as $key => $value)
                            @if ($product->subcategory_id == $key) 
                            <option value="{{$key}}" selected>{{$value}}</option>
                            @else
                            <option value="{{$key}}">{{$value}}</option>
                            @endif
                            @endforeach
                          </select>
                        </fieldset>

                        </div>

                        <div class="form-group">
                              <button class="form-control btn btn-success">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>

</div>


</main>




@endsection