<template>
<div class="container">
<div class="card">
    <div class="card-body">

 <div class="form-group">
    <div id="variants">
        <label for="">Variant</label>
        <input type="checkbox" value="S" v-model="productForm.sizes"> S
        <input type="checkbox" value="L" v-model="productForm.sizes"> L
        <input type="checkbox" value="XL" v-model="productForm.sizes"> XL
        <input type="checkbox" value="XXL" v-model="productForm.sizes"> XXL
        <input type="checkbox" value="XXXL" v-model="productForm.sizes"> XXXL
        <input type="checkbox" value="46" v-model="productForm.sizes"> 46
    </div>
    <div id="preview">
        <ul>
            <div class="row" v-if="productForm.sizes.length>0">
                <div class="col-md-4 text-right">
                    size:
                </div>
                <div class="col-md-5">
            input
                </div>
                <div class="col-md-3">
                   quantity
                </div>
            </div>
            <li v-for="(size, index) in productForm.sizes" class="mb-2" :key="index">
            <div class="row">
                <div class="col-md-4 text-right">
                    {{size}}:
                </div>
                <div class="col-md-5">
            <input type="number" v-model="productForm.quantity[index]" class="w-100" placeholder="Add Quantity">
                </div>
                <div class="col-md-3">
                     {{productForm.quantity[index]}}
                </div>
            </div>


            </li>
        </ul>
        <!-- <button class="btn btn-primary" @click="addElement">
            New Element
  </button> -->
    </div>


    </div>

    </div>
</div>
</div>


</template>

<script>
import Form from 'vform';
import { Button, HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5'

export default {
     components: {
    Button, HasError, AlertError
  },
    data(){
       return{
            productForm: new Form({
            sizes: [],
            quantity:[]
        }),
    }
    },
    methods: {

  }

}
</script>

<style>

</style>
