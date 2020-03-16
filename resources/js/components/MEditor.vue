<template>
    <div class="card text-left">
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
        <div class="tab-pane fade show active" id="write">
            <slot></slot>
        </div>
        <div class="tab-pane" id="preview" v-html="preview">123
        </div>
      </div>
    </div>
</template>
<script>
    
    import MarkdownIt from 'markdown-it';
    import autosize from 'autosize';
    
    const md = new MarkdownIt();
    
    
    export default {
        props: ['body'],
        
        computed: {
            preview() {
                return md.render(this.body);
            }
        },
        
//        watch: {
//            body: function() {
//                console.log('watcher message');
//            }
//        },
        
        mounted() {
            autosize(this.$el.querySelector('textarea'));
        }
//        
//        updated() {
//            //autosize(document.querySelector('textarea'));
//            
//        }
        
    }
    
</script>