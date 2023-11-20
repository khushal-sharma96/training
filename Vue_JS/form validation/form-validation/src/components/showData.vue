<template>
    <div>
    <b-table striped hover :items="items"></b-table>
  </div>
    <div class="board">
        <h2>Email: {{ userData.email }}</h2>
        <h2>Name: {{userData.name}}</h2>
        <h2>Gender: {{userData.gender}}</h2>
        <h2>User type: {{userData.type}}</h2>
    </div>    
</template>
<script>
export default{
    name:"showData",
    props:{
        userData:Object
    }
}
</script>
<style>
</style>