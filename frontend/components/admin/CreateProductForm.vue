<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="title"
      :counter="255"
      :rules="titleRules"
      label="Title"
      required
    ></v-text-field>

    <v-text-field
      v-model="description"
      :rules="descriptionRules"
      label="Description"
      required
    ></v-text-field>

    <v-text-field
      v-model="slug"
      :rules="slugRules"
      label="Slug"
      required
    ></v-text-field>

    <v-text-field
      v-model="price"
      :rules="priceRules"
      label="Price"
      required
    ></v-text-field>

    <v-text-field
      v-model="image"
      :rules="imageRules"
      label="Image"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      @click="postProduct"
    >
      Create Product
    </v-btn>

    <v-btn
      color="error"
      @click="reset"
    >
      Reset Form
    </v-btn>


  </v-form>

</template>

<script>
export default {
  name: 'CreateProductForm',

  data() {
    return {
      valid: false,
      title: '',
      titleRules: [
        v => !!v || 'Title is required',
        v => (v && v.length <= 255) || 'Title must be less than 255 characters'
      ],
      description: '',
      descriptionRules: [
        v => !!v || 'Description is required',
        v => (v && v.length <= 650) || 'Description must be less than 650 characters'
      ],
      slug: '',
      slugRules: [
        v => !!v || 'Slug is required',
        v => (v && v.length <= 255) || 'Slug must be less than 150 characters'
      ],
      price: null,
      priceRules: [
        v => !!v || 'Price is required',
        v => (v && v.length <= 50) || 'Price must be less than 50 digits'
      ],
      image: '',
      imageRules: [
        v => !!v || 'Image is required',
        v => (v && v.length <= 255) || 'Image must be less than 255 characters'
      ]
    }
  },

  methods: {

    postProduct() {

      if ( this.$refs.form.validate() ) {
      let input = {
        title: this.title,
        description: this.description,
        slug: this.slug,
        price: this.price,
        image: this.image
      }

        store.dispatch('admin/createProduct', input)
        .then((result) => {
          if (result === 'success') {
            alert('Successfully created product');
          }
        })
      }
    },

    reset() {
      this.title = '',
      this.description = '',
      this.slug = '',
      this.price = null,
      this.image = ''
    }

  }
}
</script>

<style lang="css" scoped>
</style>
