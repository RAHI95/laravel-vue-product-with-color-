@extends('master')

@section('content')

<div class="container">
    <form action="{{route('saveProduct')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Product Name</label>
          <input type="text" name="product_name" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Product Color</label>
          <input name="product_color" class="form-control" id="exampleFormControlInput1">

          {{-- <select class="form-control" id="exampleFormControlSelect1" name="product_color">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select> --}}
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Size</label>
          {{-- <input name="product_variation" class="form-control" id="exampleFormControlInput1"> --}}

          <div class="form-check form-check-inline">
            <input class="form-check-input" name="product_variation" type="checkbox" id="inlineCheckbox1" value="xL">
            <label class="form-check-label" for="inlineCheckbox1">xL</label>
            <input class="form-check-input" name="product_variation" type="checkbox" id="inlineCheckbox1" value="xXL">
            <label class="form-check-label" for="inlineCheckbox1">XxL</label>
            <input class="form-check-input" name="product_variation" type="checkbox" id="inlineCheckbox1" value="L">
            <label class="form-check-label" for="inlineCheckbox1">L</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>

      </form>
</div>

@endsection
