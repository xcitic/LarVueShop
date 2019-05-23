<template>
  <!-- Form to fill in shipping information and contact details (check if exists on user table.) -->

  <v-container shrink grid-list-xl>



      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
      >

      <v-flex>
        <v-text-field
          v-model="user.name"
          :rules="nameRules"
          label="Name"
          required
        ></v-text-field>
      </v-flex>

        <v-flex >
          <v-text-field
            v-model="user.email"
            :rules="emailRules"
            label="Email"
            required
          ></v-text-field>
        </v-flex>


        <v-flex>
          <v-text-field
            v-model="user.country"
            :rules="countryRules"
            label="Country"
            required
          ></v-text-field>
        </v-flex>

        <v-flex>
          <v-text-field
            v-model="user.address"
            :rules="addressRules"
            label="Address"
            required
          ></v-text-field>
        </v-flex>

        <v-flex>
          <v-text-field
            v-model="user.zip"
            :rules="zipRules"
            label="Postal Code"
            required
          ></v-text-field>
        </v-flex>


        <v-flex>
          <v-text-field
            v-model="user.phone"
            :rules="phoneRules"
            label="Phone Number"
            required
          ></v-text-field>
        </v-flex>
    </v-form>


  </v-container>

</template>

<script>

export default {
  name: 'OrderDetails',
  props: [ 'user', 'complete' ],

  data() {
    return {
      valid: true,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 50) || 'Name must be less than 50 characters'
      ],
      emailRules: [
        v => !!v || 'Email is required',
        v => /.+@.+/.test(v) || 'Email must be valid'
      ],
      countryRules: [
        v => !!v || 'Country is required',
      ],
      addressRules: [
        v => !!v || 'Address is required',
      ],
      zipRules: [
        v => !!v || 'Postal code is requried',
      ],
      phoneRules: [
        v => !!v || 'Phone number is required',
      ],
    }
  },



}
</script>

<style lang="css" scoped>
</style>
