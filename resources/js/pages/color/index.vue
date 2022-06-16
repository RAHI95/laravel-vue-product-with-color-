<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>  colors</h5>
                        <router-link :to="{name:'create-color'}" class="btn btn-primary">Create Color</router-link>
                    </div>


                    <div class="card-body">
                       <table class="table">
                        <thead>
                            <tr>
                                 <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="color in colors" :key="color.id">
                                <td>{{color.id}}</td>
                                <td>{{color.name}}</td>
                                <td>
                                    <router-link :to="{name: 'edit-color', params: {id: color.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click="deleteColor(color)" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                colors:[]
            }
        },
            methods:{
                loadCategories(){
                axios.get('/api/color').then(response => {
                    this.colors = response.data;
                });

            },
            deleteColor(color) {
            axios.delete(`/api/color/${color.id}`).then(response => {
                this.$toast.success({
                title:'Success',
                message:'Color Deleted Successfully'
            })
            });
            let index = this.colors.indexOf(color);
            this.colors.splice(index,1);
        }

        },
        mounted() {
        this.loadCategories();
        }
    }
</script>
