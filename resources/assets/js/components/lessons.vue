<template>
    <div class="container text-center">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="CreateNewLesson">Create New Lesson</button>
        </h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="lesson in lessons">{{lesson.title}}</li>
        </ul>
        <create-lesson></create-lesson>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        props:['default_lessons','series_id'],
        mounted(){
            this.$on('lesson_created',(lesson)=>{
                this.lessons.push(lesson)
            })
        },
        components:{
            "create-lesson":require('./children/CreateLesson.vue')
        },
        data (){
            return {
                lessons:JSON.parse(this.default_lessons)
            }
        },
        computed:{

        },
        methods:{
            CreateNewLesson(){
                this.$emit('create_new_lesson',this.series_id)
            }
        }
    }
</script>