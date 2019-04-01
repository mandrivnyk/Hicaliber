<template>
    <div  class="container  mt-4">
         <form @submit="formSubmit">
            <div v-if="errors.length">
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </div>
                <div class="form-group row">
                    <label for="Name" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="Name" id="Name" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Bedrooms" class="col-sm-2 col-form-label col-form-label-sm">Bedrooms</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="Bedrooms" id="Bedrooms" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Bathrooms" class="col-sm-2 col-form-label col-form-label-sm">Bathrooms</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="Bathrooms" id="Bathrooms" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Storeys" class="col-sm-2 col-form-label col-form-label-sm">Storeys</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="Storeys" id="Storeys" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Garages" class="col-sm-2 col-form-label col-form-label-sm">Garages</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="Garages" id="Garages" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="PriceFrom" class="col-sm-2 col-form-label col-form-label-sm">PriceFrom</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="PriceFrom" id="PriceFrom" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="PriceTo" class="col-sm-2 col-form-label col-form-label-sm">PriceTo</label>
                    <div class="col-sm-10">
                        <input type="text" v-model="PriceTo" id="PriceTo" class="form-control form-control-sm">
                    </div>
                </div>
                <button class="btn btn-success">Search</button>
        </form>
        <div class="container  mt-4">
            <ul v-if="results.length > 0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Storeys</th>
                        <th>Garages</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="result in results">
                        <td>{{ result.Name }}</td>
                        <td>{{ result.Bedrooms }}</td>
                        <td>{{ result.Bathrooms }}</td>
                        <td>{{ result.Storeys }}</td>
                        <td>{{ result.Garages }}</td>
                        <td>{{ result.Price }}</td>
                    </tr>
                </tbody>
            </table>
        </ul>
        </div>
        <span v-if="(showNoRecords == true) && (results.length == 0)"> No Records</span>
        <div v-if="loading">
            <img src="/images/loading.gif"/>
            Loading.....
        </div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                Name: '',
                Bedrooms: '',
                Bathrooms: '',
                Storeys: '',
                Garages: '',
                PriceFrom: '',
                PriceTo: '',
                results: [],
                errors: [],
                loading: false,
                showNoRecords: false
            };
        },


        methods: {
            formSubmit(e) {

                e.preventDefault();
                if(this.checkForm(e)){
                    this.loading = true;
                    axios.post('/api/search',  {
                        Name: this.Name,
                        Bedrooms: this.Bedrooms,
                        Bathrooms: this.Bathrooms,
                        Storeys: this.Storeys,
                        Garages: this.Garages,
                        PriceFrom: this.PriceFrom,
                        PriceTo: this.PriceTo
                    })
                        .then(
                            (response) => {
                                this.loading = false;
                                this.showNoRecords = true;
                                this.results = response.data;
                        })
                        .catch(error => {});
                }

            },

            checkForm: function (e) {
                this.errors = [];
                if (this.Name ||
                    this.Bedrooms ||
                    this.Bathrooms ||
                    this.Storeys ||
                    this.Garages ||
                    this.PriceFrom ||
                    this.PriceTo
                ) {
                    return true;
                }
                this.results.length = 0;
                this.errors.push('Fill in this form, please');
                e.preventDefault();
                return false;
            }
        }
    }
</script>