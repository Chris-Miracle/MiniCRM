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

        <div class="table-responsive mt-5">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Website</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="company in companies" :key="company.id">
                        <td>{{company.id}}</td>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img height="100px" width="100px" style="border-radius: 6px;" :src="`${$store.state.serverPath}/storage/${company.logo}`" alt=""/>
                                </div>
                                <div class="media-body text-center">
                                    <p><span v-if="editmode == false || editmode != company.id">{{company.name}}</span><input v-if="editmode == company.id" name="name" class="form-control" v-model="company.name" type="text"></p>
                                </div>
                            </div>
                        </td>
                        <td><span v-if="editmode == false || editmode != company.id">{{company.email}}</span><input v-if="editmode == company.id" name="email" class="form-control" v-model="company.email" type="text"></td>
                        <td><router-link style="color: blue"><span v-if="editmode == false || editmode != company.id">{{company.website}}</span><input v-if="editmode == company.id" name="website" class="form-control" v-model="company.website" type="text"></router-link></td>
                        <td class="text-center">
                            <div class="ml-auto mr-2 d-flex align-items-center">
                                <span>
                                    <svg v-on:click="editmode = company.id"  v-if="editmode != company.id" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFC107" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                        <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                    <svg v-if="editmode == company.id" v-on:click="updateCompany(company)"  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4CAF50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <polyline points="9 11 12 14 20 6" />
                                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                    </svg>
                                </span>
                                <span>
                                    <svg v-on:click="deleteCompany(company)" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash ml-1" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF5722" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Company',
        data(){
            return{
                editmode: false,
                pagination: {},
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
            deleteCompany(e){
                let data = new FormData();
                data.append('_method', 'DELETE')
                axios.post('api/company/'+e.id, data).then((res) => {
                    this.companies = res.data
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            },
            updateCompany(e){
                this.editmode = false
                let data = new FormData();
                data.append('_method', 'PATCH')
                data.append('name', e.name);
                data.append('email', e.email);
                data.append('website', e.website);
                axios.post('api/company/'+e.id, data)
                .catch((error) => {
                this.form.errors.record(error.response.data.errors)
                })
            },
            getCompanies(){
                axios.get('api/company').then((res) => {
                    this.companies =  res.data
                }).catch((error) => (
                    console.log(error)
                ))
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
            this.getCompanies();
        }
    }
</script>