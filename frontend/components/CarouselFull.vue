<template>
  <v-carousel hide-delimiters>
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
      ></v-carousel-item>
    </v-carousel>
</template>

<script>

export default {
  name: 'CarouselFull',
  data() {
    return {
      items: [
        {
          src: 'https://mdbootstrap.com/img/Photos/Horizontal/People/full%20page/img%20(24).jpg'
        }
      ]
    }
  }
}

</script>

<style lang="css" scoped>
</style>
