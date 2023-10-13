<template>
   <form :action="url" method="post" @submit.prevent="handleSubmit">
   <label for="user">User</label>
   <input type="text" value="USER"></form>
</template>

<script setup>
import { ref } from 'vue';


const url = ref("{{url('welcome')}}");


</script>