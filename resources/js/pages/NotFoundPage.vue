<template>
    <div class="container">
        <div class="jumbotron text-center">
          <h1 class="display-4">Page Not Found</h1>
          <p class="lead">Sorry, your page was not found on the application </p>
          <hr class="my-4">
          <router-link class="btn btn-primary btn-lg" :to="{ name: 'home'}">Back to home page</router-link>
        </div>
    </div>
</template>