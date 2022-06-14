<template>
  <div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5> Create products</h5>
                        <router-link :to="{name:'product-list'}" class="btn btn-primary">Products</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="createProduct" @keydown="productForm.onKeydown($event)">

                                  <AlertError :form="productForm" />

                                    <div class="form-group">
                                        <label for="">Product Title</label>
                                        <input type="text" v-model="productForm.title" name="title" class="form-control" placeholder="product title">
                                        <HasError :form="productForm" field="title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select Product Category</label>
                                        <select name="category_id" class="form-control" v-model="productForm.category_id" :class="{ 'is-invalid': productForm.errors.has('category_id') }">
                                            <option style="display:none;" value="" selected>Select Category</option>
                                            <option :value="category.id" v-for="category in categories" :key="category.id"> {{
                                                category.name }}</option>
                                        </select>
                                        <has-error :form="productForm" field="category_id"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="">Product Color</label>
                                        <input type="text" v-model="productForm.color" name="color" class="form-control" placeholder="product color">
                                        <HasError :form="productForm" field="price" />
                                    </div>
                                     <div class="form-group">
                                        <label for="">Variant</label>
                                        <input type="checkbox" value="S" v-model="productForm.sizes"> S
                                        <input type="checkbox" value="L" v-model="productForm.sizes"> L
                                        <input type="checkbox" value="XL" v-model="productForm.sizes"> XL
                                        <input type="checkbox" value="XXL" v-model="productForm.sizes"> XXL
                                        <input type="checkbox" value="XXXL" v-model="productForm.sizes"> XXXL
                                        <input type="checkbox" value="46" v-model="productForm.sizes"> 46
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product price</label>
                                        <input type="text" v-model="productForm.price" name="price" class="form-control" placeholder="product price">
                                        <HasError :form="productForm" field="price" />
                                    </div>


                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <textarea type="text" v-model="productForm.description" name="description" class="form-control" placeholder="product description"></textarea>
                                        <HasError :form="productForm" field="description" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product Image</label>
                                        <input type="file" class="form-control" @change="onImageChange" >
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform';
import { Button, HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5'
import { objectToFormData } from 'object-to-formdata'

export default {
     components: {
    Button, HasError, AlertError
  },
    data(){
        return{
            productForm: new Form({
            title: '',
            price: '',
            category_id:'',
            image: '',
            description: '',
            color:'',
            sizes: [],
        }),
        categories: [],

        }
    },
    methods:{
      createProduct(){
            this.productForm.post('/api/product', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                }).then(({data})=>{

                    this.productForm.title = '';
                    this.productForm.price = '';
                    this.productForm.image = '';
                    this.productForm.description = '';
                    this.productForm.color = '';
                    this.productForm.sizes = [];

                    this.$toast.success({
                    title:'Success',
                    message:'Product Created Successfully'
                    });
            });

        },
        onImageChange(e) {
            const file = e.target.files[0]
            // Do some client side validation...
            this.productForm.image = file
        },
        loadCategories(){
            axios.get('/api/category').then(response => {
                this.categories = response.data;
            });
        }
    },
    mounted(){
        this.loadCategories();
    }

}
</script>

<style>

</style>
