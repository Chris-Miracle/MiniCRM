<template>
    <div>
        <form @submit.prevent="saveData" enctype="multipart/form-data">
            <div class="form-row mb-1">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" :class="{'is-invalid' : form.errors.has('name')}" class="form-control" placeholder="Name of Company" name="name" @keydown="form.errors.clear('name')">
                    <span class="text-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="name">Email</label>
                    <input type="email" v-model="form.email" :class="{'is-invalid' : form.errors.has('email')}" class="form-control" placeholder="example@gmail.com" name="email" @keydown="form.errors.clear('email')">
                    <span class="text-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                </div>
            </div>

            <div class="form-row mb-1">
                <div class="form-group col-md-6">
                    <label for="name">Website</label>
                    <input type="text" v-model="form.website" :class="{'is-invalid' : form.errors.has('website')}" class="form-control" placeholder="Company website" name="website" @keydown="form.errors.clear('website')">
                    <span class="text-danger" v-if="form.errors.has('website')" v-text="form.errors.get('website')"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="image">Add Logo</label>
                    <input v-on:change="attachLogo"  type="file" ref="newLogoImage" class="form-control-file" @keydown="form.errors.clear('logo')" name="logo">
                    <span class="text-danger" v-if="form.errors.has('logo')" v-text="form.errors.get('logo')"></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add New Company </button>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'Company',
        data(){
            return{
                editmode: false,
                companies: '',
                form: new Form({
                name: '',
                email: '',
                website: '',
                logo: '',
                })
            }
        },
        methods: {
            attachLogo(){
                this.form.logo = this.$refs.newLogoImage.files[0];
                console.log(this.form.logo)
            },
            saveData(){
                let data = new FormData();
                data.append('name', this.form.name);
                data.append('email', this.form.email);
                data.append('website', this.form.website);
                data.append('logo', this.form.logo);
                axios.post('/api/company', data).then((res) => {
                    this.form.reset()
                    this.getCompanies()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>