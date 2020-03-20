<template>
    <div class="card text-left">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" :href="tabId('write', '#')" data-toggle="tab" >Write</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" :href="tabId('preview', '#')" data-toggle="tab" >Preview</a>
          </li>        
        </ul>
      </div>
      <div class="card-body tab-content">
        <div class="tab-pane fade show active" :id="tabId('write')">
            <slot></slot>
        </div>
        <div class="tab-pane" :id="tabId('preview')" v-html="preview">
        </div>
      </div>
    </div>
</template>
<script>
    
    import MarkdownIt from 'markdown-it';
    import autosize from 'autosize';
    import prism from 'markdown-it-prism';
    import 'prismjs/themes/prism-tomorrow.css'; 
    
    const md = new MarkdownIt();
    md.use(prism);
    
    
    export default {
        props: ['body', 'name'],
        
        
        methods: {
            
            tabId (tabName, hash = '') {
                return `${hash}${tabName}${this.name}`;
            }
            
        },
        
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
        
//        mounted() {
//            autosize(this.$el.querySelector('textarea'));
//        }
//        
//        updated() {
//            //autosize(document.querySelector('textarea'));
//            
//        }
        
    }
    
</script>