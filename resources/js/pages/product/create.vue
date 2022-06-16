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
                            <div class="col-12">
                                <form @submit.prevent="createProduct" @keydown="productForm.onKeydown($event)">

                                  <AlertError :form="productForm" />
                                  <div class="row">
                                    <div class="col-8">
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
                                        <label for="">Select Product Color</label>
                                        <select name="color_id" class="form-control" v-model="productForm.color_id" :class="{ 'is-invalid': productForm.errors.has('color_id') }">
                                            <option style="display:none;" value="" selected>Select Color</option>
                                            <option :value="color.id" v-for="color in colors" :key="color.id">
                                            {{ color.name }}</option>
                                        </select>
                                        <has-error :form="productForm" field="color_id"></has-error>
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
                                        <input type="file" class="form-control" @change="onImageChange" multiple >
                                    </div>

                                    </div>
                                    <div class="col-4 my-auto">
                                        <div class="form-group" v-if="productForm.color_id >0">
                                        <label for="">Variant</label>
                                            <input type="checkbox" value="S" v-model="productForm.sizes"> S
                                            <input type="checkbox" value="L" v-model="productForm.sizes"> L
                                            <input type="checkbox" value="XL" v-model="productForm.sizes"> XL
                                            <input type="checkbox" value="XXL" v-model="productForm.sizes"> XXL
                                            <input type="checkbox" value="XXXL" v-model="productForm.sizes"> XXXL
                                            <input type="checkbox" value="46" v-model="productForm.sizes"> 46
                                    </div>

                                    </div>

                                  </div>
                                  <div class="row mt-5">
                                    <div class="col-6">
                        <upload-media  v-if="productForm.color_id >0" server='/api/upload'></upload-media>

                                    </div>
                                    <div class="col-6">
                                         <div class="form-group">
                                   <div id="preview">
                                    <ul>
                                        <div class="row" v-if="productForm.sizes.length>0">
                                            <div class="col-md-3 text-right">
                                                <h4>size:</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>input:</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4>quantity:</h4>
                                            </div>
                                        </div>
                                        <li v-for="(size, index) in productForm.sizes" class="mb-2" :key="index">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                {{size}}:
                                            </div>
                                            <div class="col-md-6">
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
                                    <div class="form-group text-center mt-5">
                                        <button type="submit" class="btn btn-success">Create Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-5 my-auto">
            <!-- <create-variant v-if="productForm.color_id >0"></create-variant> -->
            </div>
        </div>
        <!-- <p>{{color.name}}</p> -->
    </div>


  </div>
</template>

<script>
import Form from 'vform';
import { Button, HasError, AlertError, AlertSuccess } from 'vform/src/components/bootstrap5'
import { objectToFormData } from 'object-to-formdata'
import { UploadMedia, UpdateMedia } from 'vue-media-upload';
import axios from 'axios'

export default {
     components: {
    Button, HasError, AlertError,
    UploadMedia,UpdateMedia
  },
    data(){
        return{

            productForm: new Form({
            title: '',
            price: '',
            category_id:'',
            image: '',
            description: '',
            color_id:'',
            // color: '',
            sizes:[],
            quantity:[],
            // media:['qwe','qer'],
            // multipleImages:''

        }),

        categories: [],
        colors:[],

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
                    // this.productForm.sizes = [];

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
                // this.media = response.data
            });
        },
        loadColors(){
            axios.get('/api/color').then(response => {
                this.colors = response.data;
                this.productForm.colors = response.data;

            });
        },
        // loadVariants(){
        //     axios.get('/api/variant').then(response => {
        //         this.productForm.sizes = response.data;
        //          this.productForm.quantity = response.data;
        //     });
        // }
    },
    mounted(){
        this.loadCategories();
        this.loadColors();


        // this.loadVariants();
    },


}
</script>

<style scoped>


</style>


