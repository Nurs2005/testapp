<template>
    <div>
        <h2>Комментарий: </h2>
        <div class="card mb-3" v-for="comment in comments">
            <div class="card-header d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary" @click="setCommentToEdit(comment)">Редактировать</button>
                <button type="submit" class="btn btn-primary" @click="deleteComment(comment)">Удалить</button>
            </div>
            <div class="card-body">
                <p>{{ comment.description }}</p>
            </div>
        </div>
        <textarea name="description" class="form-control mb-3" cols="30" rows="10"
                  style="text-align: left" placeholder="Комментарий" v-model="comment.description"></textarea>
        <button @click="saveComment" type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            comments: [],
            comment:{
                id:'',
                description:'',
                user_id:'',
                post_id:'',
            }
        };
    },
    props: {
        user_id: '',
        post_id: '',
    },
    created() {
        this.fetchComments();
        this.comment.user_id = this.user_id;
        this.comment.post_id = this.post_id;
    },
    methods: {
        fetchComments() {
            fetch('/api/comments/' + this.post_id)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    this.comments = data.data;
                })
                .catch(error => {
                    console.error('Ошибка при получении списка постов:', error);
                });
        },

        setCommentToEdit(comment){
            this.comment = comment
            console.log(this.comment)
        },
        saveComment() {
            fetch('/api/comment_save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(this.comment),
            }).then((response) => {
                    if(response.ok){
                        this.fetchComments()
                        this.comment.description = ""
                    }
                })
                .catch(error => {
                    console.error('There was a problem saving the data:', error);
                });
        },
        deleteComment(comment){
            fetch('/api/comment_delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(comment),
            }).then((response) => {
                if(response.ok){
                    this.fetchComments()
                }
            })
                .catch(error => {
                    console.error('There was a problem saving the data:', error);
                });
        }
    }
};
</script>

<style>
</style>
