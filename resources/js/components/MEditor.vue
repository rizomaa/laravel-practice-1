<template>
    <div class="card text-center">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#write" data-toggle="tab" >Write</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#preview" data-toggle="tab" >Preview</a>
          </li>        
        </ul>
      </div>
      <div class="card-body tab-content">
        <div class="tab-pane fade show active" id="write" role="tabpanel">
            <slot></slot>
        </div>
        <div class="tab-pane" id="preview" role="tabpanel">
            Preview... 
        </div>
      </div>
    </div>
</template>
<script>
    export default {
        props: ['body'],
    }
</script>



<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
