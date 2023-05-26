<template>
    <div>
      <ul>
        <li v-for="image in images">
          <img :src="image.path"/>
          <router-link :to="'/images/' + image.id">Show</router-link>
        </li>
      </ul>
      <form @submit.prevent="createImage">
        <input type="file" ref="fileInput" @change="uploadImage"/>
        <button type="submit">Create</button>
      </form>
      <router-view></router-view>
    </div>
  </template>
  
  <script>  
  import axios from 'axios';

  export default {
    data() {
      return {
        images: [],
        file: null
      }
    },
    mounted() {
      axios.get('http://127.0.0.1:8000/api/images').then(response => {
        this.images = response.data
      })
    },
    methods: {
      uploadImage() {
        let input = this.$refs.fileInput
        this.file = input.files[0]
      },
      createImage() {
        let formData = new FormData()
        formData.append('path', this.file)
        axios.post('http://127.0.0.1:8000/api/images', this.formData)
        .then(response => {
          // handle success
        })
        .catch(error => {
          if (error.response.status === 500) {
            this.error = 'An error occurred on the server. Please try again later.';
          } else {
            this.error = error.response.data.message;
          }
        });
      }
    }
  }
  </script>
  