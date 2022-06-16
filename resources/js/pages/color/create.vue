<template>
  <div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5> Create colors</h5>
                        <router-link :to="{name:'color-list'}" class="btn btn-primary">Categories</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="createColor" @keydown="colorForm.onKeydown($event)">
                                  <AlertError :form="colorForm" />

                                    <div class="form-group">
                                        <label for="">Color name</label>
                                        <input type="text" v-model="colorForm.name" name="name" class="form-control" placeholder="color name">
                                        <HasError :form="colorForm" field="name" />
                                <!-- <AlertSuccess :form="form" message="Your changes have been saved!" /> -->

                                        <!-- <has-error :form="colorForm" field="name"></has-error> -->
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create Color</button>
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

export default {
     components: {
    Button, HasError, AlertError
  },
    data(){
        return{
            colorForm: new Form({
            name: '',
        }),
        }
    },
    methods:{
      createColor(){
            const response = this.colorForm.post('/api/color').then(({data})=>{
            this.colorForm.name="";
            this.$toast.success({
            title:'Success',
            message:'Color Created Successfully'
            })
        });

        }
    }

}
</script>

<style>

</style>
